<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::with('parent')->orderBy('created_at')->get();
        return view('admin.category.list')->with(compact('categories'));
    }

    public function getForm() {
        $categories = Category::all();
        return view('admin.category.form', ['categories' => $categories]);
    }

    public function saveForm(Request $request) {
        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name.required' => 'Tên danh mục không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $data = $request->all();
            DB::beginTransaction();
            try {
                Category::create($data);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                Log::error('Lỗi ' . $exception->getMessage());
            }
            return redirect()->route('admin.category.list');
        }
    }

    public function editForm($id) {
        $category = Category::FindOrFail($id);
        $categories = Category::where('id', '!=', $id)->get();
        return view('admin.category.edit', ['category' => $category, 'categories' => $categories]);
    }

    public function updateForm(Request $request, $id) {
        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name.required' => 'tên danh mục không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $category = Category::FindOrFail($id);
            $updateRequest = $request->all();
            if(empty($updateRequest['parent_id'])) $updateRequest['parent_id'] = null;
            $category->update($updateRequest);
            return redirect()->route('admin.category.list');
        }
    }

//    public function exportData() {
////        field => title
//        $exportFields = [
//            'name' => __('Họ và tên'),
//            'gender' => __('Giới tính'),
//            'gender' => __('Giới tính'),
//            'birthday' => __('Ngày sinh'),
//            'address' => __('địa chỉ'),
//            'district_id' => __('Quận/ huyện'),
//            'commune_id' => __('Phường/ xã'),
//            'phone' => __('Số điện thoại'),
//            'email' => __('Thư điện tử'),
//            'school_id' => __('Đang học tại trường'),
//            'type_school' => __('Cấp'),
//            'type_teacher' => __('Chức vụ'),
//            'level' => __('Trình độ học vấn'),
//        ];
//        $teachers = Personnel::with('district', 'commune', 'school')->orderBy('created_at', 'desc')->get();
//        $gender = config('base.gender');
//        $type_school = config('base.type_of_school');
//        $level = config('base.level_of_teacher');
//        $type_teacher = config('base.type_of_teacher');
//
//        $data = [];
//        foreach ($teachers as $item) {
//            $item['gender'] = $item->gender ? $gender[$item->gender] : '';
//            $item['district_id'] = $item['district'] ['name'];
//            $item['commune_id'] = $item['commune'] ['name'];
//            $item['school_id'] = $item['school']['name'];
//            $item['type_school'] = $item->type_school ? $type_school[$item->type_school] : '';
//            $item['type_teacher'] = $item->type_teacher ? $type_teacher[$item->type_teacher] : '';
//            $item['level'] = $item->level ? $level[$item->level] : '';
//
//            $item = $item->toArray();
//            $data[] = $item;
//        }
//        $this->downloadExcel('Nhân sự data'.date('Y-m-d'), $exportFields, $data, 'Nhân sự-'.date('Y-m-d').'.xlsx');
//    }

    public function delete($id) {
        Category::FindOrFail($id)->delete();
        return redirect()->back();
    }
}
