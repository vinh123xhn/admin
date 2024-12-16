@extends('layout.admin.master')
@section('css')

@endsection
@section('title')
    Bài viết
@endsection
@section('content_header_name')
    Sửa bài viết
@endsection
@section('redirect_to_list')
    <a role="button"href="{{route('admin.post.form.edit', $post->id)}}">
        Sửa bài viết
    </a>
@endsection
@section('content')
    <script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
    <div class="col-md-8">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Sửa bài viết</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('admin.post.form.update', $post->id)}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tiêu đề</label>
                                <input type="text" name="title" placeholder="Tiêu đề bài viết" class="form-control" value="{{$post['title'] ? $post['title'] : old('title')}}">
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục</label>
                                <select class="form-control select2" name="category_id" id="category_id" style="width: 100%;">
                                    @foreach($categories as $k => $item)
                                        <option @if($post['category_id'] == $item->id)
                                                    {{"selected"}}
                                                @endif value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả</label>
                                <textarea name="description" placeholder="Mô tả bài viết" class="form-control" rows="5">{{$post['description'] ? $post['description'] : old('description')}}</textarea>
                                @error('description')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ảnh Icon</label>
                                <input type='file' onchange="readURL(this);" name="image"/>
                                <br>
                                <img id="image" style="width: 200px; height: 200px" src="{{!empty($post->image) ? $post->image : '#'}}" alt="image"/>
                                @error('image')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nội dung</label>
                                <textarea id="editor" name="content" rows="10">{{$post['content'] ? $post['content'] : old('content')}}</textarea>
                                @error('content')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Trạng thái</label>
                                <select class="form-control" name="active" id="active" style="width: 100%;">
                                    <option  @if($post->active == 0)
                                                 {{"selected"}}
                                             @endif
                                             value="0">Disable</option>
                                    <option  @if($post->active == 1)
                                                 {{"selected"}}
                                             @endif
                                             value="1">Active</option>
                                </select>
                                @error('active')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch1" name="is_featured" value="1" {{ $post->is_featured == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customSwitch1">Bài viết đăng trên launcher?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a role="button"class="btn btn-primary" href="{{route('admin.post.list')}}">quay lại</a>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection
@section('js')
    <script src="{{asset('/assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace( 'editor', {

            filebrowserBrowseUrl     : "{{ route('ckfinder_browser') }}",
            filebrowserImageBrowseUrl: "{{ route('ckfinder_browser') }}?type=Images&token=123",
            filebrowserFlashBrowseUrl: "{{ route('ckfinder_browser') }}?type=Flash&token=123",
            filebrowserUploadUrl     : "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files",
            filebrowserImageUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Images",
            filebrowserFlashUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Flash",
        } );
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#'+input.name)
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
