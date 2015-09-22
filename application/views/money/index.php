<!DOCTYPE html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<title>또로-정총무</title>
<link rel="apple-touch-icon" size="96x96" href="/static/img/ttolo_logo.png" />
<link rel="shortcut icon" href="/static/img/ttolo_logo.png" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
<script src="//code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="//code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>
</head>
<body>
<div data-role="page">
	<div data-role="header" class="nav-glyphish-example" data-theme="a" data-position="fixed">
	    <h1>또로-정총무</h1>
	</div>
	<!-- div data-role="content">
        <label for="basic">사용할 이름을 입력하세요.</label>
        <input type="text" name="user" value="" id="user" placeholder="나만의 이름을 사용하세요.">
        <strong>주의사항</strong><br>
        * 다른 사람 이름을 알면 같이 볼수 있어요!
	    <button type="button" id="userinsert">등록</button><br>
	</div -->
    <div data-role="content" data-theme="b">
        <label for="basic">그룹 바로가기</label>
        <a href="#" data-role="button" data-icon="star" id="tmon_mkt_wg">티몬 마케팅 WG - 또로벅스</a>
    </div>
</div>
<script>
function gourl(nm) {
    var rs = $.ajax({
        type : 'post',
        data : { nm : nm },
        url : '/go/goo',
    });
    rs.done(function(data) {
        if(data == 'OK') {
            self.location='/go/go';
        } else if(data == 'JNOK') {
            alert('이름이 중복되요.');
        } else {
            alert('만든이가 아직은 모르는 에러 발생 : ' + data);
        }
    });
}
function gogroup(nm) {
    var rs = $.ajax({
        type : 'post',
        data : { nm : nm },
        url : '/go/regoo',
    });
    rs.done(function(data) {
        if(data == 'OK') {
            self.location='/go/go';
        } else {
            alert('만든이가 아직은 모르는 에러 발생 : ' + data);
        }
    });
}
$(function() {
    $('#userinsert').click(function() {
        var nm = $('#user').val();
        if(!nm) {
            alert('사용할 이름 입력하세요.');
            return;
        }
        gourl(nm);
	});
    $('#tmon_mkt_wg').click(function() {
        if(confirm('티몬 마케팅 WG 또로벅스 를 보시겠습니까?')) {
            gogroup('tmon_mkt_wg');
        }
    });
});
</script>
</body>
</html>
