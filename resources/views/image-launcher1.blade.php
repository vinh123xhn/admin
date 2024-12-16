@if(!empty($image))

    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
        <title>Hiệp khách PC - Huyền thoại trở lại, sống lại đam mê</title>
        <style type="text/css">

            html,body{margin:0;padding:0;overflow:hidden;}
            body{padding:0; margin:0; width:300px; height:72px;border-width:0;}
        </style>
    </head>
    <body scroll="no" border="0" cellpadding="0" cellspacing="0" style="border-width:0;" topmargin="0" leftmargin="0">
    <div id="launch_banner" style="border-width:0;"><a role="button"href="{{$image->link}}" target="_balnk" +=""><img src="{{$image->image}}" width="300" height="72" border="0"></a></div>
    </body>
    </html>

@endif
