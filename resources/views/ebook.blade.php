
<!DOCTYPE html>
<html lang="vi" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Hiệp Khách Giang Hồ</title>
    <meta name="description" content="Hiệp Khách Giang Hồ" />
    <meta name="keywords" content="Hiệp Khách Giang Hồ" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" />
    <link href="./assets/ebook/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./assets/ebook/css/style.css">
    <link rel="stylesheet" href="./assets/ebook/css/aos.css">
    <link rel="stylesheet" href="./assets/ebook/css/swiper-bundle.min.css" />
    <script src="./assets/ebook/js/swiper-bundle.min.js"></script>
    <script src="./assets/ebook/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/ebook/js/jquery-1.9.1.min.js"></script>
    <script src="./assets/ebook/js/aos.js"></script>
    @include('head-tag')
</head>
<body>
@include('body-tag')

<div class="wrapper-guide">
    <section id="guide" class="section section-guide">
        <div class="row pt-5 m-0">
            <div class="col-3 bg-dark bg-opacity-50 py-3 px-1">
                <h1 class="text-center"><img src="./assets/ebook/images/logo-hkgh.png" class="img-fluid" alt="" /></h1>
                <p class="text-center">System guide</p>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs pb-2 border-0">
                    <li class="nav-item">
                        <a role="button"class="nav-link active" data-bs-toggle="tab" href="#tab_guide">Guide</a>
                    </li>
                    <li class="nav-item">
                        <a role="button"class="nav-link" data-bs-toggle="tab" href="#tab_search">Search</a>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content pt-1">
                    <div class="tab-pane active" id="tab_guide">
                        <div class="accordion" id="guide">
                            @foreach($categories as $k => $item)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading1">
                                        <button class="accordion-button collapsed py-2" type="button"
                                                data-bs-toggle="collapse" data-bs-target="{{'#collapse' . ($k + 1)}}" aria-expanded="false"
                                                aria-controls="{{'collapse' . ($k + 1)}}">{{$item->name}}
                                        </button>
                                    </h2>
                                    <div id="{{'collapse' . ($k + 1)}}" class="accordion-collapse collapse" aria-labelledby="heading1"
                                         data-bs-parent="#guide">
                                        <div class="accordion-body p-1">
                                            <ul class="p-0">
                                                @if(!empty($item['ebook']))
                                                    @foreach($item['ebook'] as $i => $post)
                                                        <li><a role="button"href="javascript:void(0)" onclick="post({{$post->id}})" title="">&rarrlp; {{$post->title}}</a></li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_search">
                        <div class="input-group mb-3 mt-4">
                            <input type="text" id="keyword" class="form-control" placeholder="Tìm kiếm...">
                            <button id="search-btn" class="btn btn-danger" type="button"><img src="./assets/ebook/images/icon-search.png" width="24" class="img-fluid" alt="" /></button>
                        </div>
                    </div>

                </div>
            </div>
            <div id="post-data" class="col-9 bg-dark bg-opacity-25">
                @include('layout.homepage.ebook.search')
            </div>
        </div>
    </section>

</div>

<script>
    function post(title) {
        event.preventDefault();
        $.ajax({
            url: 'api/get-posts-ebook?id=' + title,
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
    $(document).ready(function() {
        $('#search-btn').on('click', function() {
            event.preventDefault();
            const keyword = $('#keyword').val();
            // Sử dụng AJAX để lấy nội dung partial view
            $.ajax({
                url: 'api/get-posts-ebook?keyword=' + keyword,
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
    // function clickPost(title) {
    //     event.preventDefault();
    //     $.ajax({
    //         url: '/tin-tuc/event?page=' + page,
    //         method: 'GET',
    //         success: function(response) {
    //             // Chèn nội dung vào khu vực chỉ định
    //             $('#post-data').html(response);
    //         },
    //         error: function() {
    //             alert('Có lỗi xảy ra khi tải nội dung');
    //         }
    //     });
    // }
</script>
<script src="./assets/ebook/js/res-1.js"></script>
<script src="./assets/ebook/js/headroom.min.js"></script>
<script src="./assets/ebook/js/jQuery.headroom.min.js"></script>
</body>

</html>
