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
.linker_table .td_del {cursor:pointer;width:20px;text-align:center;background-color:#f7f7f9;border:1px solid #e1e1e8;}
.linker_table .td_cont {padding:0 10px 0px 10px;border:1px solid #e1e1e8;}
.linker_table .td_cont span {font-size:12px;margin-top:10px;word-break:break-all;}
.linker_table .td_go {cursor:pointer;width:40px;text-align:center;background-color:#f7f7f9;border:1px solid #e1e1e8;}
.linker_table .sp_del {center;display:none;}
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
        <td style="padding:0 10px"><h6 style="line-height:0">Comment (선택)</h6><input type="text" id="comment" name="comment" value="" placeholder="Comment" style="width:100%" class="form-control"></div>
    </tr>
    <tr>
        <td style="padding:0 10px"><h6 style="line-height:0">Url (필수)</h6><input type="text" id="url" name="url" value="" placeholder="URL" style="width:100%" class="form-control"></td>
    </tr>
    <tr>
        <td><input type="button" class="btn btn-primary btn-sm" style="float:right;margin:3px 10px;padding:5px 25px;" id="urlinsert" value="등록하기"></td>
    </tr>
</table>

<table class="linker_table">
<?
foreach($list as $k => $v) {
    if(stripos($v['url'],"//") === false) {
        $v['url'] = "http://".$v['url'];
    }
?>
    <tr>
        <td class="td_del"><a href="javascript:;" class="del" data-srl="<?=$v['srl']?>"><img src="/static/img/icons/glyphicons_197_remove.png" width="15"></a></td>
        <td class="td_cont"><a href="<?=$v['url']?>" target="_blank"><h6><span style="color:#999"><?=($v['comment'])? $v['comment'] : 'No Comment'?></span><br><span><?=$v['url']?></span></h6></a></td>
        <td class="td_del"><a href="javascript:;" class="chk" data-srl="<?=$v['srl']?>"><img src="/static/img/icons/glyphicons_04<?=(empty($v['chkdate']))? "9_star" : "8_dislikes"?>.png" width="15"></a></td>
    </tr>
<?
}
?>
</table> 

<script>
$(function() {
    $('.chk').click(function() {
        if(!confirm('제일 위로 올리시겠습니까?')) {
            return;
        }
        $.ajax({
            type : 'post',
            data : { srl : $(this).attr('data-srl') },
            url : '/go/gochk'
        }).done(function(data) {
            if(data == 'OK') {
                self.location.reload();
            } else if(data == 'NOK') {
                alert('실패 ㅠㅠ');
            }
        });
    });
    $('.del').click(function() {
        if(!confirm('정말 삭제 하시겠습니까?')) {
            return;
        }
        $.ajax({
            type : 'post',
            data : { srl : $(this).attr('data-srl') },
            url : '/go/godel'
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
        if(!confirm('HOME 으로 이동하시겠습니까?')) {
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
        var nc = $('#comment').val();
        var nm = $('#url').val();
        if(!nm) {
            alert('URL 입력하세요.');
            return;
        }
        var rs = $.ajax({
            type : 'post',
            data : { nm : nm, nc : nc },
            url : '/go/gourl',
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
