<!DOCTYPE html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="/static/img/ttolo_logo.png">
<link rel="apple-touch-icon" size="96x96" href="/static/img/ttolo_logo.png" />
<link rel="shortcut icon" href="/static/img/ttolo_logo.png" />
<title>MyLinker</title>
<link rel="stylesheet" href="/static/css/bootstrap.css">
<link rel="stylesheet" href="/static/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="/static/css/bootstrap-docs.min.css">
<script type="text/javascript" src="/static/js/jquery-1.9.1.min.js" charset="utf-8"></script>
<script src="/static/js/jquery.slides.min.js"></script>
<script src="/static/js/bootstrap.min.js"></script>
<script src="/static/js/kakao3.0.link.js"></script>
<style>
.linker_table {width:100%;}
.linker_table .td_del {cursor:pointer;width:40px;text-align:center;background-color:#f7f7f9;border:1px solid #e1e1e8;}
.linker_table .td_cont {padding:0 10px 10px 10px;border:1px solid #e1e1e8;}
.linker_table .td_cont span {font-size:12px;margin-top:10px;word-break:break-all;}
.linker_table .td_go {cursor:pointer;width:40px;text-align:center;background-color:#f7f7f9;border:1px solid #e1e1e8;}
</style>
</head>

<body style="padding-top:70px;">
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <table width="100%">
        <tr>
            <td width="50%"><span class="navbar-brand">MyLinker</span></td>
            <td><a class="navbar-brand" style="float:right" href="#" id="drop">logout</a></td>
        </tr>
    </table>
</nav>

<table width="100%">
    <tr>
        <td style="padding:0 10px"><h6 style="line-height:0">사용할 닉네임을 입력하세요.</h6><input type="text" id="user" name="user" value="" placeholder="나만의 이름을 입력하세요." style="width:100%" class="form-control"></div>
    </tr>
    <tr>
        <td><input type="button" class="btn btn-primary btn-sm" style="float:right;margin:3px 10px;padding:5px 25px;" id="useinsert" value="등록하기"></td>
    </tr>
    <tr>
        <td><input type="button" class="btn btn-primary btn-sm" style="float:left;margin:3px 10px;padding:5px 25px;"  id="tmon_mkt_wg" value="티몬 마케팅 WG"></td>
    </tr>
</table>
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
            if(confirm('이름이 중복되요. 같이 사용하실래요?')) {
                var rrs = $.ajax({
                    type : 'post',
                    data : { nm : nm },
                    url : '/go/regoo',
                });
                rrs.done(function(data) {
                    self.location='/go/go';
                });
            }
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
        if(confirm('티몬 마케팅 WG를 사용하시겠습니까?')) {
            gogroup('tmon_mkt_wg');
        }
    });
});
</script>
</body>
</html>
