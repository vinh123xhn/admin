@extends('layout.homepage.master')
@section('custom-header')
    <title>Hiệp Khách Giang Hồ - Yulgang Origin VTC</title>
    <meta name="description" content="Hiệp Khách Giang Hồ - Yulgang Origin VTC, tựa game kiếm hiệp huyền thoại, đã trở lại với các hệ phái mới và các sự kiện độc quyền. Tải và chơi ngay hôm nay." />
    <meta name="keywords" content="{{keywords()}}">
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:site_name" content="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
    <meta property="og:title" content="Hiệp Khách Giang Hồ - Yulgang Origin VTC - Game Kiếm Hiệp Huyền Thoại" />
{{--    <meta property="og:image" content="{tìm ảnh sao cho phù hợp với các trang như trang chủ/sự kiện/cẩm nang,... cần thiết thì yêu cầu thiết kế, các trang bài viết thì hiển thị thumbnail }" />--}}
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
@endsection
@section('main-body')
    <div class="wrapper">
        <section id="frame1" class="section section-frame1">
            <div class="section-background">
                <img src="./assets/homepage/images/bg-page1.webp" class="img-fluid d-none d-lg-block" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                <img src="./assets/homepage/images/bg-page1-m.webp" class="img-fluid d-block d-lg-none" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
            </div>
            <div class="section-content">
                <div class="art-main d-none d-lg-block" data-aos="fade-left" data-aos-duration="1000">
                    <img src="./assets/homepage/images/art-main.png" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                </div>
                <div class="container overflow-hidden">
                    <div class="main-s1 d-flex justify-content-start">
                        @include('trang-chu.menu')
                        <div class="main-s1-right">
                            <div class="banner" data-aos="fade-left" data-aos-duration="1000">
                                <!-- Swiper -->
                                <div class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                        @foreach($banners as $k => $item)
                                            <div class="swiper-slide">
                                                <a role="button"href="{{$item->link}}"><img style="margin: 0 auto;" src="{{$item->image}}" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" /></a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination">
                                    </div>
                                </div>
                                <!--End Swiper -->
                            </div>
                            <div class="news" id="post-data" data-aos="fade-up" data-aos-duration="1000">
                                @include('layout.homepage.index.new')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="frame2" class="section section-frame2">
            <div class="section-background">
                <img src="./assets/homepage/images/bg-page2.jpg" class="img-fluid d-none d-lg-block" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                <img src="./assets/homepage/images/bg-page2-m.jpg" class="img-fluid d-block d-lg-none" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
            </div>
            <div class="section-content">
                <h4 class="title-page2 text-center" data-aos="fade-up" data-aos-duration="1000"><img src="./assets/homepage/images/title-hoatdong.png" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" /></h4>
                <div class="content-hoatdong" data-aos="flip-left" data-aos-duration="1000">
                    @foreach($activities as $k => $item)
                        <div class="d-flex justify-content-center align-items-start item {{'item' . ($k+1)}}">
                            <div class="left">
                                <h2 class="title">
                                    <a role="button"href="{{!empty($item->link) ? $item->link : 'javascript:void(0)'}}" title="">
                                        {{$item->name}}
                                    </a>
                                </h2>
                                <p class="status">Đang diễn ra</p>
                            </div>
                            <div class="center px-4">
                                <img src="./assets/homepage/images/ic-square.png" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                            </div>
                            <div class="right">
                                {{$item->time}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section id="frame3" class="section section-frame3">
            <div class="section-background">
                <img src="./assets/homepage/images/bg-page3.webp" class="img-fluid d-none d-lg-block" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                <img src="./assets/homepage/images/bg-page3-m.jpg" class="img-fluid d-block d-lg-none" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
            </div>
            <div class="section-content">
                <h4 class="title-page3 text-center" data-aos="fade-up" data-aos-duration="1000"><img src="./assets/homepage/images/title-bxh.png" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" /></h4>
                <div id="bxh-data" class="bxh-content" data-aos="flip-up" data-aos-duration="1000">
                    @include('layout.homepage.index.bxh')
                </div>
            </div>
        </section>
        <section id="frame4" class="section section-frame4">
            <div class="section-background">
                <img src="./assets/homepage/images/bg-page4.jpg" class="img-fluid d-none d-lg-block" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                <img src="./assets/homepage/images/bg-page4-m.jpg" class="img-fluid d-block d-lg-none" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
            </div>
            <div class="section-content">
                <h4 class="title-page4 text-center" data-aos="fade-up" data-aos-duration="1000"><img src="./assets/homepage/images/title-hethong.png" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" /></h4>
                <div class="content-monphai container" data-aos="fade-up" data-aos-duration="1000">
                    <div class="main">
                        <!-- Swiper -->
                        <div class="swiper mySwiper2">
                            <div class="swiper-wrapper">
                                @foreach($actors as $k => $item)
                                    <div class="swiper-slide">
                                        <div class="monphai frame d-flex justify-content-between">
                                            <div class="description">
                                                <h2><img src="{{$item->image_name}}" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" /></h2>
                                                <p style="display: -webkit-box;
                                                -webkit-line-clamp:
                                                6;-webkit-box-orient: vertical;
                                                overflow: hidden;
                                                text-overflow: ellipsis;">{{$item->content}}</p>
                                                <div class="skill">
                                                    <img src="{{$item->image_art}}" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                                                </div>
                                            </div>
                                            <div class="thumb">
                                                <img src="{{$item->image_skill}}" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="thumb-slider">
                        <div thumbsSlider="" class="swiper mySwiper1">
                            <div class="swiper-wrapper">
                                @foreach($actors as $k => $item)
                                    <div class="swiper-slide">
                                        <img src="{{$item->image_hover}}" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-button-next">
                            <img src="./assets/homepage/images/arr-right.png" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                        </div>
                        <div class="swiper-button-prev">
                            <img src="./assets/homepage/images/arr-left.png" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="footer news">
            <div class="container">
                <div class="social d-flex justify-content-center pb-3">
                    <a role="button"href="https://www.facebook.com/profile.php?id=61560993501166" target="_blank" title="Facebook">
                        <img src="{{asset('./assets/homepage/images/icon-facebook-footer.png')}}" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                    </a>
                    <a role="button"href="https://www.facebook.com/groups/hiepkhachvtc.vn" target="_blank" title="Group">
                        <img src="{{asset('./assets/homepage/images/icon-group-footer.png')}}" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                    </a>
                    <a role="button"href="https://www.youtube.com/@hiepkhachgianghovtc" target="_blank" title="Youtube">
                        <img src="{{asset('./assets/homepage/images/icon-ytb-footer.png')}}" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                    </a>
                    <a role="button"href="https://www.tiktok.com/@hkghvtc88" target="_blank" title="Tiktok">
                        <img src="{{asset('./assets/homepage/images/icon-tiktok-footer.png')}}" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                    </a>
                </div>
                <div class="row align-items-center">
                    <h2 class=" text-end col-6"><img src="{{asset('./assets/homepage/images/logo-vtcmobile.png')}}" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                        <img src="{{asset('./assets/homepage/images/sep-lg-footer.png')}}" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                        <img src="{{asset('./assets/homepage/images/logo-mgame.png')}}" class="img-fluid" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                    </h2>
                    <div class="col-6 text-start text-footer">
                        <p class="mb-0">Công ty cổ phần VTC dịch vụ di động - Tầng 11 - Tòa nhà VTC Online, số 18 Tam
                            Trinh phường
                            Minh Khai, quận Hai Bà Trưng, Hà Nội</p>
                        <p class="mb-0">SĐT: (84-4).39877470 Email: vtcmobile@vtc.vn</p>
                        <p class="mb-0">Giấy phép phê duyệt nội dung kịch bản trò chơi điện tử trên mạng số 1595/GĐ-BTTTT </p>
                        <p class="mb-0">Người chịu trách nhiệm quản lý nội dung: Ông Nguyễn Viết Quang Minh</p>
                        <p class="mb-0"><a role="button"class="text-white" href="https://vtcmobile.vn" title="Vtc Mobile">Phát hành bởi VTC Mobile</a></p>
                        <p class="mb-0 text-info">
                            <a role="button"class="text-info text-decoration-none" href="https://hiepkhach.vtczone.vn/huong-dan/chinh-sach-bao-mat-thong-tin-88.html" title="Chính sách bảo mật">
                                Chính
                                sách
                                bảo
                                mật
                            </a>
                            -
                            <a role="button"class="text-info text-decoration-none" href="https://hiepkhach.vtczone.vn/huong-dan/huong-dan-tai-game-50.html" title="Hướng dẫn">
                                Hướng dẫn cài
                                đặt
                                và gỡ bỏ
                            </a>
                            -
                            <a role="button"class="text-info text-decoration-none" href="https://hiepkhach.vtczone.vn/huong-dan/dieu-khoan-su-dung-89.html" title="Điều khoản">
                                Điều
                                khoản
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function event_popup_open(popupId, url, width, height) {
            // Sửa lại cú pháp trong window.open
            const popupWindow = window.open(url, popupId, `width=${width},height=${height},top=${(window.innerHeight - height) / 2},left=${(window.innerWidth - width) / 2}`);
            if (popupWindow) {
                popupWindow.focus();
            } else {
                alert("Popup bị chặn! Vui lòng cho phép popups trong trình duyệt của bạn.");
            }
        }

        function handleLinkClick(event) {
            const url = event.currentTarget.href;
            const urlParams = new URLSearchParams(url.split('?')[1]);

            // Kiểm tra xem URL có chứa các tham số cần thiết hay không
            if (urlParams.has('cate') && urlParams.has('subcate') && urlParams.has('idx')) {
                event.preventDefault(); // Ngăn chặn hành vi mặc định
                event_popup_open('popup_guide', url, '960', '705'); // Mở popup
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Tìm tất cả các liên kết trên trang
            const links = document.querySelectorAll('a');

            // Thêm sự kiện click cho từng liên kết
            links.forEach(link => {
                link.addEventListener('click', handleLinkClick);
            });
        });
    </script>
    <script>
        var filter = {};
        function paginationBxh(page) {
            filter.page = page;
            console.log(filter);
            event.preventDefault();
            $.ajax({
                url: '/index/ranking-filter',
                method: 'GET',
                data: filter,
                traditional: true,
                success: function(response) {
                    // Chèn nội dung vào khu vực chỉ định
                    $('#bxh-data').html(response);
                },
                error: function() {
                    alert('Có lỗi xảy ra khi tải nội dung');
                }
            });
        }
        function changeServer(id) {
            filter.server_id = id;
            event.preventDefault();
            $.ajax({
                url: '/index/ranking-filter',
                method: 'GET',
                data: filter,
                traditional: true,
                success: function(response) {
                    // Chèn nội dung vào khu vực chỉ định
                    $('#bxh-data').html(response);
                },
                error: function() {
                    alert('Có lỗi xảy ra khi tải nội dung');
                }
            });
        }
        function changeFaction(id) {
            filter.faction = id;
            event.preventDefault();
            $.ajax({
                url: '/index/ranking-filter',
                method: 'GET',
                data: filter,
                traditional: true,
                success: function(response) {
                    // Chèn nội dung vào khu vực chỉ định
                    $('#bxh-data').html(response);
                },
                error: function() {
                    alert('Có lỗi xảy ra khi tải nội dung');
                }
            });
        }
        function changeClass(id) {
            filter.class = id;
            event.preventDefault();
            $.ajax({
                url: '/index/ranking-filter',
                method: 'GET',
                data: filter,
                traditional: true,
                success: function(response) {
                    // Chèn nội dung vào khu vực chỉ định
                    $('#bxh-data').html(response);
                },
                error: function() {
                    alert('Có lỗi xảy ra khi tải nội dung');
                }
            });
        }
    </script>
@endsection
