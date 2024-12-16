@extends('layout.homepage.master')
@section('custom-header')
    <title>{{!empty($post) ? $post->title . " | Hiệp Khách Giang Hồ - Yulgang Origin VTC" : ($check == 'tintuc' ? 'Tin tức | Hiệp Khách Giang Hồ - Yulgang Origin VTC' : 'Sự kiện | Hiệp Khách Giang Hồ - Yulgang Origin VTC')}}</title>
    <meta name="description" content="{{!empty($post) ? $post->title . " | Hiệp Khách Giang Hồ - Yulgang Origin VTC, tựa game kiếm hiệp huyền thoại, đã trở lại với các hệ phái mới và các sự kiện độc quyền. Tải và chơi ngay hôm nay." : ($check == 'tintuc' ? 'Tin tức | Hiệp Khách Giang Hồ - Yulgang Origin VTC, tựa game kiếm hiệp huyền thoại, đã trở lại với các hệ phái mới và các sự kiện độc quyền. Tải và chơi ngay hôm nay.' : 'Sự kiện | Hiệp Khách Giang Hồ - Yulgang Origin VTC, tựa game kiếm hiệp huyền thoại, đã trở lại với các hệ phái mới và các sự kiện độc quyền. Tải và chơi ngay hôm nay.')}}" />
    <meta name="keywords" content="{{keywords()}}">
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:site_name" content="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
    <meta property="og:title" content="{{!empty($post) ? $post->title . " | Hiệp Khách Giang Hồ - Yulgang Origin VTC" : ($check == 'tintuc' ? 'Tin tức | Hiệp Khách Giang Hồ - Yulgang Origin VTC' : 'Sự kiện | Hiệp Khách Giang Hồ - Yulgang Origin VTC')}}" />
{{--    <meta property="og:image" content="{tìm ảnh sao cho phù hợp với các trang như trang chủ/sự kiện/cẩm nang,... cần thiết thì yêu cầu thiết kế, các trang bài viết thì hiển thị thumbnail }" />--}}
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
@endsection
@section('main-body')
    <div class="wrapper">
        <section id="frame5" class="section section-frame1 news">
            <div class="section-background">
                <img src="{{asset('./assets/homepage/images/bg-news-1.jpg')}}" class="img-fluid" alt="" />
                <img src="{{asset('./assets/homepage/images/bg-news-2.jpg')}}" class="img-fluid" alt="" />
                <img src="{{asset('./assets/homepage/images/bg-news-3.jpg')}}" class="img-fluid" alt="" />
            </div>
            <div class="section-content">
                <div class="container overflow-hidden">
                    <div class="main-s1 d-flex justify-content-start">
                        @include('tin-tuc.menu')
                        <div class="main-s1-right">
                            <div id="post-data" class="news" data-aos="fade-up-left" data-aos-duration="1000">
                                @if(!empty($post))
                                    @include('layout.homepage.posts.detail')
                                @else
                                    @include('layout.homepage.posts.new')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="footer news">
            <div class="container">
                <div class="social d-flex justify-content-center pb-3">
                    <a role="button"href="https://www.facebook.com/profile.php?id=61560993501166" target="_blank" title="Facebook">
                        <img src="{{asset('./assets/homepage/images/icon-facebook-footer.png')}}" class="img-fluid" alt="" />
                    </a>
                    <a role="button"href="https://www.facebook.com/groups/hiepkhachvtc.vn" target="_blank" title="Group">
                        <img src="{{asset('./assets/homepage/images/icon-group-footer.png')}}" class="img-fluid" alt="" />
                    </a>
                    <a role="button"href="https://www.youtube.com/@hiepkhachgianghovtc" target="_blank" title="Youtube">
                        <img src="{{asset('./assets/homepage/images/icon-ytb-footer.png')}}" class="img-fluid" alt="" />
                    </a>
                    <a role="button"href="https://www.tiktok.com/@hkghvtc88" target="_blank" title="Tiktok">
                        <img src="{{asset('./assets/homepage/images/icon-tiktok-footer.png')}}" class="img-fluid" alt="" />
                    </a>
                </div>
                <div class="row align-items-center">
                    <h2 class=" text-end col-6"><img src="{{asset('./assets/homepage/images/logo-vtcmobile.png')}}" class="img-fluid" alt="" />
                        <img src="{{asset('./assets/homepage/images/sep-lg-footer.png')}}" class="img-fluid" alt="" />
                        <img src="{{asset('./assets/homepage/images/logo-mgame.png')}}" class="img-fluid" alt="" />
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
@endsection
