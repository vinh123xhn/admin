<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActorSlide;
use App\Models\Banner;
use App\Models\Category;
use App\Models\ImageLauncher;
use App\Models\Post;
use App\Models\Ranking;
use App\Models\Server;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LauncherController extends Controller
{
    public function newLauncher(Request $request)
    {
        $news = $this->getNew();
        return view('new-launcher', [
            'news' => $news,
        ]);
    }


    public function imageLauncherSmall(Request $request)
    {
        $image = ImageLauncher::where('type', 1)->orderBy('created_at')->first();
        return view('image-launcher1', [
            'image' => $image,
        ]);
    }


    public function imageLauncherBig(Request $request)
    {
        $image = ImageLauncher::where('type', 2)->orderBy('created_at')->first();
        return view('image-launcher2', [
            'image' => $image,
        ]);
    }

    protected function getNew()
    {
        return Cache::remember('ranking', 1440 * 60, function () {
            return Post::query()
                ->with('category')
                ->where('is_featured', 1)
                ->orderByDesc('created_at')
                ->limit(4
                )->get();
        });
    }

}
