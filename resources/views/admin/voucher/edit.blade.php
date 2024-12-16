@extends('layout.admin.master')
@section('css')

@endsection
@section('title')
    Voucher
@endsection
@section('content_header_name')
    Sửa bài viết
@endsection
@section('redirect_to_list')
    <a role="button"href="{{route('admin.voucher.form.edit', $voucher->id)}}">
        Sửa bài viết
    </a>
@endsection
@section('content')
    <script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
    <div class="col-md-8">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Sửa voucher</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('admin.voucher.form.update', $voucher->id)}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="voucher_name" placeholder="Name" class="form-control" value="{{$voucher['voucher_name'] ? $voucher['voucher_name'] : old('voucher_name')}}">
                                @error('voucher_name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Code</label>
                                <input type="text" name="voucher_code" placeholder="Code" class="form-control" value="{{$voucher['voucher_code'] ? $voucher['voucher_code'] : old('voucher_code')}}">
                                @error('voucher_code')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Discount</label>
                                <input type="text" name="voucher_discount" placeholder="Discount" class="form-control" value="{{$voucher['voucher_discount'] ? $voucher['voucher_discount'] : old('voucher_discount')}}">
                                @error('voucher_discount')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a role="button"class="btn btn-primary" href="{{route('admin.voucher.list')}}">quay lại</a>
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
