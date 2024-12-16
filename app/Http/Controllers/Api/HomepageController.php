<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Ranking;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function getPostForIndex(Request $request)
    {
        if (isset($request->type) && $request->type == 'tintuc') {
            $posts = Post::with('category')
                ->whereHas('category', function ($query) {
                    $query->where('name', 'LIKE', 'tin tức');
                })->orderByDesc('created_at')->paginate(5);

            return $posts;
        }

        if (isset($request->type) && $request->type == 'event') {
            $posts = Post::with('category')
                ->whereHas('category', function ($query) {
                    $query->where('name', 'LIKE', 'sự kiện');
                })->orderByDesc('created_at')->paginate(5);

            return $posts;
        }

        if (isset($request->keyword)) {
            $posts = Post::with('category')
                ->whereHas('category', function ($query) {
                    $query->where('name', 'LIKE', 'tin tức');
                })
                ->where('title', 'LIKE', '%'. $request->keyword .'%')
                ->orderByDesc('created_at')->paginate(5);

            return $posts;
        }
    }
//    public function getRanking(Request $request)
//    {
//       $rank = $this->getRanking(0);
//       return $rank;
//    }

//    public function rankingApi($serverId): \Illuminate\Http\JsonResponse
//    {
//        $serverId = (int) $serverId;
//        $rank = $this->getRanking($serverId);
//
//        return response()->json([
//            'status' => 1,
//            'data' => $rank
//        ]);
//    }
//
//    protected function getRankingApi($serverId)
//    {
//        return Ranking::query()
//            ->with('server:id,name')
//            ->whereHas('server')
//            ->when($serverId > 0, function ($query) use ($serverId) {
//                $query->where('server_id', $serverId);
//            })
//            ->orderByDesc('role_level')
//            ->paginate(10);
//    }
}
