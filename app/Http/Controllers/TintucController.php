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

class TintucController extends Controller
{
    public function tin_tuc() {
        $news = Post::with('category')
            ->whereHas('category', function ($query) {
                $query->where('name', 'LIKE', 'tin tức');
            })->where('active', ACTIVE)->orderByDesc('created_at')->paginate(8);
        $keywords = $this->keywords();
        return view('tin-tuc.main', [
            'check' => 'tintuc',
            'posts' => $news,
            'keywords' => $keywords
        ]);
    }

    public function postNew(Request $request) {
        $posts = Post::with('category')
            ->whereHas('category', function ($query) {
                $query->where('name', 'LIKE', 'tin tức');
            })->where('active', ACTIVE)->orderByDesc('created_at')->paginate(8);
        $newPost = Post::with('category')
            ->where('category_id', NEWS_POST)
            ->orderByDesc('created_at')
            ->first();
        $eventPost = Post::with('category')
            ->where('category_id', EVENT_POST)
            ->orderByDesc('created_at')
            ->first();
        $keywords = $this->keywords();
        return view('layout.homepage.posts.new', [
            'posts' => $posts,
            'newPost' => $newPost,
            'eventPost' => $eventPost,
            'keywords' => $keywords
        ]);
    }

    public function postEvent(Request $request) {
        $posts = Post::with('category')
            ->whereHas('category', function ($query) {
                $query->where('name', 'LIKE', 'sự kiện');
            })->where('active', ACTIVE)->orderByDesc('created_at')->paginate(8);
        $newPost = Post::with('category')
            ->where('category_id', NEWS_POST)
            ->orderByDesc('created_at')
            ->first();
        $eventPost = Post::with('category')
            ->where('category_id', EVENT_POST)
            ->orderByDesc('created_at')
            ->first();
        $keywords = $this->keywords();
        return view('layout.homepage.posts.event', [
            'posts' => $posts,
            'newPost' => $newPost,
            'eventPost' => $eventPost,
            'keywords' => $keywords
        ]);
    }

    public function postSearch(Request $request) {
        $posts = Post::with('category')
            ->whereBetween('category_id', config('app.search_category'))
            ->where('active', ACTIVE)
            ->where('title', 'LIKE', '%'. $request->keyword .'%')->orderByDesc('created_at')->paginate(8);
        $newPost = Post::with('category')
            ->where('category_id', NEWS_POST)
            ->orderByDesc('created_at')
            ->first();
        $eventPost = Post::with('category')
            ->where('category_id', EVENT_POST)
            ->orderByDesc('created_at')
            ->first();
        $keywords = $this->keywords();
        return view('layout.homepage.posts.search', [
            'posts' => $posts,
            'newPost' => $newPost,
            'eventPost' => $eventPost,
            'keywords' => $keywords
        ]);
    }

    public function tin_tuc_detail($post) {
        $detail = Post::with('category')
            ->where('title_domain', 'LIKE', $post)
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
        return view('tin-tuc.main', [
            'check' => 'tintuc',
            'post' => $detail,
            'newPost' => $newPost,
            'eventPost' => $eventPost,
            'keywords' => $keywords
        ]);
    }

    public function su_kien() {
        if (!empty($request->search)) {
            $news = Post::with('category')
                ->where('active', ACTIVE)
                ->where('title', 'LIKE', '%'. $request->search .'%')
                ->orderByDesc('created_at')->paginate(8);
        } else {
            $events = Post::with('category')
                ->whereHas('category', function ($query) {
                    $query->where('name', 'LIKE', 'sự kiện');
                })->where('active', ACTIVE)->orderByDesc('created_at')->paginate(8);
        }
        $keywords = $this->keywords();
        return view('tin-tuc.main', [
            'check' => 'sukien',
            'posts' => $events,
            'keywords' => $keywords
        ]);
    }

    public function su_kien_detail($post) {
        $detail = Post::with('category')
            ->where('title_domain', 'LIKE', $post)
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
        return view('tin-tuc.main', [
            'check' => 'sukien',
            'post' => $detail,
            'newPost' => $newPost,
            'eventPost' => $eventPost,
            'keywords' => $keywords
        ]);
    }
}
