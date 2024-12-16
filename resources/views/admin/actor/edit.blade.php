@extends('layout.admin.master')
@section('css')

@endsection
@section('title')
    Nhân vật
@endsection
@section('content_header_name')
    Sửa nhân vật
@endsection
@section('redirect_to_list')
    <a role="button"href="{{route('admin.actor.form.edit', $actor->id)}}">
        Sửa nhân vật
    </a>
@endsection
@section('content')
    <script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
    <div class="col-md-8">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Sửa nhân vật</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('admin.actor.form.update', $actor->id)}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên</label>
                                <input type="text" name="name" placeholder="Tên" class="form-control" value="{{$actor['name'] ? $actor['name'] : old('name')}}">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nội dung</label>
                                <textarea name="content" placeholder="Nhập đường dẫn" class="form-control">
                                    {{$actor['content'] ? $actor['content'] : old('content')}}
                                </textarea>
                                @error('content')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ảnh tên nhân vật</label>
                                <input type='file' onchange="readURL(this);" name="image_name"/>
                                <br>
                                <img id="image_name" style="width: 200px; height: 200px" src="{{$actor->image_name}}" alt="image_name"/>
                                @error('image_name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ảnh kỹ năng</label>
                                <input type='file' onchange="readURL(this);" name="image_art"/>
                                <br>
                                <img id="image_art" style="width: 200px; height: 200px" src="{{$actor->image_art}}" alt="image_art"/>
                                @error('image_art')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ảnh nhân vật</label>
                                <input type='file' onchange="readURL(this);" name="image_skill"/>
                                <br>
                                <img id="image_skill" style="width: 200px; height: 200px" src="{{$actor->image_skill}}" alt="image_skill"/>
                                @error('image_skill')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ảnh Slide</label>
                                <input type='file' onchange="readURL(this);" name="image_hover"/>
                                <br>
                                <img id="image_hover" style="width: 200px; height: 200px" src="{{$actor->image_hover}}" alt="image_hover"/>
                                @error('image_hover')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a role="button"class="btn btn-primary" href="{{route('admin.actor.list')}}">quay lại</a>
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
