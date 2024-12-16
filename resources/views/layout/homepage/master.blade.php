<!DOCTYPE html>
<html lang="vi" xmlns="http://www.w3.org/1999/xhtml">
<head>
    @yield('custom-header')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" />
    <link href="{{asset('./assets/homepage/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('./assets/homepage/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/homepage/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/homepage/css/swiper-bundle.min.css')}}" />
    <script src="{{asset('./assets/homepage/js/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('./assets/homepage/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('./assets/homepage/js/jquery-1.9.1.min.js')}}"></script>
    <script src="{{asset('./assets/homepage/js/aos.js')}}"></script>
    <link rel="apple-touch-icon" href="{{asset('./assets/homepage/images/icon_favico.png')}}">
    <link rel="icon" href="{{asset('./assets/homepage/images/favico.ico')}}" type="image/png">
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-N8MWPH6L');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N8MWPH6L"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<header id="header" class="header header-headroom fixed-top" data-headroom data-tolerance="5">
    <div class="d-none d-lg-block">
        <nav class="navbar navbar-expand-sm text-uppercase">
            <div class="frame justify-content-between">
                <a role="button"class="position-absolute logo" href="{{route('index')}}">
                    <img src="{{asset('./assets/homepage/images/logo-hkgh.png')}}" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                </a>
                <ul class="navbar-nav justify-content-start">
                    <li class="nav-item">
                        <a role="button"class="nav-link" href="/tin-tuc" title="Bản tin - Hiệp Khách Giang Hồ - Yulgang Origin VTC">
                            Bản tin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="button"class="nav-link" href="/huong-dan" title="Hướng dẫn - Hiệp Khách Giang Hồ - Yulgang Origin VTC">
                            Hướng dẫn
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav justify-content-start">
                    <li class="nav-item">
                        <a role="button"class="nav-link" href="/cam-nang" title="Cẩm nang - Hiệp Khách Giang Hồ - Yulgang Origin VTC">
                            Cẩm nang
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a role="button"class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" title="Cộng đồng - Hiệp Khách Giang Hồ - Yulgang Origin VTC">
                            Cộng đồng
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a role="button"class="dropdown-item" href="https://www.facebook.com/profile.php?id=61560993501166" target="_blank" title="Fanpage - Hiệp Khách Giang Hồ - Yulgang Origin VTC">
                                    Fanpage
                                </a>
                            </li>
                            <li>
                                <a role="button"class="dropdown-item" href="https://www.facebook.com/groups/hiepkhachvtc.vn" target="_blank" title="Facebook - Hiệp Khách Giang Hồ - Yulgang Origin VTC">
                                    Group
                                </a>
                            </li>
                            <li>
                                <a role="button"class="dropdown-item" href="https://www.tiktok.com/@hkghvtc88" target="_blank" title="Tiktok - Hiệp Khách Giang Hồ - Yulgang Origin VTC">
                                    Tiktok
                                </a>
                            </li>
                            <li>
                                <a role="button"class="dropdown-item" href="https://www.youtube.com/@hiepkhachgianghovtc" target="_blank" title="Youtobe - Hiệp Khách Giang Hồ - Yulgang Origin VTC">
                                    Youtube
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="d-block d-lg-none">
        <nav class="navbar navbar-expand-sm text-uppercase">
            <div class="frame justify-content-between align-items-start">
                <a role="button"class="position-absolute logo" href="{{route('index')}}">
                    <img class="img-fluid" src="{{asset('./assets/homepage/images/logo-hkgh.png')}}" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                </a>
{{--                <ul class="navbar-nav justify-content-between">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a role="button"class="nav-link" href="#">--}}
{{--                            <img class="img-fluid" src="{{asset('./assets/homepage/images/btn-login-m.png')}}" alt="" />--}}
{{--                        </a>--}}
{{--                        <!--<span class="nav-link text-white f-VLRESO fs-20 text-center">--}}
{{--                        Xin chào: Ngọc Trinh <br /><a role="button"class="text-warning" href="#" title="Thoát">[Thoát]</a>--}}
{{--                    </span>-->--}}
{{--                    </li>--}}
{{--                </ul>--}}
                <ul class="navbar-nav justify-content-start">
                    <li class="nav-item dropdown">
                        <a role="button"class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <img class="img-fluid" src="{{asset('./assets/homepage/images/icon-menu.png')}}" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a role="button"class="dropdown-item" href="https://www.facebook.com/profile.php?id=61560993501166" target="_blank" title="Fanpage - Hiệp Khách Giang Hồ - Yulgang Origin VTC">
                                    Fanpage
                                </a>
                            </li>
                            <li>
                                <a role="button"class="dropdown-item" href="https://www.facebook.com/groups/hiepkhachvtc.vn" target="_blank" title="Group- Hiệp Khách Giang Hồ - Yulgang Origin VTC">
                                    Group
                                </a>
                            </li>
                            <li>
                                <a role="button"class="dropdown-item" href="https://www.tiktok.com/@hkghvtc88" target="_blank" title="Tiktok - Hiệp Khách Giang Hồ - Yulgang Origin VTC">
                                    Tiktok
                                </a>
                            </li>
                            <li>
                                <a role="button"class="dropdown-item" href="https://www.youtube.com/@hiepkhachgianghovtc" target="_blank" title="Youtube - Hiệp Khách Giang Hồ - Yulgang Origin VTC">
                                    Youtube
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>

