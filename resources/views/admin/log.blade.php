@extends('layout.master')
@section('log-open', 'menu-open')
@section('log-list', 'active')
@section('log', 'active')
@section('css')
    <link rel="stylesheet" href="{{asset('/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('title')
    Danh sách nhận quà
@endsection
@section('content_header_name')
    Danh sách nhận quà
@endsection
@section('content')
    <div class="card-body" style="width: 100%; overflow: scroll">
        <table id="product" class="table table-bordered table-striped" style="margin-top: 0">
            <thead>
            <tr>
                <th>STT</th>
                <th>Scoin ID</th>
                <th>Scoin Name</th>
                <th>Loại quà</th>
                <th>giftcode</th>
                <th>Thời gian</th>
            </tr>
            </thead>
            <tbody>
            @foreach($logs as $index => $item)
                <tr>
                    <td>{{$index + 1 }}</td>
                    <td>{{!empty($item['scoin']) ? $item['scoin']['id'] : ''}}</td>
                    <td>{{!empty($item['scoin']) ? $item['scoin']['name'] : ''}}</td>
                    <td>{{$item['type'] ? config('base.giftcode_type')[$item['type']] : ''}}</td>
                    <td>{{$item['giftcode']}}</td>
                    <td>{{date('d-m-Y H:i:s', strtotime($item['created_at']))}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('js')
    <script src="{{asset('/assets/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
        $(function () {
            $('#product').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ]
            });
        });
    </script>
@endsection
