<?php

namespace App\Console\Commands;

use App\Models\Ranking;
use App\Models\Server;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CrawlRankingData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:crawl-ranking-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $servers = Server::all();

        if (!empty($servers) && $servers->isNotEmpty()) {
            //Xóa hết thông tin rank của những thằng không có server (server bị xóa, bị gộp => không còn trong bảng servers)
            Ranking::query()
                ->doesntHave('server')
                ->delete();

            foreach ($servers as $server) {
                DB::beginTransaction();
                try {
                    $response = Http::retry(3, 5000)
                        ->timeout(60)
                        ->get('http://103.82.29.159:40050/getranking?serverid='. $server->id .'&top=1000');

                    if ($response->ok()) {
                        $ranks = $response->json();

                        if (!empty($ranks) && is_array($ranks)) {
                            $now = now();
                            $ranks = array_map(function ($rank) use ($now, $server) {
                                return [
                                    'server_id' => $server->id,
                                    'role_name' => $rank['character'],
                                    'role_level' => (int) $rank['level'],
                                    'role_faction' => (int) $rank['faction'],
                                    'role_class' => (int) $rank['class'],
                                    'index' => (int) $rank['rank'],
                                    'created_at' => $now,
                                    'updated_at' => $now,
                                ];
                            }, $ranks);
                            Ranking::query()->where('server_id', $server->id)->delete();
                            Ranking::insert($ranks);
                            DB::commit();
                            Cache::forget('ranking-index');
                        }
                    }
                } catch (\Exception $exception) {
                    DB::rollback();
                    Log::error('Lỗi crawl dữ liệu server ' . $server->id . ': ' . $exception->getMessage());
                    continue;
                }
            }
        }

        return 0;
    }
}
