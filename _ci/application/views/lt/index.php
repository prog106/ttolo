{head}
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<title>Lotto</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
<script src="/ci/static/js/shake.js"></script>
<script src="/ci/static/js/kakao.link.js"></script>
<script src="/ci/static/js/jquery.cookie.js"></script>
<style>
.ui-btn {margin:.1em 0;padding:.7em .4em;}
div.ui-slider-switch { width: 120px; }
#popup_result-popup { position:'fixed',top:'0'; }
</style>
{/head}

{body}
<?
if($mobile != 'S') {
?>

<!-- 상단고정 start -->
<div data-role="header" data-position="fixed">
    <h1>또로</h1>
    <a href="#luckypage" class="ui-btn-right ui-btn ui-btn-b ui-btn-inline ui-corner-all" id="luckygame">Lucky Game</a>
</div>
<!-- 상단고정 end -->
<?
}
?>

<!-- 로또선택 start -->
<table width="100%">
    <tr>
<?
for($i=1;$i<46;$i++) {

    echo "      <td><button class=\"ui-btn nb\" attr-nb=\"".$i."\" id=\"nb".$i."\">".$i."</button></td>
";

    if($i % 7 == 0) {
        echo "    </tr>
    <tr>
";
    }
}
?>
        <td colspan="2"><button id="nonb" class="ui-btn-active ui-corner-all">번호제외</button></td>
        <td colspan="2"><button id="hrandom" class="ui-btn-active ui-corner-all">반자동</button></td>
        <!-- td colspan="2"><button class="ui-btn ui-corner-all" value="N" id="st">Bonus</button></td -->
    </tr>
    <tr>
        <td colspan="3"><a id="vv" href="#popup_result" data-icon="delete" data-rel="popup" data-position-to="window" data-transition="fade" class="ui-btn ui-corner-all">ttolo</a></td>
        <td colspan="2"><button id="vvreset" class="ui-btn-active ui-corner-all">초기화</button></td>
        <td colspan="2"><button id="vvrandom" class="ui-btn-active ui-corner-all">랜덤</button></td>
    </tr>
</table>
<!-- 로또선택 end -->

<!-- 하단고정 start -->
<div data-role="footer" data-position="fixed">
    <div data-role="navbar">
        <ul>
            <li><a href="#savemenu" id="thesave" style="line-height:30px;">정보&공유</a></li>
            <li><a href="#lottomenu" id="lottolist" style="line-height:30px;">당첨번호</a></li>
        </ul>
    </div>
</div>
<!-- 하단고정 end -->

<!-- 좌측 패널 start -->
<div data-role="panel" id="savemenu" data-position="left" data-display="overlay">
    <div style="width:260px; overflow:auto;" id="savelist">
        <table id="savenum">
        </table>
    </div>
    <table width="100%">
        <tr>
            <td width="50%"><a href="#" data-rel="close" id="lottosns" class="ui-btn ui-corner-all">카톡공유</a></td>
            <td><a href="#" data-rel="close" class="ui-btn ui-corner-all">닫기</a></td>
        </tr>
    </table>
</div>
<!-- 좌측 패널 end -->

<!-- 우측 패널 (luckypage) start -->
<div data-role="panel" id="luckypage" data-position="right" data-display="overlay">
    <div style="width:260px; overflow:auto;" id="luckylist">
        <table>
            <tr>
                <td><label for="luckyd">내가 지난 밤에 꾼 꿈</label></td>
            </tr>
            <tr>
                <td><input type="text" name="lucky_dream" id="luckyd" id="text-basic" value="" placeholder="무슨 꿈을 꾸셨나요?" maxlength="50"></td>
            </tr>
            <tr>
                <td><a href="#" id="luckydream" class="ui-btn ui-corner-all">꿈보다 해몽</a></td>
            </tr>
            <tr>
                <td height="20px"></td>
            </tr>
            <tr>
                <td><label for="luckyn">내가 좋아하는 숫자</label></td>
            </tr>
            <tr>
                <td><input type="number" name="lucky_number" id="luckyn" value="" pattern="[0-9]" placeholder="좋아하는 숫자를 넣어보세요!" maxlength="50"></td>
            </tr>
            <tr>
                <td><a href="#" id="luckynumber" class="ui-btn ui-corner-all">행운의 숫자</a></td>
            </tr>
            <tr>
                <td><a href="#" id="luckyyou" class="ui-btn ui-corner-all">오늘은 누가나올까?</a></td>
            </tr>
        </table>
    </div>
    <table width="100%">
        <tr>
            <td><a href="#" data-rel="close" class="ui-btn ui-corner-all">닫기</a></td>
        </tr>
    </table>
