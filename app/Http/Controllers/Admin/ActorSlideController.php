<?php

namespace App\Http\Controllers\Admin;

use App\Models\ActorSlide;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ActorSlideController extends Controller
{
    public function index() {
        $actors = ActorSlide::orderBy('created_at')->get();
        return view('admin.actor.list')->with(compact('actors'));
    }

    public function getForm() {
        return view('admin.actor.form');
    }

    public function saveForm(Request $request) {
        $rules = [
            'name' => 'required',
            'image_name' => 'required|max:30000',
            'image_art' => 'required|max:30000',
            'image_skill' => 'required|max:30000',
            'image_hover' => 'required|max:30000',
        ];

        $messages = [
            'name.required' => 'Tên không được để trống',
            'image_name.required' => 'Ảnh không được để trống',
            'image_art.required' => 'Ảnh không được để trống',
            'image_skill.required' => 'Ảnh không được để trống',
            'image_hover.required' => 'Ảnh không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $data = $request->all();
            $path1 = $request->file('image_name')->store('img', 'public');
            $path2 = $request->file('image_art')->store('img', 'public');
            $path3 = $request->file('image_skill')->store('img', 'public');
            $path4 = $request->file('image_hover')->store('img', 'public');
            // Lấy đường dẫn của file đã lưu
            $url1 = Storage::url($path1);
            $url2 = Storage::url($path2);
            $url3 = Storage::url($path3);
            $url4 = Storage::url($path4);

            $data['image_name'] = $url1;
            $data['image_art'] = $url2;
            $data['image_skill'] = $url3;
            $data['image_hover'] = $url4;
            DB::beginTransaction();
            try {
                ActorSlide::create($data);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                Log::error('Lỗi ' . $exception->getMessage());
            }
            return redirect()->route('admin.actor.list');
        }
    }

    public function editForm($id) {
        $actor = ActorSlide::FindOrFail($id);
        return view('admin.actor.edit', ['actor' => $actor]);
    }

    public function updateForm(Request $request, $id) {
        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name.required' => 'Tên không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $actor = ActorSlide::FindOrFail($id);
            $updateRequest = $request->all();

            if ($request->hasFile('image_name')) {
                //xoa anh cu neu co
                $currentImg = $actor->image_name;
                if ($currentImg) {
                    Storage::delete('public/' . $currentImg);
                }
                //cap nhap anh moi
                $path1 = $request->file('image_name')->store('img', 'public');

                // Lấy đường dẫn của file đã lưu
                $url1 = Storage::url($path1);

                $updateRequest['image_name'] = $url1;
            }
            if ($request->hasFile('image_art')) {
                //xoa anh cu neu co
                $currentImg = $actor->image_art;
                if ($currentImg) {
                    Storage::delete('public/' . $currentImg);
                }
                //cap nhap anh moi
                $path2 = $request->file('image_art')->store('img', 'public');

                // Lấy đường dẫn của file đã lưu
                $url2 = Storage::url($path2);

                $updateRequest['image_art'] = $url2;
            }
            if ($request->hasFile('image_skill')) {
                //xoa anh cu neu co
                $currentImg = $actor->image_skill;
                if ($currentImg) {
                    Storage::delete('public/' . $currentImg);
                }
                //cap nhap anh moi
                $path3 = $request->file('image_skill')->store('img', 'public');

                // Lấy đường dẫn của file đã lưu
                $url3 = Storage::url($path3);

                $updateRequest['image_skill'] = $url3;
            }
            if ($request->hasFile('image_hover')) {
                //xoa anh cu neu co
                $currentImg = $actor->image_hover;
                if ($currentImg) {
                    Storage::delete('public/' . $currentImg);
                }
                //cap nhap anh moi
                $path4 = $request->file('image_hover')->store('img', 'public');

                // Lấy đường dẫn của file đã lưu
                $url4 = Storage::url($path4);

                $updateRequest['image_hover'] = $url4;
            }
            $actor->update($updateRequest);
            return redirect()->route('admin.actor.list');
        }
    }

    public function delete($id) {
        ActorSlide::FindOrFail($id)->delete();
        return redirect()->back();
    }
}
