@extends('layout.admin.master')
@section('css')
    <link rel="stylesheet" href="{{asset('/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('title')
    Bài viết
@endsection
@section('content_header_name')
    Danh sách
@endsection
@section('redirect_to_list')
    <a role="button"href="{{route('admin.post.list')}}">
        Danh sách
    </a>
@endsection
@section('content')
    <div class="col-md-12">
        <a role="button"class="btn btn-primary float-right" href="{{route('admin.post.form.get')}}">
            Tạo mới item
        </a>
    </div>
    <div class="card-body" style="width: 100%; overflow: scroll">
        <table id="product" class="table table-bordered table-striped" style="margin-top: 0">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Link</th>
                <th>Ảnh</th>
                <th>Danh mục</th>
                <th>Tin Launcher</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $index => $item)
                <tr>
                    <td>{{$index + 1 }}</td>
                    <td>{{$item['title']}}</td>
                    <td><a role="button"target="_blank" href="{{!empty($item['category']['parent_id']) ? config('app.domain_by_category')[$item['category']['parent_id']] . '/' . $item['title_domain'] . '.html' : (isset(config('app.domain_by_category')[$item['category_id']]) ? config('app.domain_by_category')[$item['category_id']] . '/' . $item['title_domain'] . '.html' : '')}}">{{!empty($item['category']['parent_id']) ? config('app.domain_by_category')[$item['category']['parent_id']] . '/' . $item['title_domain'] . '.html' : (isset(config('app.domain_by_category')[$item['category_id']]) ? config('app.domain_by_category')[$item['category_id']] . '/' . $item['title_domain'] . '.html' : '')}}</a></td>
                    <td>
                        <img style="width: 100px; height: 100px" src="{{$item->image}}">
                    </td>
                    <td>{{$item->category->name}}</td>
                    <td>{{$item->is_featured ? 'Có' : 'Không'}}</td>
                    <td>{{config('base.active')[$item->active]}}</td>
                    <td class="text-center">
                        <a role="button"href="{{route('admin.post.form.edit', $item->id)}}"><i class="fa fa-edit"></i></a>
                        <a role="button"href="{{route('admin.post.delete', $item->id)}}"><i class="fa fa-trash"></i></a>
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
