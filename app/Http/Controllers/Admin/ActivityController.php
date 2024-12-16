<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{
    public function index() {
        $activities = Activity::orderBy('created_at')->get();
        return view('admin.activity.list')->with(compact('activities'));
    }

    public function getForm() {
        return view('admin.activity.form');
    }

    public function saveForm(Request $request) {
        $rules = [
            'name' => 'required',
            'time' => 'required',
        ];

        $messages = [
            'name.required' => 'Tên không được để trống',
            'time.required' => 'Thời gian không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $data = $request->all();
            DB::beginTransaction();
            try {
                Activity::create($data);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                Log::error('Lỗi ' . $exception->getMessage());
            }
            return redirect()->route('admin.activity.list');
        }
    }

    public function editForm($id) {
        $activity = Activity::FindOrFail($id);
        return view('admin.activity.edit', ['activity' => $activity]);
    }

    public function updateForm(Request $request, $id) {
        $rules = [
            'name' => 'required',
            'time' => 'required',
        ];

        $messages = [
            'name.required' => 'Tên không được để trống',
            'time.required' => 'Thời gian không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $activity = Activity::FindOrFail($id);
            $updateRequest = $request->all();
            $activity->update($updateRequest);
            return redirect()->route('admin.activity.list');
        }
    }

    public function delete($id) {
        Activity::FindOrFail($id)->delete();
        return redirect()->back();
    }
}
