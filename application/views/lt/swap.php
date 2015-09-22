{head}
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<title>또로-같이 밥먹기</title>
<link rel="apple-touch-icon" size="96x96" href="/static/img/ttolo_logo.png" />
<link rel="shortcut icon" href="/static/img/ttolo_logo.png" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
<script src="/static/js/shake.js"></script>
<script src="/static/js/kakao3.0.link.js"></script>
<script src="/static/js/jquery.cookie.js"></script>
<style>
.ui-btn {margin:.1em 0;padding:.7em .4em;}
div.ui-slider-switch { width: 120px; }
#popup_result-popup { position:'fixed',top:'0'; }
.ui-select { width:90px; }
.ui-select span { float:left; }
</style>
{/head}

{body}
<div style="float:left;width:30%;" class="ui-btn ui-mini">MKT</div>
<div style="float:left;width:30%;" class="ui-btn ui-mini">1팀<span id="first"></span></div>
<div style="width:30%;" class="ui-btn ui-mini">2팀<span id="second"></span></div>
<?
foreach($member as $k => $v) {
?>
    <div class="m<?=$k;?> ui-btn ui-mini mb" style="position:relative;width:70px;line-height:0.5"><?=$v;?></div>
<?
}
?>
<table width="100%">
    <tr>
        <td width="30%"><button id="reset">초기화</button></td>
        <td width="30%"><button id="kakao">KAKAO</button></td>
        <td width="30%"><button id="go">나누기</button></td>
    </tr>
</table>
<script>
$(function() {
    $('#reset').click(function() {
        $('#first').html("");
        $('#second').html("");
        $('#kakao').data('fn','');
        $('#kakao').data('sn','');
        $('.mb').animate({"left":"0"});
    });
    $('#go').click(swap);
    $('#kakao').click(function() {
        var fn = $('#kakao').data('fn');
        var sn = $('#kakao').data('sn');
        if(!fn || !sn) {
            alert('밥먹기 팀을 나누어 주세요.');
            return false;
        }
        var txt = "같이 밥먹기\n\n1팀 " + fn + "\n\n2팀 " + sn + "\n"
        Kakao.init('1a3dc16be39930d816d899222d321cf6');
        Kakao.Link.sendTalkLink({
            label : txt,
            webLink : {
                text : "또로 같이 밥먹기",
                url : "http://ttolo.kr/lt/swap",
            }
        });
    });
});
function swap() {
    var f=0;
    var s=0;
    var fn = new Array;
    var sn = new Array;
    for(var i=0;i<<?=count($member);?>;i++) {
        nu = Math.floor((Math.random()*2)+1) * 36;
        if(f == 8 && nu == 36) {
            nu = 72;
        } else if(s == 8 && nu == 72) {
            nu = 36;
        }
        $('.m'+i).animate({
            "left" : nu+"%",
        }, "slow");
        if(nu == 36) {
            f++;
            fn.push($('.m'+i).html());
        } else {
            s++;
            sn.push($('.m'+i).html());
        }
    }
    $('#first').html("("+f+")");
    $('#second').html("("+s+")");
    $('#kakao').data('fn', fn);
    $('#kakao').data('sn', sn);
}

function shakeswap() {
    swap();
    window.navigator.vibrate(300);
}

// 핸드폰 흔들기 액션
window.addEventListener('shake', shakeswap, false);
</script>
