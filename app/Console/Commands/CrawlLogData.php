<?php

namespace App\Console\Commands;

use App\Models\Ranking;
use App\Models\Server;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CrawlLogData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:crawl-log-data';

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
                        ->get('http://manager-vtc-vdttg.gmvi.vn/api/vtc/release/queryTopAllSever.php?serverid='. $server->id .'&top=30');

                    if ($response->ok()) {
                        $ranks = $response->json();

                        if (!empty($ranks) && is_array($ranks)) {
                            $now = now();
                            $ranks = array_map(function ($rank) use ($now, $server) {
                                return [
                                    'server_id' => $server->id,
                                    'role_name' => $rank['rolename'],
                                    'role_level' => (int) $rank['level'],
                                    'role_power' => (int) $rank['combat'],
                                    'role_vip' => (int) $rank['vip'],
                                    'role_professional' => (int) $rank['professional'],
                                    'role_id' => (int) $rank['role_id'],
                                    'created_at' => $now,
                                    'updated_at' => $now,
                                ];
                            }, $ranks);
                            \App\Models\Log::query()->where('server_id', $server->id)->delete();
                            \App\Models\Log::insert($ranks);
                            DB::commit();
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
