<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index() {
        $posts = Post::with('category')->orderBy('created_at')->get();
        return view('admin.post.list')->with(compact('posts'));
    }

    public function getForm() {
        $categories = Category::all();
        return view('admin.post.form', ['categories' => $categories]);
    }

    public function saveForm(Request $request) {
        $rules = [
            'title' => 'required',
            'image' => 'required|max:30000',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ];

        $messages = [
            'title.required' => 'Tiêu đề không được để trống',
            'image.required' => 'Ảnh không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'content.required' => 'Nội dung không được để trống',
            'category_id.required' => 'Danh mục không được để trống',
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
            $data['title_domain'] = Str::slug($data['title'], '-');
            DB::beginTransaction();
            try {
                $post = Post::create($data);
                $post['title_domain'] = \Illuminate\Support\Str::slug($post['title']) . '-' . $post['id'];
                $post->save();
                if ($post['is_featured'] == 1) {
                    Cache::forget('new-launcher');
                    Cache::remember('new-launcher', 1440 * 60, function () {
                        Post::with('category')
                            ->where('is_featured', 1)
                            ->orderByDesc('created_at')
                            ->limit(4
                            )->get();
                    });
                }
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                Log::error('Lỗi ' . $exception->getMessage());
            }
            return redirect()->route('admin.post.list');
        }
    }

    public function editForm($id) {
        $post = Post::FindOrFail($id);
        $categories = Category::all();
        return view('admin.post.edit', ['post' => $post, 'categories' => $categories]);
    }

    public function updateForm(Request $request, $id) {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ];

        $messages = [
            'title.required' => 'Tiêu đề không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'content.required' => 'Nội dung không được để trống',
            'category_id.required' => 'Danh mục không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $post = Post::FindOrFail($id);
            $updateRequest = $request->all();
            if ($request->hasFile('image')) {
                //xoa anh cu neu co
                $currentImg = $post->image;
                if ($currentImg) {
                    Storage::delete('public/' . $currentImg);
                }
                //cap nhap anh moi
                $path = $request->file('image')->store('img', 'public');

                // Lấy đường dẫn của file đã lưu
                $url = Storage::url($path);
                $updateRequest['image'] = $url;
            }
            $updateRequest['title_domain'] = \Illuminate\Support\Str::slug($updateRequest['title']) . '-' . $post['id'];
            $updateRequest['is_featured'] = empty($updateRequest['is_featured']) ? 0 : $updateRequest['is_featured'];
            $post->update($updateRequest);
            if ($post['is_featured'] == 1) {
                Cache::forget('new-launcher');
                Cache::remember('new-launcher', 1440 * 60, function () {
                    Post::with('category')
                        ->where('is_featured', 1)
                        ->orderByDesc('created_at')
                        ->limit(4
                        )->get();
                });
            }
            return redirect()->route('admin.post.list');
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
        Post::FindOrFail($id)->delete();
        return redirect()->back();
    }


    function removeVietnameseAccents($str)
    {
        $vietnamese = [
            'à', 'á', 'ạ', 'ả', 'ã', 'â', 'ầ', 'ấ', 'ậ', 'ẩ', 'ẫ', 'ă', 'ằ', 'ắ', 'ặ', 'ẳ', 'ẵ',
            'đ',
            'è', 'é', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ề', 'ế', 'ệ', 'ể', 'ễ',
            'ì', 'í', 'ị', 'ỉ', 'ĩ',
            'ò', 'ó', 'ọ', 'ỏ', 'õ', 'ô', 'ồ', 'ố', 'ộ', 'ổ', 'ỗ', 'ơ', 'ờ', 'ớ', 'ợ', 'ở', 'ỡ',
            'ù', 'ú', 'ụ', 'ủ', 'ũ', 'ư', 'ừ', 'ứ', 'ự', 'ử', 'ữ',
            'ỳ', 'ý', 'ỵ', 'ỷ', 'ỹ',
            'À', 'Á', 'Ạ', 'Ả', 'Ã', 'Â', 'Ầ', 'Ấ', 'Ậ', 'Ẩ', 'Ẫ', 'Ă', 'Ằ', 'Ắ', 'Ặ', 'Ẳ', 'Ẵ',
            'Đ',
            'È', 'É', 'Ẹ', 'Ẻ', 'Ẽ', 'Ê', 'Ề', 'Ế', 'Ệ', 'Ể', 'Ễ',
            'Ì', 'Í', 'Ị', 'Ỉ', 'Ĩ',
            'Ò', 'Ó', 'Ọ', 'Ỏ', 'Õ', 'Ô', 'Ồ', 'Ố', 'Ộ', 'Ổ', 'Ỗ', 'Ơ', 'Ờ', 'Ớ', 'Ợ', 'Ở', 'Ỡ',
            'Ù', 'Ú', 'Ụ', 'Ủ', 'Ũ', 'Ư', 'Ừ', 'Ứ', 'Ự', 'Ử', 'Ữ',
            'Ỳ', 'Ý', 'Ỵ', 'Ỷ', 'Ỹ',
        ];

        $nonVietnamese = [
            'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
            'd',
            'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
            'i', 'i', 'i', 'i', 'i',
            'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o',
            'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u',
            'y', 'y', 'y', 'y', 'y',
            'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
            'd',
            'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
            'i', 'i', 'i', 'i', 'i',
            'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o',
            'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u',
            'y', 'y', 'y', 'y', 'y',
        ];

        $first = str_replace($vietnamese, $nonVietnamese, $str);
        $second =  preg_replace("/[[:punct:]]+/", "", $first);
        return str_replace(' ', '-', $second);
    }
}
