<?php

namespace App\Console\Commands;

use App\Models\Server;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CrawlServerList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:crawl-server-list';

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
    public function handle()
    {
        $response = Http::retry(3, 5000)
            ->timeout(60)
            ->get('http://103.82.29.159:40050/getserverlist');

        if ($response->ok()) {
            $servers = $response->json();
            $dataInsert = [];
            $now = now();
            if (!empty($servers) && is_array($servers)) {
                foreach ($servers as $k => $server) {
                    $dataInsert[] =  [
                        'id' => (int) $server['serverid'],
                        'name' => $server['servername'],
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
                DB::beginTransaction();
                try {
                    Server::truncate();
                    foreach ($dataInsert as $data) {
                        $find = Server::where('id', '=', $data['id'])->first();
                        if (empty($find)) {
                            Server::insert($data);
                        }
                    }
                    DB::commit();
                } catch (\Exception $exception) {
                    DB::rollBack();
                    Log::error('Lỗi cập nhật danh sách server: ' . $exception->getMessage());
                }
            }
        }

        return 0;
    }
}
