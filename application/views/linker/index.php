<? $this->load->view('linker/head'); ?>
<? $this->load->view('linker/sns'); ?>

<div id="urlinspage" class="urlins" style="display:none;">
<form id="url_form" name="url_form" method="post">
<input type="hidden" name="msrl" id="msrl" value="">
<input type="hidden" name="secret" id="secret" value="N">
<table width="100%">
    <tr>
        <td colspan="2" style="padding:0 10px"><h6 style="line-height:0">Comment (선택)</h6><input type="text" id="comment" name="comment" value="" placeholder="Comment" style="width:100%" class="form-control"></div>
    </tr>
    <tr>
        <td colspan="2" style="padding:0 10px"><h6 style="line-height:0">Url (필수)</h6><input type="text" id="url" name="url" value="" placeholder="URL" style="width:100%" class="form-control"></td>
    </tr>
    <tr>
        <td><button type="button" class="btn btn-default btn-sm" id="btnsecret" style="float:left;margin:5px 10px;padding:7px 25px;">공개</button></td>
        <td><input type="submit" class="btn btn-primary btn-sm" style="float:right;margin:5px 10px;padding:7px 25px;" id="submiturl" value="등록하기"></td>
    </tr>
    <tr>
        <td colspan="2" style="height:15px;"></td>
    </tr>
    <tr>
        <td colspan="2" style="line-height:2;text-align:center;cursor:pointer;" class="bg-primary" id="urlinsclose">close</td>
    </tr>
    <tr>
        <td colspan="2" style="height:10px;"></td>
    </tr>
</table>
</form>
</div>

<p class="bg-primary" id="ck_recent" style="padding:15px;cursor:pointer;background-color:#5cb85c;"><img src="/static/img/sign_02.png"> 최근 생성된 MyLinker 보기</p>
<div id="wrap_recent" style="display:none;">
<table class="linker_table" style="margin-bottom:10px;">
<? foreach($recentlist as $k => $v) { ?>
    <tr>
        <td class="td_cont gourl" data-url="http://ttolo.kr/linker/view/<?=$v['user'];?>" style="cursor:pointer"><h6>http://ttolo.kr/linker/view/<?=$v['user'];?></h6></td>
        <td class="td_go"><img src="/static/img/icons/glyphicons_217_circle_arrow_right.png" width="20" class="gourl" data-url="http://ttolo.kr/linker/view/<?=$v['user'];?>" style="cursor:pointer;padding-bottom:10px;"></td>
    </tr>
<? } ?>
    <tr>
        <td colspan="2" style="height:10px;"></td>
    </tr>
    <tr>
        <td colspan="2" style="line-height:2;text-align:center;cursor:pointer;background-color:#5cb85c;" class="bg-primary" id="ck_recentclose">close</td>
    </tr>
</table>
</div>

<div style="position:relative;">
<div class="td_mod td_mod_hide" id="modi" data-id="0">
    <table class="td_mod_table">
        <tr>
            <td class="td_mod_sec sec" data-id="0" data-sec="N"><img src="/static/img/icons/glyphicons_204_unlock.png" width="15"></td>
            <td class="td_mod_fav fav" data-id="0" data-fav="N"><img src="/static/img/icons/glyphicons_049_star.png" width="20"></td>
            <td class="td_mod_top top" data-id="0" data-top="N"><img src="/static/img/icons/glyphicons_213_up_arrow.png" width="20"></td>
            <td class="td_mod_del del" data-id="0"><img src="/static/img/icons/glyphicons_197_remove.png" width="20"></td>
            <td class="td_mod_mod mod" data-id="0" data-sec="N"><img src="/static/img/icons/glyphicons_030_pencil.png" width="20"></td>
        </tr>
    </table>