@yield('main-body')
<!-- Main body -->
<nav class="navbar navbar-expand-sm fixed-bottom neo-bottom">
    <ul class="navbar-nav me-auto align-items-start">
        <li class="nav-item">
            <a role="button"class="nav-link pulse-reverse" href="javascript:void(0)"><img src="{{asset('./assets/homepage/images/facebook-m.png')}}" class="img-fluid" alt="Facebook - Hiệp Khách Giang Hồ - Yulgang Origin VTC" /></a>
        </li>
        <li class="nav-item">
            <a role="button"class="nav-link pulse-reverse" href="javascript:void(0)"><img src="{{asset('./assets/homepage/images/group-m.png')}}" class="img-fluid" alt="Group - Hiệp Khách Giang Hồ - Yulgang Origin VTC" /></a>
        </li>
        <li class="nav-item">
            <a role="button"class="nav-link pulse-reverse napthe" href="javascript:void(0)"><img src="{{asset('./assets/homepage/images/napthe-m.png')}}" class="img-fluid" alt="Nạp thẻ - Hiệp Khách Giang Hồ - Yulgang Origin VTC" /></a>
        </li>
        <li class="nav-item">
            <a role="button"class="nav-link pulse-reverse" href="javascript:void(0)"><img src="{{asset('./assets/homepage/images/ytb-m.png')}}" class="img-fluid" alt="Youtobe - Hiệp Khách Giang Hồ - Yulgang Origin VTC" /></a>
        </li>
        <li class="nav-item">
            <a role="button"class="nav-link pulse-reverse" href="javascript:void(0)"><img src="{{asset('./assets/homepage/images/cskh-m.png')}}" class="img-fluid" alt="Cskh - Hiệp Khách Giang Hồ - Yulgang Origin VTC" /></a>
        </li>
    </ul>
</nav>
<!-- Menu float right -->
<div class="download fadeInLeft">
    <a role="button"class="btn-img btn-taigame brightness zoom-50" href="{{ overrideTrackingUrl('https://hiepkhach.vtczone.vn/landing/') }}"
       role="button" title="Tải Game - Hiệp Khách Giang Hồ - Yulgang Origin VTC">
        <span class="visually-hidden">Tải game</span>
        <img class="img-fluid" src="{{asset('./assets/homepage/images/neo-btn-taigame.png')}}" alt="Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
    </a>
    <a role="button"class="btn-img btn-napthe brightness zoom-50" href="{{ overrideTrackingUrl('https://scoin.vn/nap-vao-game?GameId=330567') }}" role="button" title="Tải Game - Hiệp Khách Giang Hồ - Yulgang Origin VTC" target="_blank">
        <span class="visually-hidden">Nạp thẻ</span>
        <img class="img-fluid" src="{{asset('./assets/homepage/images/neo-btn-napthe.png')}}" alt="Tải Game - Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
    </a>
    <a role="button"class="btn-img btn-backtotop brightness zoom-50 text-center" href="#" role="button" title="Đầu trang - Hiệp Khách Giang Hồ - Yulgang Origin VTC">
        <span class="visually-hidden">Đầu trang</span>
        <img class="img-fluid" src="{{asset('./assets/homepage/images/top.png')}}" alt="Top - Hiệp Khách Giang Hồ - Yulgang Origin VTC" />
    </a>
</div>

<script src="{{asset('./assets/homepage/js/res-1.js')}}"></script>
<script src="{{asset('./assets/homepage/js/headroom.min.js')}}"></script>
<script src="{{asset('./assets/homepage/js/jQuery.headroom.min.js')}}"></script>
@yield('script')
</body>
</html>
