<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\ImageLauncher;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageLauncherController extends Controller
{
    public function index() {
        $images = ImageLauncher::orderBy('created_at')->get();
        return view('admin.image-launcher.list')->with(compact('images'));
    }

    public function getForm() {
        return view('admin.image-launcher.form');
    }

    public function saveForm(Request $request) {
        $rules = [
            'image' => 'required|max:30000',
            'type' => 'required',
        ];

        $messages = [
            'image.required' => 'Ảnh không được để trống',
            'type.required' => 'Loại ảnh không được để trống',
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
                ImageLauncher::create($data);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                Log::error('Lỗi ' . $exception->getMessage());
            }
            return redirect()->route('admin.image-launcher.list');
        }
    }

    public function editForm($id) {
        $image = ImageLauncher::FindOrFail($id);
        return view('admin.image-launcher.edit', ['image' => $image]);
    }

    public function updateForm(Request $request, $id) {
        $rules = [
            'image' => 'required|max:30000',
            'type' => 'required',
        ];

        $messages = [
            'image.required' => 'Ảnh không được để trống',
            'type.required' => 'Loại ảnh không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $image = ImageLauncher::FindOrFail($id);
            $updateRequest = $request->all();
            if ($request->hasFile('image')) {
                //xoa anh cu neu co
                $currentImg = $image->image;
                if ($currentImg) {
                    Storage::delete('public/' . $currentImg);
                }
                //cap nhap anh moi
                $path = $request->file('image')->store('img', 'public');

                // Lấy đường dẫn của file đã lưu
                $url = Storage::url($path);
                $updateRequest['image'] = $url;
            }
            $image->update($updateRequest);
            return redirect()->route('admin.image-launcher.list');
        }
    }

    public function delete($id) {
        ImageLauncher::FindOrFail($id)->delete();
        return redirect()->back();
    }
}
