<div class="main-s1-left" data-aos="fade-up" data-aos-duration="1000">
    <div class="taigame position-relative">
        <div class="bg-taigame position-absolute">
            <img src="{{asset('./assets/homepage/images/bg-taigame.png')}}" class="img-fluid" alt="" />
        </div>
        <a role="button"href="{{ overrideTrackingUrl('https://hiepkhach.vtczone.vn/landing/') }}" title="Tải game">
            <img src="{{asset('./assets/homepage/images/tai1.gif')}}" class="img-fluid" alt="" />
        </a>
    </div>
    <div class="napthe">
        <a role="button"href="{{ overrideTrackingUrl('https://scoin.vn/nap-vao-game?GameId=330567') }}" target="_blank" title="Nạp thẻ">
            <img src="{{'./assets/homepage/images/btn-napthe.png'}}" class="img-fluid" alt="" />
        </a>
    </div>
    <div class="frame-social">
        <div style="margin-top: 100px;
    position: relative;
    z-index: 15;" class="lists-hd text-center">
            <h4><img src="{{'./assets/homepage/images/label-huongdan.png'}}" class="img-fluid" alt="" /></h4>
            <div class="row ">
                @foreach($categories as $k => $item)
                    <div class="col-12">
                        <div class="dropdown">
                            <button type="button" class="btn btn-hd dropdown-toggle" data-bs-toggle="dropdown">
                                {{$item->name}}
                            </button>
                            <ul class="dropdown-menu">
                                @foreach($item['post'] as $i => $post)
                                    <li><a role="button"style="max-width: 300px; /* Đặt chiều rộng của phần tử */
                                                            white-space: nowrap;
                                                            overflow: hidden;
                                                            text-overflow: ellipsis;" class="dropdown-item" href="{{route('huong_dan_detail', ['post' => $post['title_domain']])}}">{{$post['title']}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
