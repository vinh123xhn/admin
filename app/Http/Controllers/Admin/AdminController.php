<?php

namespace App\Http\Controllers\Admin;

use App\Models\AttendanceLog;
use App\Models\GiftCodeLog;
use App\Models\Introduce;
use App\Models\MakeCakeLog;
use App\Models\MessageLog;
use App\Models\RotationLog;
use App\Models\ScoinUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function index(Request $request) {
        return view('admin.dashboard');
    }

//    public function logList() {
//        $logs = GiftCodeLog::with('scoin')->get();
//        return view('admin.log')->with([
//            'logs' => $logs
//        ]);
//    }
//
//    public function IntroduceList() {
//        $logs = Introduce::with('scoin')->get();
//        return view('admin.introduce')->with([
//            'logs' => $logs
//        ]);
//    }
//
//    public function scoinUser() {
//        $users = ScoinUser::get();
//        return view('admin.scoin_user')->with([
//            'users' => $users
//        ]);
//    }

}