</div>
<table class="linker_table">
<? foreach($list as $k => $v) { ?>
    <tr>
    <td class="td_set" data-srl="<?=$v['srl']?>" data-fav="<?=$v['fav']?>" data-top="<?=(($v['chkdate'])? "Y" : "N")?>" data-sec="<?=$v['secret']?>" data-url="<?=$v['url']?>" data-com="<?=((empty($v['comment']))?"No Comment":$v['comment'])?>"><img src="/static/img/icons/glyphicons_136_cogwheel.png" width="15"></td>
    <td class="td_cont gourl" data-url="<?=$v['url']?>" style="background-color:<?=(($v['fav'] == 'Y')? "#fcf8e3" : (($v['chkdate'])? "#d9edf7" : (($v['secret'] == 'Y')? "#efefef" : "")))?>;cursor:pointer"><h6 style="color:#555"><?=((empty($v['comment']))?"No Comment":$v['comment'])?> <small>(<?=substr($v['regdate'],2,8)?>)</small></h6><span><?=$v['url']?></span></td>
        <td class="td_go"><img src="/static/img/icons/glyphicons_217_circle_arrow_right.png" width="20" class="gourl" data-url="<?=$v['url']?>" style="cursor:pointer;padding-bottom:10px"></td>
    </tr>
<? } ?>
</table>        
</div>
<script>
var flip = 0;
$(function() {
    $("#ck_recent, #ck_recentclose").click(function() { $("#wrap_recent").slideToggle(); });
    $('#btnsecret').click(function() {
        if($('#secret').val() == 'N') {
            $('#secret').val('Y');
            $(this).removeClass('btn-default').addClass('btn-danger').html('비공개');
        } else {
            $('#secret').val('N');
            $(this).removeClass('btn-danger').addClass('btn-default').html('공개');
        }
    });
    $('.td_set, .td_mod_hide_go').click(function() {
        var pos = $(this).position();
        var hei = $(this).height();
        var id = $('#modi').data('id');
        if(flip % 2 === 0) {
            $("#modi").css({top:pos.top, height:$(this).height()});
            $(".td_mod_del, .td_mod_top, .td_mod_fav, .td_mod_sec, .td_mod_mod").css({height:$(this).height()}).data("id", $(this).data("srl"));
            $(".td_mod_fav").data("fav", $(this).data("fav"));
            $(".td_mod_top").data("top", $(this).data("top"));
            $(".td_mod_sec").data("sec", $(this).data("sec"));
            var secimg = ($(this).data("sec") == 'Y') ? "204_unlock.png" : "203_lock.png";
            $(".td_mod_sec img").attr("src", "/static/img/icons/glyphicons_" + secimg);
            var topimg = ($(this).data("top") == 'Y') ? "219_circle_arrow_down.png" : "218_circle_arrow_top.png";
            $(".td_mod_top img").attr("src", "/static/img/icons/glyphicons_" + topimg);
            var favimg = ($(this).data("fav") == 'Y') ? "048_dislikes.png" : "049_star.png";
            $(".td_mod_fav img").attr("src", "/static/img/icons/glyphicons_" + favimg);
            $(".td_mod_mod").data("url", $(this).data("url"));
            $(".td_mod_mod").data("com", $(this).data("com"));
            $(".td_mod_mod").data("sec", $(this).data("sec"));
        }
        $("#modi").data("id", $(this).data("srl"));
        $("#modi").slideToggle(flip++%2===0);
    });
    $('.gourl').click(function() {
        go($(this).data('url'));
    });
    $("#url_form").submit(function() {
        if(!$("#url").val()) {
            alert('URL을 입력하세요.');
            $("#url").focus();
            return false;
        }
        if(!urlchk($("#url").val())) {
            alert('URL에 사용할 수 없는 특수기호가 포함되어 있습니다.');
            $("#url").focus();
            return false;
        }
        optajax('/linker/urlsave', $("#url_form").serialize(), true);
        return false;
    });
    $(".mod").click(function() {
        $('#urlinspage').show();
        $('#msrl').val($(this).data('id'));
        $('#comment').val($(this).data('com'));
        $('#url').val($(this).data('url'));
        $('#submiturl').val('수정하기');
        if($(this).data('sec') == 'Y') {
            $('#secret').val('Y');
            $('#btnsecret').removeClass('btn-default').addClass('btn-danger').html('비공개');
        } else {
            $('#secret').val('N');
            $('#btnsecret').removeClass('btn-danger').addClass('btn-default').html('공개');
        }
    });
    $(".del").click(function() {
        if(confirm('정말 삭제하시겠습니까?')) {
            optajax('/linker/urldel', {'srl':$(this).data('id')});
            return false;
        }
    });
    $(".top").click(function() {
        var toptxt = ($(this).data('top') == 'N') ? "설정" : "해지";
        if(confirm('최상단 노출을 '+ toptxt +' 하시겠습니까?')) {
            optajax('/linker/urltop', {'srl':$(this).data('id'),'top':$(this).data('top')});
            return false;
        }
    });
    $(".fav").click(function() {
        var favtxt = ($(this).data('fav') == 'N') ? "설정" : "해지";
        if(confirm('즐겨찾기를 '+ favtxt +' 하시겠습니까?')) {
            optajax('/linker/urlfav', {'srl':$(this).data('id'),'fav':$(this).data('fav')});
            return false;
        }
    });
    $(".sec").click(function() {
        var sectxt = ($(this).data('sec') == 'N') ? "로 설정" : "을 해지";
        if(confirm('비밀글'+ sectxt +' 하시겠습니까?')) {
            optajax('/linker/urlsec', {'srl':$(this).data('id'),'sec':$(this).data('sec')});
            return false;
        }
    });
});
function optajax(target, targetdata, str) {
    $.ajax({
        cache : false,
        url : target,
        type : "POST",
        data : targetdata,
        success : function(r) {
            var o = $.parseJSON(r);
            if(o.rtn == 'OK') {
                if(str) alert('정상적으로 처리 되었습니다.');
                self.location.reload();
            } else {
                alert('실패하였습니다.');
            }
        },
        error : function(e) {
            alert('심각한 오류가 발생하였습니다.');
        }
    });
}
</script>
<? $this->load->view('linker/footer'); ?>