</div>
<!-- 우측 패널 (luckypage) end -->

<!-- 우측 패널 start -->
<div data-role="panel" id="lottomenu" data-position="right" data-display="overlay">
    <div style="width:260px; overflow:auto;" id="choicelist">
        <table id="choicelistright">
        </table>
    </div>
    <a href="#" data-rel="close" class="ui-btn ui-shadow ui-corner-all">닫기</a>
</div>
<!-- 우측 패널 end -->

<!-- 로또 레이어 start -->
<div data-role="popup" id="popup_result" data-overlay-theme="b" data-dismissible="false" style="width:300px;">
    <ul data-role='listview' id="result" data-count-theme='b' data-insert='true' class='ui-listview'>
    </ul>
    <table width="100%">
        <tr>
            <td width="30%"><a href="#" data-rel="back" id="lottosave" class="ui-btn ui-corner-all">저장</a></td>
            <td><button id="kakaolink">카톡공유</button></td>
            <td width="30%"><a href="#" data-rel="back" class="ui-btn ui-corner-all">닫기</a></td>
        </tr>
    </table>
</div>
<!-- 로또 레이어 end -->

<script type="text/javascript">
// 카카오톡 공유하기
function executeURLLink(ttolo) {
    kakao.link("talk").send({
        msg : "내가 뽑은 로또 번호\n\n" + ttolo + "\n",
        url : "http://ttolo.kr/",  
        appid : "ttolo.kr",
        appver : "1.0",
        appname : "또로",
        type : "link"
    });
}

// 선택된 로또 번호 가져오기
function lottonumber() {
    var param = new Array;
    $('.nb').each(function() {
        if($(this).val() > 0) {
            param.push($(this).val());
        }
    });
    return param;
}

$(function() {
    // Lotto 레이어 카톡공유 클릭
    $('#kakaolink').click(function() {
        var param = lottonumber();
        if(param.length < 6) {
            if(confirm('번호를 '+ param.length +'개 ' + param +' 선택하였습니다. 공유 하시겠습니까?')) {
                executeURLLink(param);
            }
        } else {
            executeURLLink(param);
        }
    });
});
var cnt = 1;

// 로또 레이어 확인
function vv() {
    var param = new Array;
    $('.nb').each(function() {
        if($(this).val() > 0) {
            param.push($(this).val());
        }
    });
    var rv = $.ajax({
        type : "post",
        url : "/ci/lt/lt",
        dataType : "json",
        data : { ns : param , st : $('#st').val() }
    });
    rv.done(function(list) {
        $('#result').html('');
        if(list[0] == 'NoCount') {
            $('#result').append("<li class=\"ui-li-static ui-body-inherit\" tyle=\"line-height:30px;padding-left:10px;\">6개 번호를 선택해 주세요.</li>");
            return;
        }
        $('#result').append("<li class=\"ui-li-static ui-body-inherit\" style='line-height:30px;padding-left:10px;'> 선택한 숫자 <span class='ui-li-count ui-body-b'> "+list[0]+"</span></li><li class=\"ui-li-static ui-body-inherit\" style='line-height:30px;padding-left:10px;'> 비교한 로또 숫자 <span class='ui-li-count ui-body-b'> "+list[1]+"</span></li><li class=\"ui-li-static ui-body-inherit\" style='line-height:30px;padding-left:10px;'> 3개 맞음 <span class='ui-li-count ui-body-b'> "+list[2]+"</span></li><li class=\"ui-li-static ui-body-inherit\" style='line-height:30px;padding-left:10px;'> 4개 맞음 <span class='ui-li-count ui-body-b'> "+list[3]+"</span></li><li class=\"ui-li-static ui-body-inherit\" style='line-height:30px;padding-left:10px;'> 5개 맞음 <span class='ui-li-count ui-body-b'> "+list[4]+"</span></li><li class=\"ui-li-static ui-body-inherit\" style='line-height:30px;padding-left:10px;'> 6개 맞음 <span class='ui-li-count ui-body-b'> "+list[5]+"</span></li>");
    });
}

