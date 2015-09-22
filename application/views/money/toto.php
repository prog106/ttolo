<!DOCTYPE html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<title>또로 토토</title>
<link rel="apple-touch-icon" size="96x96" href="/static/img/ttolo_logo.png" />
<link rel="shortcut icon" href="/static/img/ttolo_logo.png" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
<script src="//code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="//code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>
<style>
.ui-li-desc {white-space:normal;}
</style>
</head>
<body>
<div data-role="page">
	<div data-role="header" class="nav-glyphish-example" data-theme="a" data-position="fixed">
        <h1>또로 토토</h1>
	</div>
	<div data-role="content">
        <ul data-role="listview">
<?
$i=0;
foreach($list as $k => $v) {
?>
    <li><a href="/money/totojoin/<?=$v['srl'];?>"><span class="ui-li-heading" style="font-size:12pt;"><?=$v['team1'];?> : <?=$v['team2'];?></span><span class="ui-li-desc"><?=substr($v['regdate'],2,8);?> : <?=$v['totoname'];?></span></a></li>
<?
}
?>
        </ul>
    </div>
    <div data-role="content" data-theme="b">
        <label for="basic">토토방 이름</label>
        <input type="text" name="totoname" value="" id="ttolototo" placeholder="토토방 이름을 입력해 주세요.">
        <label for="basic">토토방 팀1</label>
        <input type="text" name="team1" value="" id="team1" placeholder="첫번째 팀명을 입력해 주세요.">
        <label for="basic">토토방 팀2</label>
        <input type="text" name="team2" value="" id="team2" placeholder="두번째 팀명을 입력해 주세요.">
        <label for="basic">참여금액</label><br />
        <input type="number" name="money" value="" id="money" placeholder="참여 금액을 입력해 주세요.">
	    <button type="button" id="banginsert">토토방 만들기</button>
	</div>
</div>
<script>
$(function() {
    $('.del').click(function() {
        if(!confirm('정말 삭제 하시겠습니까?')) {
            return;
        }
        $.ajax({
            type : 'post',
            data : { srl : $(this).attr('data-srl') },
            url : '/money/moneydel'
        }).done(function(data) {
            if(data == 'OK') {
                self.location.reload();
            } else if(data == 'NOK') {
                alert('실패 ㅠㅠ');
            }
        });
    });
    $('#share').click(function() {
        if(confirm('이 링크를 정말 공유하시겠습니까?')) {
            var ttolo = "http://ttolo.kr/go";
            alert(ttolo);
            executeURLLink(ttolo);
        }
    });
    $('#drop').click(function() {
        if(!confirm('정말 초기화 할꺼에요???')) {
            return;
        }
        $.ajax({
            type : 'post',
            url : '/go/goout'
        }).done(function() {
            self.location='/go';
        });
    });
    $('#banginsert').click(function() {
        if(!confirm('등록하시겠습니까?')) return;
        var toto = $('#totoname').val();
        var te1 = $('#team1').val();
        var te2 = $('#team2').val();
        var mo = $('#money').val();
        if(!toto || !te1 || !te2 || mo) {
            alert('모두 입력하세요.');
            return;
        }
        var rs = $.ajax({
            type : 'post',
            data : { toto : toto, te1 : te1, te2 : te2, mo : mo },
            url : '/money/gototo',
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
