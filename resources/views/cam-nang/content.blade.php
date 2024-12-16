<div class="news" data-aos="fade-up-left" data-aos-duration="1000">
    @if(!empty($detail))
        <div class="tab-huongdan d-flex justify-content-between align-items-center">
            <h2>{{$detail->title}}</h2>
            <p class="date">{{Carbon\Carbon::parse($detail->created_at)->format('d/m/Y')}}</p>

        </div>
        <div class="content-news details table-main">
            {!! $detail->content !!}
            <a role="button"style="font-size: 18px; color: #84adea" href="{{route('tin_tuc_detail', $newPost->title_domain)}}" title="{{$newPost->title}}">- {{$newPost->title}}</a><br>
            <a role="button"style="font-size: 18px; color: #84adea" href="{{route('tin_tuc_detail', $eventPost->title_domain)}}" title="{{$eventPost->title}}">- {{$eventPost->title}}</a>
        </div>
    @endif
</div>
