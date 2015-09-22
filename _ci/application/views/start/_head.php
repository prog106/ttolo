<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#" lang="kr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<title>My Start Page</title>
<!-- link href="/static/css/layout.css" rel="stylesheet" type="text/css" charset="utf-8"/>
<link href="/static/css/uploadify.css" rel="stylesheet" type="text/css" charset="utf-8"/>
<link href="/static/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" charset="utf-8"/>
<link href="/static/css/bootstrap.css" rel="stylesheet" type="text/css" charset="utf-8"/>
<link href="/static/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css" charset="utf-8"/>
<link href="/static/css/ui/jquery.ui.all.css" rel="stylesheet" type="text/css" charset="utf-8"/ -->
<script src="/static/js/jquery-1.9.1.min.js"></script>
<script src="/static/js/jquery.slides.min.js"></script>
<!-- script src="/static/js/jquery.uploadify.min.js"></script>
<script src="/static/js/bootstrap.js"></script>
<script src="/static/js/bootstrap-datetimepicker.min.js"></script>
<script src="/static/js/ui/jquery.ui.core.js"></script>
<script src="/static/js/ui/jquery.ui.widget.js"></script>
<script src="/static/js/ui/jquery.ui.mouse.js"></script>
<script src="/static/js/ui/jquery.ui.position.js"></script>
<script src="/static/js/ui/jquery.ui.sortable.js"></script>
<script src="/static/js/ui/jquery.ui.dialog.js"></script>
<script src="/static/js/jquery.iframe-transport.js"></script>
<script src="/static/js/jquery.fileupload.js"></script>
<script src="/static/js/jquery.countdown.js"></script -->
<style>
#slides { display: none; }
#slides .slidesjs-navigation { margin-top:3px; }
#slides .slidesjs-previous { margin-right: 5px;float: left; }
#slides .slidesjs-next { margin-right: 5px;float: left; }
.slidesjs-pagination { margin: 6px 0 0;float: right;list-style: none; }
.slidesjs-pagination li { float: left;margin: 0 1px; }
.slidesjs-pagination li a {display: block;width: 13px;height: 0;padding-top: 13px;background-image: url(/static/img/pagination.png);background-position: 0 0;float: left;overflow: hidden; }
.slidesjs-pagination li a.active,
.slidesjs-pagination li a:hover.active { background-position: 0 -13px; }
.slidesjs-pagination li a:hover { background-position: 0 -26px; }
#slides a:link,
#slides a:visited { color: #333; }
#slides a:hover,
#slides a:active { color: #9e2020; }
.navbar { overflow: hidden; }
</style>
<script>
window.addEventListener('load', function() {
    document.body.style.height = (document.documentElement.clientHeight + 50) + 'px';
    window.scrollTo(0, 1);
}, false);
$(function(){
	$('#slides').slidesjs({
		width : 940,
		height : 528,
        navigation : false,
		effect : { slide : { speed : 1000 }, },
		play : { auto : true, interval : 3000 }
    });
    $('#s_home').slidesjs({
        width : 500,
        height : 700,
        navigation : false,
		effect : { slide : { speed : 1000 }, },
		play : { auto : true, interval : 3000 }
    });
    $('#mp_wrap2').slidesjs({
        width : 500,
        height : 700,
        navigation : false,
		effect : { slide : { speed : 1000 }, },
		play : { auto : true, interval : 3000 }
    });
});
function viewTo(id) {
    if(id == 'home') { id = ''; }
    location.href='/start/'+id;
}
</script>
<style>
    * { }
    html, body { height:100%; }
    body { -webkit-text-size-adjust:none; }
    body, p, ul, ol, li { margin:0;padding:0; }
    ul, ol { list-style:none; }

    .wrap { min-width:392px;max-width:900px;margin:auto; }

    .wrap_menu { width:auto; }
    .h_menu { width:100%;height:30px;display:table; }
    .h_menu li { cursor:pointer;text-align:center;width:20%;float:left;line-height:50px;font-size:12px; }
    .h_menu .h_menu0 { background-color:#EEE; }
    .h_menu .h_menu1 { background-color:#EEE; }
    .h_menu .h_menu2 { background-color:#EEE; }
    .h_menu .h_menu3 { background-color:#EEE; }
    .h_menu .h_menu4 { background-color:#EEE; }
    .home { margin:0 auto;margin-top:0px; }

    .wrap_like { width:auto; }
    .h_like { width:100%;height:30px;display:table; }
    .h_like li { padding-left:20px;line-height:30px;font-size:12px; }

    .wrap_love { width:auto; }
    .h_love { width:100%;height:30px;display:table; }
    .h_love li { padding-left:20px;line-height:30px;font-size:12px; }

    .wrap_health { width:auto; }
    .h_health { width:100%;height:30px;display:table; }
    .h_health li { padding-left:20px;line-height:30px;font-size:12px; }

    .wrap_favorite { width:auto; }
    .h_favorite { width:100%;height:30px;display:table; }
    .h_favorite li { padding-left:20px;line-height:30px;font-size:12px; }

    .wrap_login { padding:10px; } 

    .fwrap { width:900px;border:1px solid #000; }
    .f1 { float:left;width:450px;border:1px solid #000; }
    .f2 { margin-left:450px;width:450px;border:1px solid #000; }

    .fwrap_f { width:100%;border:1px solid #000; }
    .f1_f { width:100%;border:1px solid #000; }
    .f2_f { width:100%;border:1px solid #000; }

    .wrap_blog { width:auto; }
    .h_blog { width:100%;display:table; }
    .h_blog li { padding:20px 20px 0 20px;font-size:12px;float:left; }
    .h_blog img { border:1px solid #DDD;padding:2px; }
    .h_blog .logos { line-height:20px;position:absolute;margin-top:30px; }
    .h_blog_main { width:100%; }
    .h_blog_main h3 { border-bottom:1px solid #CC0; }
    .h_blog_main li { padding-left:3px;font-size:12px; }
    .h_blog_main .subinfo { line-height:30px;font-size:11px;color:#AAA; } 

</style>
</head>
<body>
<div class="wrap">
