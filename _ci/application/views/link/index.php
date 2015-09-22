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
	</div>
	<div date-role="content">
        사용할 이름(중복안되게 입력해 주세요; 다른 사람이 이름 알면 같이 볼수 있어요~)<br>
        <input type="text" name="user" value="" id="user"><br>
	    <button type="button" id="userinsert">등록</button><br>
	</div>
</div>
<script>
$(function() {
    $('#userinsert').click(function() {
        var nm = $('#user').val();
        if(!nm) {
            alert('사용할 이름 입력하세요.');
            return;
        }
        var rs = $.ajax({
            type : 'post',
            data : { nm : nm },
            url : '/ci/go/goo',
        });
        rs.done(function(data) {
            if(data == 'OK') {
                self.location='/ci/go/go';
            } else if(data == 'JNOK') {
                if(confirm('이름이 중복되요. 같이 사용하실래요?')) {
                    var rrs = $.ajax({
                        type : 'post',
                        data : { nm : nm },
                        url : '/ci/go/regoo',
                    });
                    rrs.done(function(data) {
                        self.location='/ci/go/go';
                    });
                }
            } else {
                alert('만든이가 아직은 모르는 에러 발생 : ' + data);
            }
        });
	});
});
</script>
</body>
</html>