$(function() {
    //로또 레이어 가운데 정렬
    $('#popup_result').on('popupafteropen', function () {
        var top = ($(document).height() - $('.ui-popup-container').height())/2;
        $('.ui-popup-container').css({ top: top });  
    });

    // 좌측 버튼 최하단 위치 정렬
    $('#choicelist').css({ 'height' : ($(document).height() - 95), 'margin-bottom' : '10px' });
    $('#savelist').css({ 'height' : ($(document).height() - 95), 'margin-bottom' : '10px' });

    // 로또 번호 선택/해제
    $('#st').click(function() {
        if($(this).val() == 'Y') {
            $(this).val('N').removeClass('ui-btn-b');
        } else {
            $(this).val('Y').addClass('ui-btn-b');
        }
    });

    // 로또 번호 선택 갯수 체크
    $('.nb').click(function() {
        cnt = 1;
        $('.ui-btn').each(function() {
            if($(this).val() > 0) {
                cnt++;
            }
        });
        if($(this).val() > 0) {
            $(this).val('0').removeClass('ui-btn-b');
        } else {
            if(cnt > 6) {
                alert('번호는 6개만 선택해 주세요.');
                return;
            }
            $(this).val($(this).attr('attr-nb')).addClass('ui-btn-b');
        }
        cnt = 1;
    });

    // 선택번호 제외
    $('#nonb').click(function() {
        novv();
    });

    // Lotto 버튼 클릭
    $('#vv').click(function() {
        vv();
    });

    // 로또 번호 초기화 클릭
    $('#vvreset').click(function() {
        $('#hrandom').attr('data-val', '');
        vvreset();
    });

    // 로또 번호 랜덤 클릭
    $('#vvrandom').click(function() {
        novvreset();
        vvrandom();
    });

    // 로또 번호 반자동 클릭
    $('#hrandom').click(function() {
        var hast = $(this).attr('data-val');
        if(!hast) {
            var rd = lottonumber();
            if(rd.length == 0) {
                alert('번호를 선택하세요.');
                return;
            }
            if(rd.length == 6) {
                alert('6개 번호를 선택하여 반자동 기능이 작동되지 않습니다.');
                return;
            }
            $(this).attr('data-val', rd);
        }
        novvreset();
        hrandom();
    });

    // 로또 번호  저장하기
    $('#lottosave').click(function() {
        var param = lottonumber();
        var lottosave = $.ajax({
            type : "post",
            url : "/ci/lt/lottosave",
            data : { ns : param }
        });
        lottosave.done(function(msg) {
            if(msg == 'OK') {
                alert('저장되었습니다.');
            } else if(msg == 'Nok') {
                alert('DB Error');
            } else if(msg == 'NoData') {
                alert('번호를 선택해 주세요.');
            } else if(msg == 'NoNum') {
                alert('6자리 번호를 선택해 주세요.');
            } else if(msg == 'Sok') {
                alert('중복된 번호입니다.');
            }
        });
    });

    // 로또 번호 저장 클릭
    $('#thesave').click(function() {
        vvsave();
    });

    // 저장된 로또 번호 선택 공유 클릭
    $('#lottosns').click(function() {
        var nbs = new Array;
        $('#savenum #nbsns').each(function() {
            if($(this).attr('data-val') == 'Y') {
                nbs.push($(this).attr('data-nb'));
            }
        });
        if(nbs.length == 0) {
            alert('선택한 로또 번호가 없습니다.');
            return false;
        } 
        param = nbs.join('\n\n');
        executeURLLink(param);
    });

    // 로또 당첨 번호 보기
    $('#lottolist').click(function() {
        var lottolist = $.ajax({
            type : 'post',
            dataType : 'json',
            url : '/ci/lt/lottochoicelist'
        });
        lottolist.done(function(list) {
            $('#choicelistright').html('');
            for(var i=0;i<list.length;i++) {
                $('#choicelistright').append("<tr><td><button class=\"ui-btn\" style=\"font-size:13px;width:52px;\">"+list[i][0]+"회</button></td><td><button class=\"ui-btn\" style=\"font-size:13px;width:118px;\" data-nb=\""+list[i][1]+"\" id=\"chsel\">"+list[i][1]+"</button></td><td><button class=\"ui-btn\" style=\"font-size:13px;width:28px;\">"+list[i][2]+"</button></td></tr>");
            }
            $('#choicelistright #chsel').click(function() {
                var nbselv = $(this).attr('data-nb');
                if(confirm(nbselv + '를 선택하시겠습니까?')) {
                    vvselect(nbselv);
                }
            });
        });
    });

    // 꿈보다 해몽
    $('#luckydream').click(function() {
        var ld = $('#luckyd').val();
        if(!ld) {
            alert('꿈내용을 입력하세요.');
            return;
        }
        var dct = $.ajax({
            type : 'post',
            data : { ld : ld },
            url : '/ci/lt/dreamscometrue'
        });
        dct.done(function(data) {
            if(confirm("행운의 숫자\n\n" + data + '\n\n를 선택하시겠습니까?')) {
                vvselect(data);
            }
        });
    });

    // 행운의 숫자
    $('#luckynumber').click(function() {
        var nm = $('#luckyn').val();
        if(!nm) {
            alert('좋아하는 숫자를 입력하세요.');
            return;
        }
        var nct = $.ajax({
            type : 'post',
            data : { nm : nm },
            url : '/ci/lt/numbercometrue'
        });
        nct.done(function(data) {
            if(confirm("행운의 숫자\n\n" + data + '\n\n를 선택하시겠습니까?')) {
                vvselect(data);
            }
        });
    });

    // 오늘은 너로 결정했어! 
    $('#luckyyou').click(function() {
        var nct = $.ajax({
            type : 'post',
            url : '/ci/lt/youcometrue'
        });
        nct.done(function(data) {
            if(confirm("오늘은 너로 결정했어!\n\n" + data + '\n\n를 선택하시겠습니까?')) {
                vvselect(data);
            }
        });
    });

});

