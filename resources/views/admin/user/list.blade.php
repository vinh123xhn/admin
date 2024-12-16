@extends('layout.admin.master')
@section('css')
    <link rel="stylesheet" href="./assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css'">
@endsection
@section('user', 'active')
@section('title')
    user
@endsection
@section('content_header_name')
    Danh sách người dùng
@endsection
@section('redirect_to_list')
    <a role="button"href="{{route('admin.user.list')}}">
        Danh sách người dùng
    </a>
@endsection
@section('content')
    <div class="col-md-12">
        <a role="button"class="btn btn-primary float-right" href="{{route('admin.user.form.get')}}">
            Tạo mới người dùng
        </a>
    </div>
    <div class="card-body">
        <table id="user" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Tên </th>
                <th>Tên đăng nhập </th>
                <th>Thư điện tử</th>
                <th>Nhóm</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $item)
                @csrf
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->username}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{config('base.level_of_user')[$item->group]}}</td>
                    <td>{{config('base.active')[$item->active]}}</td>
                    <td class="text-center">
                        <a role="button"href="{{route('admin.user.form.edit', $item->id)}}"><i class="fa fa-edit"></i></a>
                        @if(auth()->user()->group == GROUP_ADMIN)
                            <a role="button"href="{{route('admin.user.delete', $item->id)}}"><i class="fa fa-trash"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('js')
    <script src="{{'/assets/plugins/datatables/jquery.dataTables.js'}}"></script>
    <script src="{{'/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js'}}"></script>

    <script>
        $(function () {
            $('#user').DataTable();
        });
    </script>
@endsection
