<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActorSlide;
use App\Models\Banner;
use App\Models\Category;
use App\Models\KeyWord;
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

class IndexController extends Controller
{
    public function index(Request $request) {
        $keywords = KeyWord::get();
        $data = '';
        $posts = Post::with('category')
            ->where('active', ACTIVE)
            ->whereHas('category', function ($query) {
                $query->where('name', 'LIKE', 'tin tức');
            })
            ->orderByDesc('created_at')->paginate(5);
        $banners = Banner::orderByDesc('created_at')->limit(5)->get();
        $activities = Activity::orderBy('created_at')->get();
        $actors = ActorSlide::orderBy('created_at')->get();
        $rank = $this->getRanking(0);
        $servers = Server::all();
        $keywords = $this->keywords();
        return view('trang-chu.main', [
            'posts' => $posts,
            'banners' => $banners,
            'activities' => $activities,
            'actors' => $actors,
            'ranks' => $rank,
            'servers' => $servers,
            'keywords' => $keywords
        ]);
    }

    public function rankPaginate(Request $request) {
        $rank = $this->getRanking(0);
        $servers = Server::all();
        return view('layout.homepage.index.bxh', [
            'ranks' => $rank,
            'servers' => $servers
        ]);
    }

    public function rankFilter(Request $request) {
        $servers = Server::all();
        $rank = Ranking::query()
            ->with('server:id,name')
            ->whereHas('server');
        $type = null;
        if (isset($request->server_id)) {
            $rank = $rank->where('server_id', $request->server_id);
            $type = '&server_id=' . $request->server_id;
        }
        if (isset($request->faction)) {
            $rank = $rank->where('role_faction', $request->faction);
            $type = '&faction=' . $request->faction;
        }
        if (isset($request->class)) {
            $rank = $rank->where('role_class', $request->class);
            $type = '&class=' . $request->class;
        }
        $rank = $rank->orderByDesc('role_level')
        ->paginate(10);
        return view('layout.homepage.index.bxh', [
            'ranks' => $rank,
            'servers' => $servers,
            'type' => $type
        ]);
    }

    public function indexNew(Request $request) {
        $posts = Post::with('category')
            ->whereHas('category', function ($query) {
                $query->where('name', 'LIKE', 'tin tức');
            })->where('active', ACTIVE)
            ->orderByDesc('created_at')->paginate(5);
        return view('layout.homepage.index.new', [
            'posts' => $posts,
        ]);
    }

    public function indexEvent(Request $request) {
        $posts = Post::with('category')
            ->whereHas('category', function ($query) {
                $query->where('name', 'LIKE', 'sự kiện');
            })->where('active', ACTIVE)
            ->orderByDesc('created_at')->paginate(5);
        return view('layout.homepage.index.event', [
            'posts' => $posts,
        ]);
    }

    public function indexSearch(Request $request) {
        $posts = Post::with('category')
            ->where('active', ACTIVE)
            ->whereBetween('category_id', config('app.search_category'))
            ->where('title', 'LIKE', '%'. $request->keyword .'%')->orderByDesc('created_at')->paginate(5);
        return view('layout.homepage.index.search', [
            'posts' => $posts,
        ]);
    }

    public function search() {
        if (!empty($request->search)) {
            $news = Post::with('category')
                ->where('active', ACTIVE)
                ->where('title', 'LIKE', '%'. $request->search .'%')
                ->orderByDesc('created_at')->paginate(8);
        } else {
            $news = Post::with('category')
                ->where('active', ACTIVE)
                ->orderByDesc('created_at')->paginate(8);
        }
        return view('search', [
            'search' => !empty($request->search) ? $request->search : '' ,
            'posts' => $news,
        ]);
    }

    public function search_detail($post) {
        $detail = Post::with('category')
            ->where('active', ACTIVE)
            ->where('title_domain', 'LIKE', $post)
            ->first();
        return view('search-detail', [
            'post' => $detail
        ]);
    }


    public function ranking($serverId): \Illuminate\Http\JsonResponse
    {
        $serverId = (int) $serverId;
        $rank = $this->getRanking($serverId);

        return response()->json([
            'status' => 1,
            'data' => $rank
        ]);
    }

    protected function getRanking($serverId)
    {
        return Cache::remember('ranking-index', 60 * 60, function () use ($serverId) {
            return Ranking::query()
                ->with('server:id,name')
                ->whereHas('server')
                ->when($serverId > 0, function ($query) use ($serverId) {
                    $query->where('server_id', $serverId);
                })
                ->orderBy('index', 'asc')
                ->paginate(10);
        });
    }

    public function newPage(Request $request) {
        $page = !empty($request->page) ? $request->page : 1;
        $news = Post::where('type', NEWS_POST)->where('active', ACTIVE)->orderBy('created_at', 'desc')->paginate(10);
        return view('news', [
            'page' => $page,
            'news' => $news,
            'type' => NEWS_POST,
            'routeName' => 'index.new-page',
        ]);
    }

    public function eventPage() {
        $page = !empty($request->page) ? $request->page : 1;
        $news = Post::where('type', EVENT_POST)->where('active', ACTIVE)->orderBy('created_at', 'desc')->paginate(10);
        return view('news', [
            'page' => $page,
            'news' => $news,
            'type' => EVENT_POST,
            'routeName' => 'index.event-page',
        ]);
    }

    public function instructionPage(Request $request) {
        $page = !empty($request->page) ? $request->page : 1;
        $news = Post::where('type', INSTRUCTION_POST)->where('active', ACTIVE)->orderBy('created_at', 'desc')->paginate(10);
        return view('news', [
            'page' => $page,
            'news' => $news,
            'type' => INSTRUCTION_POST,
            'routeName' => 'index.instruction-page',
        ]);
    }

    public function postPage($id) {
        $post = Post::find($id);
        $news = Post::where('type', NEWS_POST)->where('active', ACTIVE)->orderBy('created_at', 'desc')->paginate(5);
        return view('new-details', [
            'post' => $post,
            'news' => $news
        ]);
    }

    public function download() {
        return view('download');
    }
}
