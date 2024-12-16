<?php

namespace App\Http\Controllers;

use App\Models\KeyWord;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $session = $request->session()->get('hkgh-tracking', []);
            $queryParameters = $request->query();
            $request->session()->put('hkgh-tracking', array_merge($session, $queryParameters));

            return $next($request);
        });
    }

    public function keywords(): bool
    {
        return Cache::rememberForever('keywords', function () {
            return KeyWord::query()
                ->get()
                ->implode('keyword', ', ');
        });
    }
}
