<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Server;
use Dotenv\Util\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdateTitle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:update-title';

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
        $posts = Post::all();
        foreach ($posts as $k => $post) {
            $post['title_domain'] = \Illuminate\Support\Str::slug($post['title']) . '-' . $post['id'];
            $post->save();
        }

        return 0;
    }
}
