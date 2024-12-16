@extends('layout.admin.master')
@section('css')

@endsection
@section('title')
    Ảnh Launcher
@endsection
@section('content_header_name')
    Sửa ảnh
@endsection
@section('redirect_to_list')
    <a role="button"href="{{route('admin.image-launcher.form.edit', $image->id)}}">
        Sửa ảnh
    </a>
@endsection
@section('content')
    <script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
    <div class="col-md-8">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Sửa ảnh</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('admin.image-launcher.form.update', $image->id)}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ảnh Icon</label>
                                <input type='file' onchange="readURL(this);" name="image"/>
                                <br>
                                <img id="image" style="width: 200px; height: 200px" src="{{!empty($image->image) ? $image->image : '#'}}" alt="image"/>
                                @error('image')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Loại</label>
                                <select class="form-control" name="type" id="type" style="width: 100%;">
                                    <option  @if($image->active == 1)
                                                 {{"selected"}}
                                             @endif
                                             value="1">Ảnh nhỏ</option>
                                    <option  @if($image->active == 2)
                                                 {{"selected"}}
                                             @endif
                                             value="2">Ảnh to</option>
                                </select>
                                @error('type')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Đường dẫn</label>
                                <input type="text" name="link" placeholder="Đường dẫn bài viết" class="form-control" value="{{$image['link'] ? $image['link'] : old('link')}}">
                                @error('link')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a role="button"class="btn btn-primary" href="{{route('admin.image-launcher.list')}}">quay lại</a>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection
@section('js')
    <script>
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
