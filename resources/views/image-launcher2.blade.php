@if(!empty($image))

<!doctype html>
    <html lang="ko">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
            <title>Hiệp khách PC - Huyền thoại trở lại, sống lại đam mê</title>
            <style type="text/css">
                html,body{margin:0;padding:0;overflow:hidden;}
                body{padding:0; margin:0; width:300px; height:225px;border-width:0;}
            </style>
        </head>

        <body scroll="no" border="0" cellpadding="0" cellspacing="0" style="border-width:0;" topmargin="0" leftmargin="0">
            <div style="position: absolute; z-index: 2; margin: 0px; padding: 0px; border-width: 0px;" id="launch_banner"><a role="button" href="{{$image->link}}" target="_blank" title="Ảnh nền"><img src="{{$image->image}}" width="300" height="225" border="0"></a></div>
        </body>
</html>

@endif
