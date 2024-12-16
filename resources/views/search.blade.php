@extends('layout.homepage.master')
@section('main-body')
    <div class="wrapper">
        <section id="frame5" class="section section-frame1 news">
            <div class="section-background">
                <img src="./assets/homepage/images/bg-news-1.jpg" class="img-fluid" alt="" />
                <img src="./assets/homepage/images/bg-news-2.jpg" class="img-fluid" alt="" />
                <img src="./assets/homepage/images/bg-news-3.jpg" class="img-fluid" alt="" />
            </div>
            <div class="section-content">
                <div class="container overflow-hidden">
                    <div class="main-s1 d-flex justify-content-start">
                        <div class="main-s1-left" data-aos="fade-up" data-aos-duration="1000">
                            <div class="taigame position-relative">
                                <div class="bg-taigame position-absolute">
                                    <img src="./assets/homepage/images/bg-taigame.png" class="img-fluid" alt="" />
                                </div>
                                <a role="button"href="{{ overrideTrackingUrl('https://hiepkhach.vtczone.vn/landing/') }}" title="Tải game">
                                    <img src="./assets/homepage/images/tai1.gif" class="img-fluid" alt="" />
                                </a>
                            </div>
                            <div class="napthe">
                                <a role="button"href="{{ overrideTrackingUrl('https://scoin.vn/nap-vao-game?GameId=330567') }}" target="_blank" title="Nạp thẻ">
                                    <img src="{{asset('./assets/homepage/images/btn-napthe.png')}}" class="img-fluid" alt="" />
                                </a>
                            </div>
                            <div class="frame-social">
                                <div style="margin-top: 100px;
    position: relative;
    z-index: 15;" class="social text-center">
                                    <h4><img src="./assets/homepage/images/label-congdong.png" class="img-fluid" alt="" /></h4>
                                    <div class="row">
                                        <div class="col-6">
                                            <a role="button"class="facebook" href="https://www.facebook.com/profile.php?id=61560993501166" title="Facebook">
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a role="button"class="group" href="https://www.facebook.com/groups/hiepkhachvtc.vn" title="Group">
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a role="button"class="ytb" href="https://www.tiktok.com/@hkghvtc88" title="Youtube">
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a role="button"class="tiktok" href="https://www.youtube.com/@hiepkhachgianghovtc" title="Tiktok">
                                            </a>
                                        </div>
                                        <div class="col-12">
                                            <a role="button"class="cskh" href="http://m.me/370443609476322" title="Cskh">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-s1-right">
                            <div class="news" data-aos="fade-up-left" data-aos-duration="1000">
                                <div class="tab-news d-flex justify-content-center align-items-center">
                                    <a role="button"class="active" href="/tim-kiem" title="">
                                        Tìm kiếm
                                    </a>
                                    <div class="form-search">
                                        <form method="get" action="{{route( 'index.search-page')}}">
                                            <div class="input-group">
                                                <input type="text" name="search" class="form-control bg-transparent" placeholder="Tìm kiếm">
                                                <button class="btn" type="submit"><img src="./assets/homepage/images/icon-search.png" class="img-fluid" alt="" /></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="content-news">
                                    @foreach($posts as $k => $item)
                                        <div class="row">
                                            <div class="col-5 col-lg-3">
                                                <a role="button"class="thumb" href="{{'/tim-kiem/' . $item->title_domain}}" title="">
                                                    <img src="{{$item['image']}}" class="img-fluid" alt="" />
                                                </a>
                                            </div>
                                            <div class="col-7 col-lg-7 p-0">
                                                <h2 class="title">
                                                    <a role="button"href="{{'/tim-kiem/' . $item->title_domain}}" title="">
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
                                    <div class="pagination justify-content-center">
                                        @if($posts->lastPage() > 1)
                                            <li class="page-item disabled">
                                                <a role="button"class="page-link" href="{{route('index.search-page', ['page' => $i - 1, 'search' => $search])}}">
                                                    Trước
                                                </a>
                                            </li>
                                        @endif
                                        @for($i = 1; $i <= $posts->lastPage(); $i++)
                                            <li class="page-item">
                                                <a role="button"class="page-link {{$i == $posts->currentPage() ? 'active' : ''}}" href="{{route('index.search-page', ['page' => $i, 'search' => $search])}}">
                                                    {{$i}}
                                                </a>
                                            </li>
                                        @endfor
                                        @if($posts->currentPage() < $posts->lastPage())
                                            <li class="page-item disabled">
                                                <a role="button"class="page-link" href="{{route('index.search-page', ['page' => $i + 1, 'search' => $search])}}">
                                                    Sau
                                                </a>
                                            </li>
                                        @endif
                                    </div>
                                </div>
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
                        <img src="./assets/homepage/images/icon-facebook-footer.png" class="img-fluid" alt="" />
                    </a>
                    <a role="button"href="https://www.facebook.com/groups/hiepkhachvtc.vn" target="_blank" title="Group">
                        <img src="./assets/homepage/images/icon-group-footer.png" class="img-fluid" alt="" />
                    </a>
                    <a role="button"href="https://www.youtube.com/@hiepkhachgianghovtc" target="_blank" title="Youtube">
                        <img src="./assets/homepage/images/icon-ytb-footer.png" class="img-fluid" alt="" />
                    </a>
                    <a role="button"href="https://www.tiktok.com/@hkghvtc88" target="_blank" title="Tiktok">
                        <img src="./assets/homepage/images/icon-tiktok-footer.png" class="img-fluid" alt="" />
                    </a>
                </div>
                <div class="row align-items-center">
                    <h2 class=" text-end col-6"><img src="./assets/homepage/images/logo-vtcmobile.png" class="img-fluid" alt="" />
                        <img src="./assets/homepage/images/sep-lg-footer.png" class="img-fluid" alt="" />
                        <img src="./assets/homepage/images/logo-mgame.png" class="img-fluid" alt="" />
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
@endsection
