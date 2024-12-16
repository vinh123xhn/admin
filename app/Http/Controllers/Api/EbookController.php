<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class EbookController extends Controller
{
    public function getPost(Request $request)
    {
        if (isset($request->keyword)) {
            $post = Ebook::with('category')
                ->where('title', 'LIKE', '%'. $request->keyword .'%')
                ->orderByDesc('created_at')->first();
            return view('layout.homepage.ebook.search', ['post' => $post]);
        }
        if (isset($request->id)) {
            $post = Ebook::with('category')
                ->where('id', $request->id)
                ->orderByDesc('created_at')->first();
            return view('layout.homepage.ebook.search', ['post' => $post]);
        }
    }
}
