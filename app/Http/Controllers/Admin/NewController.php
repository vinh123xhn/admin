<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NewController extends Controller
{
    public function index() {
        $news = News::orderBy('created_at')->get();
        return view('admin.news.list')->with(compact('news'));
    }

    public function getForm() {
        return view('admin.news.form');
    }

    public function saveForm(Request $request) {
        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];

        $messages = [
            'title.required' => 'Tiêu đề không được để trống',
            'content.required' => 'Nội dung không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $data = $request->all();
            $user = Auth::user();
            $data['create_by'] = $user['id'];
            $data['update_by'] =$user['id'];
            $data['update_at'] = Carbon::now();
            DB::beginTransaction();
            try {
                $post = News::create($data);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                Log::error('Lỗi ' . $exception->getMessage());
            }
            return redirect()->route('admin.news.list');
        }
    }

    public function editForm($id) {
        $new = News::FindOrFail($id);
        return view('admin.news.edit', ['new' => $new]);
    }

    public function updateForm(Request $request, $id) {
        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];

        $messages = [
            'title.required' => 'Tiêu đề không được để trống',
            'content.required' => 'Nội dung không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $news = News::FindOrFail($id);
            $updateRequest = $request->all();
            $user = Auth::user();
            $updateRequest['create_by'] = $user['id'];
            $updateRequest['update_by'] = $user['id'];
            $updateRequest['update_at'] = Carbon::now();
            $news->update($updateRequest);
            return redirect()->route('admin.news.list');
        }
    }

    public function delete($id) {
        News::FindOrFail($id)->delete();
        return redirect()->back();
    }
}
