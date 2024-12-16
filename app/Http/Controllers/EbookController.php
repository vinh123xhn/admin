<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Ebook;
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

class EbookController extends Controller
{
    public function list() {
        $categories = Category::with('parent', 'ebook')
            ->whereHas('parent', function ($q){
                $q->where('name', 'LIKE', 'guide')->orWhere('name', 'LIKE', 'ebook');
            })->get();
        $detail = Post::with('category')
            ->whereHas('category', function ($q) {
                $q->where('name', 'LIKE', 'guide')->orWhere('name', 'LIKE', 'ebook');
            })->orderByDesc('created_at')
            ->first();
        return view('ebook', [
            'post' => $detail,
            'categories' => $categories
        ]);
    }

    public function detail($post) {
        $categories = Category::with('parent', 'ebook')
            ->whereHas('parent', function ($q){
                $q->where('name', 'LIKE', 'guide')->orWhere('name', 'LIKE', 'ebook');
            })->get();
        $detail = Post::with('category')
            ->where('title_domain', 'LIKE', $post)
            ->first();
        return view('ebook', [
            'post' => $detail,
            'categories' => $categories
        ]);
    }
}
