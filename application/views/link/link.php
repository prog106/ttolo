<!DOCTYPE html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<title>HOME</title>
<link rel="apple-touch-icon" size="96x96" href="/static/img/ttolo_logo.png" />
<link rel="shortcut icon" href="/static/img/ttolo_logo.png" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
<script src="//code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="//code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>
<script src="/static/js/kakao.link.js"></script>
<script type="text/javascript">
// 카카오톡 공유하기
function executeURLLink(ttolo) {
    kakao.link("talk").send({
        msg : "또로 프로젝트 개인링크 " + ttolo + "\n",
        url : "http://ttolo.kr/",  
        appid : "ttolo.kr",
        appver : "1.0",
        appname : "또로",
        type : "link"
    });
}
</script>
</head>
<body>
<div data-role="page">
	<div data-role="header" class="nav-glyphish-example" data-theme="b" data-position="fixed">
	    <h1>개인링크</h1>
        <a href="#" class="ui-btn-right ui-btn ui-corner-all" id="share">공유하기</a>
	</div>
	<div date-role="content">
        <ul data-role="listview" data-inset="true" data-split-icon="delete">
<?
foreach($list as $k => $v) {
    if(stripos($v['url'],"//") === false) {
        $v['url'] = "http://".$v['url'];
    }
?>
    <li><a href="<?=$v['url'];?>" target="_blank"><p class="ui-li-desc" style="white-space:normal;"><?=$v['url'];?></p></a></li>
		    <? } ?>
        </ul>
	</div>
</div>
<script>
$(function() {
    $('#share').click(function() {
        if(confirm('이 링크를 정말 공유하시겠습니까?')) {
            var ttolo = "http://ttolo.kr<?=$_SERVER['REQUEST_URI'];?>";
            alert(ttolo);
            executeURLLink(ttolo);
        }
    });
});
</script>
</body>
</html>
