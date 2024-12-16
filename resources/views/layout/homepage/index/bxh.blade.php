<!-- Nav pills -->
<ul class="nav nav-pills justify-content-center pt-3">
    <li class="nav-item px-1">
        <a role="button" class="nav-link canhan active" data-bs-toggle="pill" href="#canhan" title="Hiệp Khách Giang Hồ - Yulgang Origin VTC">
        </a>
    </li>
    {{--                        <li class="nav-item px-1">--}}
    {{--                            <a role="button" class="nav-link banghoi" data-bs-toggle="pill" href="#banghoi">--}}
    {{--                            </a>--}}
    {{--                        </li>--}}
    {{--                        <li class="nav-item px-1">--}}
    {{--                            <a role="button" class="nav-link vohuan" data-bs-toggle="pill" href="#vohuan">--}}
    {{--                            </a>--}}
    {{--                        </li>--}}
    {{--                        <li class="nav-item px-1">--}}
    {{--                            <a role="button" class="nav-link theluc" data-bs-toggle="pill" href="#theluc">--}}
    {{--                            </a>--}}
    {{--                        </li>--}}
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="canhan">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Hạng</th>
                <th>Nhân vật</th>
                <th>Cấp độ</th>
                <th> <span type="button" class="dropdown-toggle" data-bs-toggle="dropdown"> Server </span>
                    <ul class="dropdown-menu">
                        @foreach($servers as $k => $item)
                        <li>
                            <a role="button" class="dropdown-item" href="javascript:void(0)" aria-label="tên" onclick="changeServer({{$item->id}})">
                                {{$item->name}}
                            </a>
                        </li>
                        @endforeach
                        <li>
                            <a role="button" class="dropdown-item" href="#">
                                Coming soon
                            </a>
                        </li>
                    </ul>
                </th>
                <th> <span type="button" class="dropdown-toggle" data-bs-toggle="dropdown"> Phái </span>
                    <ul class="dropdown-menu">
                        @foreach(config('app.faction') as $k => $item)
                            <li>
                                <a role="button" class="dropdown-item" href="javascript:void(0)" aria-label="Thay đổi phe" onclick="changeFaction({{$k}})">
                                    {{$item}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </th>
                <th> <span type="button" class="dropdown-toggle" data-bs-toggle="dropdown"> Môn phái </span>
                    <ul class="dropdown-menu">
                        @foreach(config('app.class') as $k => $item)
                            <li>
                                <a role="button" class="dropdown-item" href="javascript:void(0)" onclick="changeClass({{$k}})" aria-label="Thay đổi phe">
                                    {{$item}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($ranks as $k => $item)
                <tr>
                    <td>{{($ranks->currentPage() - 1) * 10 + $k + 1}}</td>
                    <td>{{$item->role_name}}</td>
                    <td>{{$item->role_level}}</td>
                    <td>{{$item->server ? $item->server->name : ''}}</td>
                    <td>{{config('app.faction')[$item->role_faction]}}</td>
                    <td>{{config('app.class')[$item->role_class]}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <ul class="pagination justify-content-center mt-3">
            @if($ranks->lastPage() > 1)
                <li class="page-item">
                    <a role="button" class="page-link" href="javascript:void(0)" aria-label="Next Page" onclick="paginationBxh({{$ranks->currentPage() - 1}})">
                        Trước
                    </a>
                </li>
            @endif
            @for($i = 1; $i <= $ranks->lastPage(); $i++)
                @if($ranks->currentPage() <= 20)
                    @if($i <= 20)
                        <li class="page-item">
                            <a role="button" class="page-link {{$i == $ranks->currentPage() ? 'active' : ''}}" aria-label="Next Page" href="javascript:void(0)" onclick="paginationBxh({{$i}})">
                                {{$i}}
                            </a>
                        </li>
                    @endif
                @elseif($ranks->currentPage() > 20 && $ranks->currentPage() <= 40)
                    @if($i > 20 && $i <= 40)
                        <li class="page-item">
                            <a role="button" class="page-link {{$i == $ranks->currentPage() ? 'active' : ''}}" aria-label="Next Page" href="javascript:void(0)" onclick="paginationBxh({{$i}})">
                                {{$i}}
                            </a>
                        </li>
                    @endif
                @elseif($ranks->currentPage() > 40 && $ranks->currentPage() <= 60)
                    @if($i > 40 && $i <= 60)
                        <li class="page-item">
                            <a role="button" class="page-link {{$i == $ranks->currentPage() ? 'active' : ''}}" aria-label="Next Page" href="javascript:void(0)" onclick="paginationBxh({{$i}})">
                                {{$i}}
                            </a>
                        </li>
                    @endif
                @elseif($ranks->currentPage() > 60 && $ranks->currentPage() <= 80)
                    @if($i > 60 && $i <= 80)
                        <li class="page-item">
                            <a role="button" class="page-link {{$i == $ranks->currentPage() ? 'active' : ''}}" aria-label="Next Page" href="javascript:void(0)" onclick="paginationBxh({{$i}})">
                                {{$i}}
                            </a>
                        </li>
                    @endif
                @else
                    @if($i > 80)
                        <li class="page-item">
                            <a role="button" class="page-link {{$i == $ranks->currentPage() ? 'active' : ''}}" aria-label="Next Page" href="javascript:void(0)" onclick="paginationBxh({{$i}})">
                                {{$i}}
                            </a>
                        </li>
                    @endif
                @endif
            @endfor
            @if($ranks->currentPage() < $ranks->lastPage())
                <li class="page-item">
                    <a role="button" class="page-link" href="javascript:void(0)" aria-label="Next Page" onclick="paginationBxh({{$ranks->currentPage() + 1}})">
                        Sau
                    </a>
                </li>
            @endif
        </ul>
    </div>
    {{--                        <div class="tab-pane fade" id="banghoi">--}}
    {{--                            <table class="table table-striped">--}}
    {{--                                <thead>--}}
    {{--                                <tr>--}}
    {{--                                    <th>Hạng</th>--}}
    {{--                                    <th>Nhân vật</th>--}}
    {{--                                    <th>Cấp độ</th>--}}
    {{--                                    <th> <span type="button" class="dropdown-toggle" data-bs-toggle="dropdown"> Server </span>--}}
    {{--                                        <ul class="dropdown-menu">--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Server 1--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Server 2--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Server 3--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                        </ul>--}}
    {{--                                    </th>--}}
    {{--                                    <th> <span type="button" class="dropdown-toggle" data-bs-toggle="dropdown"> Phái </span>--}}
    {{--                                        <ul class="dropdown-menu">--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Phái 1--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Phái 2--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Phái 3--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                        </ul>--}}
    {{--                                    </th>--}}
    {{--                                    <th> <span type="button" class="dropdown-toggle" data-bs-toggle="dropdown"> Môn phái </span>--}}
    {{--                                        <ul class="dropdown-menu">--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Môn phái 1--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Môn phái 2--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Môn phái 3--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                        </ul>--}}
    {{--                                    </th>--}}
    {{--                                </tr>--}}
    {{--                                </thead>--}}
    {{--                                <tbody>--}}
    {{--                                <tr>--}}
    {{--                                    <td>1</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>2</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>3</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>4</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>5</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>6</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>7</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>8</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>9</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>10</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                </tbody>--}}
    {{--                            </table>--}}
    {{--                            <ul class="pagination justify-content-center mt-3">--}}
    {{--                                <li class="page-item disabled">--}}
    {{--                                    <a role="button" class="page-link" href="#">--}}
    {{--                                        Trước--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                                <li class="page-item">--}}
    {{--                                    <a role="button" class="page-link" href="#">--}}
    {{--                                        1--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                                <li class="page-item">--}}
    {{--                                    <a role="button" class="page-link active" href="#">--}}
    {{--                                        2--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                                <li class="page-item">--}}
    {{--                                    <a role="button" class="page-link" href="#">--}}
    {{--                                        3--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                                <li class="page-item">--}}
    {{--                                    <a role="button" class="page-link" href="#">--}}
    {{--                                        Sau--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                            </ul>--}}
    {{--                        </div>--}}
    {{--                        <div class="tab-pane fade" id="vohuan">--}}
    {{--                            <table class="table table-striped">--}}
    {{--                                <thead>--}}
    {{--                                <tr>--}}
    {{--                                    <th>Hạng</th>--}}
    {{--                                    <th>Nhân vật</th>--}}
    {{--                                    <th>Cấp độ</th>--}}
    {{--                                    <th> <span type="button" class="dropdown-toggle" data-bs-toggle="dropdown"> Server </span>--}}
    {{--                                        <ul class="dropdown-menu">--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Server 1--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Server 2--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Server 3--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                        </ul>--}}
    {{--                                    </th>--}}
    {{--                                    <th> <span type="button" class="dropdown-toggle" data-bs-toggle="dropdown"> Phái </span>--}}
    {{--                                        <ul class="dropdown-menu">--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Phái 1--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Phái 2--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Phái 3--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                        </ul>--}}
    {{--                                    </th>--}}
    {{--                                    <th> <span type="button" class="dropdown-toggle" data-bs-toggle="dropdown"> Môn phái </span>--}}
    {{--                                        <ul class="dropdown-menu">--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Môn phái 1--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Môn phái 2--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Môn phái 3--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                        </ul>--}}
    {{--                                    </th>--}}
    {{--                                </tr>--}}
    {{--                                </thead>--}}
    {{--                                <tbody>--}}
    {{--                                <tr>--}}
    {{--                                    <td>1</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>2</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>3</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>4</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>5</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>6</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>7</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>8</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>9</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>10</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                </tbody>--}}
    {{--                            </table>--}}
    {{--                            <ul class="pagination justify-content-center mt-3">--}}
    {{--                                <li class="page-item disabled">--}}
    {{--                                    <a role="button" class="page-link" href="#">--}}
    {{--                                        Trước--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                                <li class="page-item">--}}
    {{--                                    <a role="button" class="page-link" href="#">--}}
    {{--                                        1--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                                <li class="page-item">--}}
    {{--                                    <a role="button" class="page-link active" href="#">--}}
    {{--                                        2--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                                <li class="page-item">--}}
    {{--                                    <a role="button" class="page-link" href="#">--}}
    {{--                                        3--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                                <li class="page-item">--}}
    {{--                                    <a role="button" class="page-link" href="#">--}}
    {{--                                        Sau--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                            </ul>--}}
    {{--                        </div>--}}
    {{--                        <div class="tab-pane fade" id="theluc">--}}
    {{--                            <table class="table table-striped">--}}
    {{--                                <thead>--}}
    {{--                                <tr>--}}
    {{--                                    <th>Hạng</th>--}}
    {{--                                    <th>Nhân vật</th>--}}
    {{--                                    <th>Cấp độ</th>--}}
    {{--                                    <th> <span type="button" class="dropdown-toggle" data-bs-toggle="dropdown"> Server </span>--}}
    {{--                                        <ul class="dropdown-menu">--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Server 1--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Server 2--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Server 3--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                        </ul>--}}
    {{--                                    </th>--}}
    {{--                                    <th> <span type="button" class="dropdown-toggle" data-bs-toggle="dropdown"> Phái </span>--}}
    {{--                                        <ul class="dropdown-menu">--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Phái 1--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Phái 2--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Phái 3--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                        </ul>--}}
    {{--                                    </th>--}}
    {{--                                    <th> <span type="button" class="dropdown-toggle" data-bs-toggle="dropdown"> Môn phái </span>--}}
    {{--                                        <ul class="dropdown-menu">--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Môn phái 1--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Môn phái 2--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                            <li>--}}
    {{--                                                <a role="button" class="dropdown-item" href="#">--}}
    {{--                                                    Môn phái 3--}}
    {{--                                                </a>--}}
    {{--                                            </li>--}}
    {{--                                        </ul>--}}
    {{--                                    </th>--}}
    {{--                                </tr>--}}
    {{--                                </thead>--}}
    {{--                                <tbody>--}}
    {{--                                <tr>--}}
    {{--                                    <td>1</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>2</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>3</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>4</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>5</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>6</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>7</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>8</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>9</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>10</td>--}}
    {{--                                    <td>Ngọc Trinh</td>--}}
    {{--                                    <td>6996</td>--}}
    {{--                                    <td>Thiên Môn</td>--}}
    {{--                                    <td>Tà phái</td>--}}
    {{--                                    <td>Pháp sư</td>--}}
    {{--                                </tr>--}}
    {{--                                </tbody>--}}
    {{--                            </table>--}}
    {{--                            <ul class="pagination justify-content-center mt-3">--}}
    {{--                                <li class="page-item disabled">--}}
    {{--                                    <a role="button" class="page-link" href="#">--}}
    {{--                                        Trước--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                                <li class="page-item">--}}
    {{--                                    <a role="button" class="page-link" href="#">--}}
    {{--                                        1--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                                <li class="page-item">--}}
    {{--                                    <a role="button" class="page-link active" href="#">--}}
    {{--                                        2--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                                <li class="page-item">--}}
    {{--                                    <a role="button" class="page-link" href="#">--}}
    {{--                                        3--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                                <li class="page-item">--}}
    {{--                                    <a role="button" class="page-link" href="#">--}}
    {{--                                        Sau--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                            </ul>--}}
    {{--                        </div>--}}
</div>
