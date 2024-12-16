<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function index() {
        $banners = Banner::orderBy('created_at')->get();
        return view('admin.banner.list')->with(compact('banners'));
    }

    public function getForm() {
        return view('admin.banner.form');
    }

    public function saveForm(Request $request) {
        $rules = [
            'name' => 'required',
            'image' => 'required|max:30000',
        ];

        $messages = [
            'name.required' => 'Tên không được để trống',
            'images.required' => 'Ảnh không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $data = $request->all();
            if($request->hasFile('image'))
            {
                $path = $request->file('image')->store('img', 'public');

                // Lấy đường dẫn của file đã lưu
                $url = Storage::url($path);
                $data['image'] = $url;
            }
            DB::beginTransaction();
            try {
                Banner::create($data);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                Log::error('Lỗi ' . $exception->getMessage());
            }
            return redirect()->route('admin.banner.list');
        }
    }

    public function editForm($id) {
        $banner = Banner::FindOrFail($id);
        return view('admin.banner.edit', ['banner' => $banner]);
    }

    public function updateForm(Request $request, $id) {
        $rules = [
            'name' => 'required',
            'image' => 'required',
        ];

        $messages = [
            'name.required' => 'Tên không được để trống',
            'image.required' => 'Ảnh không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $banner = banner::FindOrFail($id);
            $updateRequest = $request->all();
            if ($request->hasFile('image')) {
                //xoa anh cu neu co
                $currentImg = $banner->image;
                if ($currentImg) {
                    Storage::delete('public/' . $currentImg);
                }
                //cap nhap anh moi
                $path = $request->file('image')->store('img', 'public');

                // Lấy đường dẫn của file đã lưu
                $url = Storage::url($path);
                $updateRequest['image'] = $url;
            }
            $banner->update($updateRequest);
            return redirect()->route('admin.banner.list');
        }
    }

    public function delete($id) {
        Banner::FindOrFail($id)->delete();
        return redirect()->back();
    }
}
