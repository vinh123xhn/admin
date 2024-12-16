@if(!empty($post))
    <h2 class="pt-3">Hiệp Khách Giang Hồ <span class="text-warning">System Guide</span></h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a role="button"href="/ebook">Guide</a></li>
            <li class="breadcrumb-item"><a role="button"href="javascript:void(0)">{{$post->category->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$post->title}}</li>
        </ol>
    </nav>
    <div class="guide-content">
        <table cellspacing="0" cellpadding="0" width="100%" border="0">
            <tbody>
            <tr>
                <td>
                    {!! $post->content !!}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endif
