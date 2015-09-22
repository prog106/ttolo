<!DOCTYPE html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<title>또로벅스 정총무</title>
<link rel="apple-touch-icon" size="96x96" href="/static/img/ttolo_logo.png" />
<link rel="shortcut icon" href="/static/img/ttolo_logo.png" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
<script src="//code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="//code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>
<style>
.ui-li-desc {white-space:normal;}​
</style>
</head>
<body>
<div data-role="page">
	<div data-role="header" class="nav-glyphish-example" data-theme="a" data-position="fixed">
        <h1>또로벅스 정총무</h1>
        <!-- a href="/money" data-icon="gear" class="ui-btn-right" id="drop">Money</a -->
	</div>
    <div data-role="content" data-theme="b">
        <label for="basic">코멘트</label>
        <input type="text" name="comment" value="" id="comment" placeholder="간단한 설명을 입력해 주세요.">
        <label for="basic">금액</label><br />
        <select name="plusminus" id="plusminus" data-role="slider" data-mini="true">
            <option value="+">수입</option>
            <option value="-">지출</option>
        </select>
        <input type="number" name="money" value="" id="money" placeholder="금액을 입력해 주세요.">
	    <button type="button" id="urlinsert">등록</button>
	</div>
	<div data-role="content">
        <ul data-role="listview">
<?
$last = $sum['pmoney'] - $sum['mmoney'];
?>
            <li>현재잔액 : <?=number_format($sum['pmoney'] - $sum['mmoney']);?> 원</li>
            <!-- li><?=number_format($sum['pmoney']);?> - <?=number_format($sum['mmoney']);?> = <?=number_format($sum['pmoney'] - $sum['mmoney']);?></li -->
<?
$i=0;
foreach($list as $k => $v) {
?>
    <li><a href="#"><span class="ui-li-heading" style="font-size:12pt;<?=(($v['plusminus'] == '+')? "color:#00F" : "color:#F00");?>"><?=$v['plusminus'];?> <?=number_format($v['money']);?> = <?=number_format($last);?></span><span class="ui-li-desc"><?=substr($v['regdate'],2,8);?> : <?=$v['comment'];?></span><a href="#" class="del" data-icon="delete" data-theme="a" data-srl="<?=$v['srl'];?>">삭제하기</a></li>
    <!-- li><a href="#"><span class="ui-li-heading" style="font-size:12pt;<?=(($v['plusminus'] == '+')? "color:#00F" : "color:#F00");?>"><?=$v['plusminus'];?> <?=number_format($v['money']);?> = <?=number_format($last);?></span></a><p class="ul-li-desc"><strong><?=substr($v['regdate'],2,8);?> : <?=$v['comment'];?></strong></p><a href="#" class="del" data-icon="delete" data-theme="a" data-srl="1">삭제하기</a></li-->
<?
    $last = ($v['plusminus'] == '+') ? $last - $v['money'] : $last + $v['money'] ;
    $i++;
}
?>
        </ul>
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
                alert('삭제 성공');
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
    $('#urlinsert').click(function() {
        if(!confirm('등록하시겠습니까?')) return;
        var nc = $('#comment').val();
        var mn = $('#money').val();
        var pm = $('#plusminus').val();
        if(!nc) {
            alert('코멘트 입력하세요.');
            return;
        }
        if(!money) {
            alert('금액을 입력하세요.');
            return;
        }
        var rs = $.ajax({
            type : 'post',
            data : { mn : mn, nc : nc, pm : pm },
            url : '/money/gomoney',
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
