<div class="tab-news d-flex justify-content-center align-items-center">
    <a role="button"href="javascript:void(0)" id="new-click" title="">
        Tin tức
    </a>
    <a role="button"class="active" href="javascript:void(0)" id="event-click" title="">
        Sự kiện
    </a>
    <div class="form-search">
        <form id="get-search">
            <div class="input-group">
                <input type="text" id="keyword" name="search" class="form-control bg-transparent" placeholder="Tìm kiếm">
                <button class="btn" type="submit"><img src="{{asset('./assets/homepage/images/icon-search.png')}}" class="img-fluid" alt="" /></button>
            </div>
        </form>
    </div>
</div>
<div class="content-news details">
    <h1 class="title">
        <a role="button"href="#" title="">
            {{$post->title}}
        </a>
    </h1>
    <p class="date">{{Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</p>
    <hr />
    <div class="content-details text-start table-main">
        {!! $post->content !!}
        <a role="button"style="font-size: 18px; color: #84adea" href="{{route('tin_tuc_detail', $newPost->title_domain)}}" title="{{$newPost->title}}">- {{$newPost->title}}</a><br>
        <a role="button"style="font-size: 18px; color: #84adea" href="{{route('tin_tuc_detail', $eventPost->title_domain)}}" title="{{$eventPost->title}}">- {{$eventPost->title}}</a>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#new-click').click(function() {
            // Sử dụng AJAX để lấy nội dung partial view
            $.ajax({
                url: '/tin-tuc/new',
                method: 'GET',
                success: function(response) {
                    // Chèn nội dung vào khu vực chỉ định
                    $('#post-data').html(response);
                },
                error: function() {
                    alert('Có lỗi xảy ra khi tải nội dung');
                }
            });
        });
        $('#event-click').click(function() {

            // Sử dụng AJAX để lấy nội dung partial view
            $.ajax({
                url: '/tin-tuc/event',
                method: 'GET',
                success: function(response) {
                    // Chèn nội dung vào khu vực chỉ định
                    $('#post-data').html(response);
                },
                error: function() {
                    alert('Có lỗi xảy ra khi tải nội dung');
                }
            });
        });
        $('#get-search').on('submit', function() {
            event.preventDefault();
            const keyword = $('#keyword').val();
            // Sử dụng AJAX để lấy nội dung partial view
            $.ajax({
                url: '/tin-tuc/search?keyword=' + keyword,
                method: 'GET',
                success: function(response) {
                    // Chèn nội dung vào khu vực chỉ định
                    $('#post-data').html(response);
                },
                error: function() {
                    alert('Có lỗi xảy ra khi tải nội dung');
                }
            });
        });
    });
    function pagination(page) {
        event.preventDefault();
        $.ajax({
            url: '/tin-tuc/new?page=' + page,
            method: 'GET',
            success: function(response) {
                // Chèn nội dung vào khu vực chỉ định
                $('#post-data').html(response);
            },
            error: function() {
                alert('Có lỗi xảy ra khi tải nội dung');
            }
        });
    }
</script>
