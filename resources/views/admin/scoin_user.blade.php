@extends('layout.master')
@section('scoin_user-open', 'menu-open')
@section('scoin_user-list', 'active')
@section('scoin_user', 'active')
@section('css')
    <link rel="stylesheet" href="{{asset('/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('title')
    Danh sách Scoin
@endsection
@section('content_header_name')
    Danh sách Scoin
@endsection
@section('content')
    <div class="col-md-12">
        <a role="button"class="btn btn-primary float-right" onclick="fnExcelReport()" style="margin-right: 5px; color: white">
            Tải xuống Excel
        </a>
    </div>
    <div class="card-body" style="width: 100%; overflow: scroll">
        <table id="product" class="table table-bordered table-striped" style="margin-top: 0">
            <thead>
            <tr>
                <th>STT</th>
                <th>Scoin ID</th>
                <th>Scoin Name</th>
                <th>First Login</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $index => $item)
                <tr>
                    <td>{{$index + 1 }}</td>
                    <td>{{$item['id']}}</td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['first_login']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <table id="product2" class="table table-bordered table-striped" style="margin-top: 0; display: none">
            <thead>
            <tr>
                <th>STT</th>
                <th>Scoin ID</th>
                <th>Scoin Name</th>
                <th>First Login</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $index => $item)
                <tr>
                    <td>{{$index + 1 }}</td>
                    <td>{{$item['id']}}</td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['first_login']}}</td>
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
        function fnExcelReport()
        {
            var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
            var textRange; var j=0;
            tab = document.getElementById('product2'); // id of table

            for(j = 0 ; j < tab.rows.length ; j++)
            {
                tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
                //tab_text=tab_text+"</tr>";
            }

            tab_text=tab_text+"</table>";
            tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
            tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
            tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

            var ua = window.navigator.userAgent;
            var msie = ua.indexOf("MSIE ");

            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
            {
                txtArea1.document.open("txt/html","replace");
                txtArea1.document.write(tab_text);
                txtArea1.document.close();
                txtArea1.focus();
                sa=txtArea1.document.execCommand("SaveAs",true,"Danh Sách Quà Điểm Danh.xls");
            }
            else                 //other browser not tested on IE 11
                sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

            return (sa);
        }
    </script>
@endsection
