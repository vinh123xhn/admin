<div class="tab-news d-flex justify-content-center align-items-center">
    <a role="button" class="active" href="javascript:void(0)" id="new-click" aria-label="Tin tức"
       title="Hiệp Khách Giang Hồ - Yulgang Origin VTC">
        Tin tức
    </a>
    <a role="button" href="javascript:void(0)" id="event-click" aria-label="Sự kiện" title="Hiệp Khách Giang Hồ - Yulgang Origin VTC">
        Sự kiện
    </a>
    <div class="form-search">
        <form method="get" id="get-search">
            <div class="input-group">
                <input type="text" id="keyword" name="search" class="form-control bg-transparent"
                       placeholder="Tìm kiếm">
                <button class="btn" type="submit"><img src="{{asset('./assets/homepage/images/icon-search.png')}}"
                                                       class="img-fluid"
                                                       alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC"/></button>
            </div>
        </form>
    </div>
</div>
<div id="content-news" class="content-news">
    @foreach($posts as $k => $item)
        <div class="row">
            <div class="col-5 col-lg-3">
                <a role="button" class="thumb" href="{{route('tin_tuc_detail', ['post' => $item->title_domain])}}" title="">
                    <img src="{{$item['image']}}" class="img-fluid" alt="{{$item['image']}} - Hiệp Khách Giang Hồ - Yulgang Origin VTC"/>
                </a>
            </div>
            <div class="col-7 col-lg-7 p-0">
                <h2 class="title">
                    <a role="button" href="{{route('tin_tuc_detail', ['post' => $item->title_domain])}}"
                       title="{{ e($item->title) }} - Hiệp Khách Giang Hồ - Yulgang Origin VTC">
                        {{$item->title}}
                    </a>
                </h2>
                <p style="
                                                display: -webkit-box;
                                                -webkit-box-orient: vertical;
                                                -webkit-line-clamp: 1;
                                                overflow: hidden;
                                                text-overflow: ellipsis;" class="des">
                    {{$item->description}}</p>
            </div>
            <div class="col-2">
                <p class="date">{{\Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</p>
            </div>
        </div>
    @endforeach
    <ul class="pagination pagination-new justify-content-center">
        @if($posts->lastPage() > 1)
            <li class="page-item">
                <a role="button" class="page-link" href="javascript:void(0)" aria-label="Next page" onclick="pagination({{$posts->currentPage() - 1}})">
                    Trước
                </a>
            </li>
        @endif
        @for($i = 1; $i <= $posts->lastPage(); $i++)
            <li class="page-item">
                <a role="button" class="page-link {{$i == $posts->currentPage() ? 'active' : ''}}" href="javascript:void(0)" aria-label="Next page"
                   onclick="pagination({{$i}})">
                    {{$i}}
                </a>
            </li>
        @endfor
        @if($posts->currentPage() < $posts->lastPage())
            <li class="page-item">
                <a role="button" class="page-link" href="javascript:void(0)" onclick="pagination({{$posts->currentPage() + 1}})" aria-label="Next page">
                    Sau
                </a>
            </li>
        @endif
    </ul>
</div>
<script>
    $(document).ready(function () {
        $('#new-click').click(function () {
            // Sử dụng AJAX để lấy nội dung partial view
            $.ajax({
                url: '/index/tin-tuc',
                method: 'GET',
                success: function (response) {
                    // Chèn nội dung vào khu vực chỉ định
                    $('#post-data').html(response);
                },
                error: function () {
                    alert('Có lỗi xảy ra khi tải nội dung');
                }
            });
        });
        $('#event-click').click(function () {

            // Sử dụng AJAX để lấy nội dung partial view
            $.ajax({
                url: '/index/su-kien',
                method: 'GET',
                success: function (response) {
                    // Chèn nội dung vào khu vực chỉ định
                    $('#post-data').html(response);
                },
                error: function () {
                    alert('Có lỗi xảy ra khi tải nội dung');
                }
            });
        });
        $('#get-search').on('submit', function () {
            event.preventDefault();
            const keyword = $('#keyword').val();
            // Sử dụng AJAX để lấy nội dung partial view
            $.ajax({
                url: '/index/tim-kiem?keyword=' + keyword,
                method: 'GET',
                success: function (response) {
                    // Chèn nội dung vào khu vực chỉ định
                    $('#post-data').html(response);
                },
                error: function () {
                    alert('Có lỗi xảy ra khi tải nội dung');
                }
            });
        });
    });

    function pagination(page) {
        event.preventDefault();
        $.ajax({
            url: '/index/tin-tuc?page=' + page,
            method: 'GET',
            success: function (response) {
                // Chèn nội dung vào khu vực chỉ định
                $('#post-data').html(response);
            },
            error: function () {
                alert('Có lỗi xảy ra khi tải nội dung');
            }
        });
    }
</script>