// 로또 번호 저장 리스트
function vvsave() {
    var lists = $.ajax({
        type : 'post',
        dataType : 'json',
        url : '/ci/lt/lottosavelist',
    });
    lists.done(function(list) {
        $('#savenum').html('');
        for(var i=0;i<list.length;i++) {
            $('#savenum').append("<tr><td><button id=\"nbdel\" data-srl=\""+list[i][0]+"\" data-nb=\""+list[i][1]+"\" class=\"ui-btn ui-shadow ui-corner-all ui-btn-inline ui-icon-delete ui-btn-icon-notext ui-btn-b ui-mini\"></button></td><td><button id=\"nbsel\" data-srl=\""+list[i][0]+"\" data-nb=\""+list[i][1]+"\" class=\"ui-btn ui-shadow ui-corner-all\">"+list[i][1]+"</button></td><td><button id=\"nbsns\" data-srl=\""+list[i][0]+"\" data-nb=\""+list[i][1]+"\" data-val=\"N\" class=\"nbsns ui-btn ui-shadow ui-corner-all ui-btn-inline ui-icon-check ui-btn-icon-notext ui-mini\"></button></td></tr>");
        }
        $('#savenum #nbsel').click(function() {
            var nbselv = $(this).attr('data-nb');
            if(confirm(nbselv + '를 선택하시겠습니까?')) {
                vvselect(nbselv);
            }
        });
        $('#savenum #nbdel').click(function() {
            var nbsels = $(this).attr('data-srl');
            var nbselv = $(this).attr('data-nb');
            if(confirm(nbselv + '를 삭제하시겠습니까?')) {
                vvdelete(nbsels);
            }
        });
        $('#savenum .nbsns').click(function() {
            if($(this).attr('data-val') == 'Y') {
                $(this).attr('data-val', 'N').removeClass('ui-btn-b');
            } else {
                $(this).attr('data-val', 'Y').addClass('ui-btn-b');
            }
        });
    });
}

