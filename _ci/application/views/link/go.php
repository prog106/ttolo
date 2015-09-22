<!DOCTYPE html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<title>HOME</title>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/mobile/1.4.1/jquery.mobile-1.4.1.min.js"></script>
<link type="text/css" rel="stylesheet" href="//code.jquery.com/mobile/1.4.1/jquery.mobile-1.4.1.min.css">
</head>
<body>
<div data-role="page">
	<div data-role="header" class="nav-glyphish-example" data-theme="b" data-position="fixed">
	    <h1>개인링크</h1>
        <a href="#" class="ui-btn-right ui-btn ui-corner-all" id="drop">초기화</a>
	</div>
	<div date-role="content">
        <ul data-role="listview" data-inset="true" data-split-icon="delete">
<?
foreach($list as $k => $v) {
    if(stripos($v['url'],"//") === false) {
        $v['url'] = "http://".$v['url'];
    }
?>
    <li><a href="<?=$v['url'];?>" target="_blank" style="white-space:normal;"><?=$v['url'];?></a><a href="#" class="del" data-srl="<?=$v['srl'];?>">삭제하기</a></li>
		    <? } ?>
        </ul>
        <p>
        URL을 등록해 주세요.
        <input type="text" name="url" value="" id="url"><br>
	    <button type="button" id="urlinsert">등록</button><br>
	</div>
</div>
<script>
$(function() {
    $('.del').click(function() {
        if(!confirm('정말 삭제 할꺼에요???')) {
            return;
        }
        $.ajax({
            type : 'post',
            data : { srl : $(this).attr('data-srl') },
            url : '/ci/go/godel'
        }).done(function(data) {
            if(data == 'OK') {
                self.location.reload();
            } else if(data == 'NOK') {
                alert('실패 ㅠㅠ');
            }
        });
    });
    $('#drop').click(function() {
        if(!confirm('정말 초기화 할꺼에요???')) {
            return;
        }
        $.ajax({
            type : 'post',
            url : '/ci/go/goout'
        }).done(function() {
            self.location='/ci/go';
        });
    });
    $('#urlinsert').click(function() {
        var nm = $('#url').val();
        if(!nm) {
            alert('URL 입력하세요.');
            return;
        }
        var rs = $.ajax({
            type : 'post',
            data : { nm : nm },
            url : '/ci/go/gourl',
        });
        rs.done(function(data) {
            if(data == 'OK') {
                self.location.reload();
            } else if(data == 'NOK') {
                alert('등록에 실패했어요');
            } else {
                alert('만든이가 아직은 모르는 에러 발생 : ' + data);
            }
        });
	});
});
</script>
</body>
</html>
