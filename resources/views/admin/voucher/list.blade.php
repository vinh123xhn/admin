@extends('layout.admin.master')
@section('css')
    <link rel="stylesheet" href="{{asset('/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('title')
    Voucher
@endsection
@section('content_header_name')
    Voucher
@endsection
@section('redirect_to_list')
    <a role="button"href="{{route('admin.voucher.list')}}">
        Danh sách
    </a>
@endsection
@section('content')
    <div class="col-md-12">
        <a role="button"class="btn btn-primary float-right" href="{{route('admin.voucher.form.get')}}">
            Tạo mới item
        </a>
    </div>
    <div class="card-body" style="width: 100%; overflow: scroll">
        <table id="product" class="table table-bordered table-striped" style="margin-top: 0">
            <thead>
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Code</th>
                <th>Discount</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($vouchers as $index => $item)
                <tr>
                    <td>{{$index + 1 }}</td>
                    <td>{{$item['voucher_name']}}</td>
                    <td>{{$item['voucher_code']}}</td>
                    <td>{{$item['voucher_discount']}}</td>
                    <td class="text-center">
                        <a role="button"href="{{route('admin.voucher.form.edit', $item->id)}}"><i class="fa fa-edit"></i></a>
                        <a role="button"href="{{route('admin.voucher.delete', $item->id)}}"><i class="fa fa-trash"></i></a>
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
