@extends('layout.admin.master')
@section('css')
    <link rel="stylesheet" href="{{asset('/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('title')
    Ảnh Launcher
@endsection
@section('content_header_name')
    Danh sách
@endsection
@section('redirect_to_list')
    <a role="button"href="{{route('admin.image-launcher.list')}}">
        Danh sách
    </a>
@endsection
@section('content')
    <div class="col-md-12">
        <a role="button"class="btn btn-primary float-right" href="{{route('admin.image-launcher.form.get')}}">
            Tạo mới item
        </a>
    </div>
    <div class="card-body" style="width: 100%; overflow: scroll">
        <table id="product" class="table table-bordered table-striped" style="margin-top: 0">
            <thead>
            <tr>
                <th>STT</th>
                <th>Ảnh</th>
                <th>Phân loại</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($images as $index => $item)
                <tr>
                    <td>{{$index + 1 }}</td>
                    <td>
                        <img style="width: 100px; height: 100px" src="{{$item->image}}">
                    </td>
                    <td>{{config('app.image-launcher')[$item->type]}}</td>
                    <td class="text-center">
                        <a role="button"href="{{route('admin.image-launcher.form.edit', $item->id)}}"><i class="fa fa-edit"></i></a>
                        <a role="button"href="{{route('admin.image-launcher.delete', $item->id)}}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('js')
    <script src="{{asset('/assets/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

    <script>
        $(function () {
            $('#product').DataTable();
        });
    </script>
@endsection