// 선택번호 제외
function novv() {
    var rd = lottonumber();
    if(rd.length == 0) {
        alert('번호를 선택하세요.');
        return;
    }
    $('.nb').each(function() {
        if($(this).val() > 0) {
            $(this).attr('disabled', 'disabled').val('') ;
        }
    });
    var cnt = 1;
}

// 로또 번호 초기화
function vvreset() {
    $('.nb').removeClass('ui-btn-b').removeAttr('disabled');
    $('.nb').val('');
}

// 로또 번호 번호 제외 초기화
function novvreset() {
    $('.nb').val('');
    $('.nb').removeClass('ui-btn-b');
}

// 로또 번호 랜덤
function vvrandom() {
    var rd = new Array;
    for(var i=0;i<45;i++) {
        nu = Math.floor((Math.random()*45)+1);
        if($('#nb'+nu).attr('disabled') != 'disabled') {
            rd.push(nu);
            rd = sort_unique(rd);
            if(rd.length == 6) {
                break;
            }
        }
    }
    for(var i=0;i<rd.length;i++) {
        $('#nb'+rd[i]).val(rd[i]).addClass('ui-btn-b');
    }
    cnt = 6;
}

// 로또 번호 반자동
function hrandom() {
    var frd = $('#hrandom').attr('data-val');
    var rd = frd.split(",");
    for(var i=0;i<45;i++) {
        nu = Math.floor((Math.random()*45)+1).toString();
        if($('#nb'+nu).attr('disabled') != 'disabled') {
            rd.push(nu);
            rd = sort_unique(rd);
            if(rd.length == 6) {
                break;
            }
        }
    }
    for(var i=0;i<rd.length;i++) {
        $('#nb'+rd[i]).val(rd[i]).addClass('ui-btn-b');
    }
    cnt = 6;
}

// 저장된 로또 번호 체크하기
function vvselect(v) {
    vvreset();
    var sel = v.split(",");;
    for(var i=0;i<sel.length;i++) {
        $('#nb'+sel[i]).val(sel[i]).addClass('ui-btn-b');
    }
}

// 저장된 로또 번호 삭제하기
function vvdelete(v) {
    var vvd = $.ajax({
        type : "post",
        url : "/ci/lt/lottodel",
        data : { ns : v }
    });
    vvd.done(function(msg) {
        if(msg == 'OK') {
            alert('삭제되었습니다.');
        } else if(msg == 'Nok') {
            alert('DB Error');
        }
    });
    vvsave();
}

// 로또 번호 정렬하기
function sort_unique(arr) {
    arr = arr.sort(function (a, b) { return a*1 - b*1; });
    var ret = [arr[0]];
    for (var i = 1; i < arr.length; i++) {
        if (arr[i-1] !== arr[i]) {
            ret.push(arr[i]);
        }
    }
    return ret;
}

// 핸드폰 흔들기 액션
window.addEventListener('shake', shakes, false);

// 핸드폰 흔들기 액션 처리
function shakes() {
    novvreset();
    vvrandom();
    vv();
    window.navigator.vibrate(300);
}
</script>
{/body}
