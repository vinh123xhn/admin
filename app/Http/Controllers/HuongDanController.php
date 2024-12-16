<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActorSlide;
use App\Models\Banner;
use App\Models\Category;
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

class HuongDanController extends Controller
{
    public function huong_dan() {
        $categories = Category::with('parent', 'post')
            ->whereHas('parent', function ($q){
                $q->where('name', 'LIKE', 'hướng dẫn');
            })->get();
        $detail = Post::with('category')
            ->where('title_domain', 'LIKE', '%Huong-dan-tai-game%')
            ->first();
        $newPost = Post::with('category')
            ->where('category_id', NEWS_POST)
            ->orderByDesc('created_at')
            ->first();
        $eventPost = Post::with('category')
            ->where('category_id', EVENT_POST)
            ->orderByDesc('created_at')
            ->first();
        $keywords = $this->keywords();
        return view('huong-dan.main', [
            'detail' => $detail,
            'categories' => $categories,
            'page' => true,
            'newPost' => $newPost,
            'eventPost' => $eventPost,
            'keywords' => $keywords
        ]);
    }

    public function huong_dan_detail($post) {
        $categories = Category::with('parent', 'post')
            ->whereHas('parent', function ($q){
                $q->where('name', 'LIKE', 'hướng dẫn');
            })->get();
        $detail = Post::with('category')
            ->where('title_domain', '=', $post)
            ->first();
        $newPost = Post::with('category')
            ->where('category_id', NEWS_POST)
            ->orderByDesc('created_at')
            ->first();
        $eventPost = Post::with('category')
            ->where('category_id', EVENT_POST)
            ->orderByDesc('created_at')
            ->first();
        $keywords = $this->keywords();
        return view('huong-dan.main', [
            'detail' => $detail,
            'categories' => $categories,
            'newPost' => $newPost,
            'eventPost' => $eventPost,
            'keywords' => $keywords
        ]);
    }
}
