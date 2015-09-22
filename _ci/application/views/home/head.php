<!DOCTYPE html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<title>HOME</title>
<script src="/ci/static/js/jquery-1.9.1.min.js"></script>
<script>
window.addEventListener('load', function() {
    document.body.style.height = (document.documentElement.clientHeight + 50) + 'px';
    window.scrollTo(0, 1);
}, false);
</script>
<style>
    * { margin:0px;padding:0px;font-family:'돋움', dotum; }
    a { text-decoration:none; }
    html, body { width:100%;height:100%; }
    li { list-style:none; }

    .wrap { max-width:900px;min-width:392px;margin:0 auto; }
    .main_header { height:45px;background-color:#222; }
    .main_menu { color:#CCC; }
    .main_menu li { float:left;width:25%;line-height:45px;text-align:center; }
    .sub_menu { height:30px;background-color:#FF0000;width:900px;position:absolute; }
    .sub_menu_space { height:30px; }
    .sub_menu_scroll { top:0px;position:fixed; }
    #main_layer1 { height:975px;font-size:450px;font-weight:bold;text-align:center; }
    #main_layer2 { height:975px;font-size:450px;font-weight:bold;text-align:center; }
</style>
</head>
<body>
<div class="wrap">
    <div class="main_header">
        <ul class="main_menu">
            <li><a href="/ci/home">home</a></li>
            <li><a href="/ci/home/youtb">youtube</a></li>
            <li>가을</li>
            <li>겨울</li>
        </ul>
    </div>
    <div class="sub_menu" id="sub_menu">
        Hellow! <a href="#한 글">7</a> <a href="#n8">8</a>
    </div>
    <div class="sub_menu_space"></div>
    <script>
        $(function() {
            $(window).scroll(function() {
                var sm = $('#sub_menu');
                var wh = $(window).scrollTop();
                if(wh > 45) {
                    sm.addClass('sub_menu_scroll');
                } else {
                    sm.removeClass('sub_menu_scroll');
                }
            });
        });
    </script>
    <div id="main_layer1"><a name="한 글">7</div>
    <div id="main_layer2"><a name="n8">8</div>
</div>
</body>
</html>
