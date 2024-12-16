<style type="text/css">

    html,body{margin:0;padding:0;overflow:hidden;}
    td a { font-family: "돋움", "Arial"; color: #533a20;; font-size: 12px; font-style: normal; line-height:16px; font-weight: normal; font-variant: normal; text-decoration: none}
    td a:hover { font-family: "돋움", "Arial"; color: #533a20;; font-size:12px; font-style: normal; line-height:16px; font-weight: normal; font-variant: normal; text-decoration: underline}
    .style2 {font-family: "돋움", "Arial"; font-size: 12px; color: #666666;}
    .style3 {font-family: "돋움", "Arial"; color: #e44028;font-size: 12px;font-weight: bold;}
    .title {
        white-space: nowrap;      /* Ngăn xuống dòng */
        overflow: hidden;         /* Ẩn phần nội dung tràn ra ngoài */
        text-overflow: ellipsis;  /* Hiển thị dấu ba chấm (...) khi bị cắt */
        max-width: 225px;
    }
    .td1 {
        width: 90px !important;
        height: 24px
    }
    .td3 {
        width: 115px !important;
    }
</style>
<table style="width: 440px; height: 155px" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tbody>
    <tr>
        <td align="center">
            <table style="width: 440px" border="0" cellspacing="0">
                <tbody><tr>
                    <td align="center" bgcolor="#f7ba43" class="style3 td1">Danh mục</td>
                    <td align="center" bgcolor="#f7ba43" class="style3 title">Bài viết</td>
                    <td align="center" bgcolor="#f7ba43" class="style3 td3">Ngày đăng</td>
                </tr>
                </tbody></table>
            @if(!empty($news))
                @foreach($news as $k => $item)
                    <table style="width: 440px" border="0" cellspacing="0">
                        <tbody><tr>
                            <td align="center" class="style2 td1">{{$item->category->name}}</td>
                            <td align="left" class="style2 title"><a role="button"href="{{route('tin_tuc_detail', ['post' => $item->title_domain])}}" target="_blank">{{$item->title}} </a></td>
                            <td align="center" class="style2 td3">{{\Carbon\Carbon::parse($item->created_at)->format('Y-m-d')}}</td>
                        </tr>
                        <tr>
                            <td height="1" colspan="3" bgcolor="#d8d8d8"></td>
                        </tr>
                        </tbody></table>
                @endforeach
            @endif
            <table width="430" border="0" cellspacing="0">
                <tbody>
                <tr>
                    <td width="430" height="2" colspan="3" bgcolor="#f7ba43"></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody></table>
