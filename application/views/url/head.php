<!DOCTYPE html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="/static/img/ttolo_logo.png">
<title>MyLinker</title>
<link rel="stylesheet" href="/static/css/bootstrap.css">
<link rel="stylesheet" href="/static/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="/static/css/bootstrap-docs.min.css">
<script type="text/javascript" src="/static/js/jquery-1.9.1.min.js" charset="utf-8"></script>
<script src="/static/js/jquery.slides.min.js"></script>
<script src="/static/js/bootstrap.min.js"></script>
<script src="/static/js/kakao3.0.link.js"></script>
</head>

<body style="padding-top:70px;">
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <table width="100%">
        <tr>
            <td width="50%"><a class="navbar-brand" href="/url">Home</a></td>
            <td><? if(!empty($this->_user)) { ?><a class="navbar-brand" style="float:right" href="/url/logout">logout</a><? } ?></td>
        </tr>
    </table>
</nav>
<script>
Kakao.init('1a3dc16be39930d816d899222d321cf6');
function kakaotalk(url) {
    Kakao.Link.sendTalkLink({
        label : "또로 MyLinker!!\n\nhttp://ttolo.kr/url/view/" + url + "\n\n" ,
        webLink : {
            text : "또로 MyLinker 바로이동",
            url : "http://ttolo.kr/url/view/" + url,
        }
    });
}
function kakaostory(url) {
    var win = window.open('http://story.kakao.com/share?url=http://ttolo.kr/url/view/'+url,'kakaostory','width=550px,height=440px');
    if(win) { win.focus(); }
}
$(function() {
    $('#kakaotalk').click(function() {
        kakaotalk($(this).data('url'));
    });
    $('#kakaostory').click(function() {
        kakaostory($(this).data('url'));
    });
});
</script>
