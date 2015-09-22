<div class="snsbar" style="background-color:#428bca">
<? if(!empty($this->_user) && empty($write)) { ?>
        <a href="http://ttolo.kr/linker/view/<?=$user?>" style="font-size:15px;color:#fff;"><strong>Go MyLinker Only View!</strong></a>
<? } else if(!empty($this->_user) && !empty($write)) { ?>
        <strong style="font-size:15px;color:#fff">Only view</strong>
<? } ?>
        <a href="javascript:;" id="kakaotalk" data-url="<?=$user?>"><img src="/static/img/kt.jpg" width="31"></a>
        <a href="javascript:;" id="kakaostory" data-url="<?=$user?>"><img src="/static/img/ks.png" width="28"></a>
        <a href="javascript:;" id="facebook" data-url="<?=$user?>"><img src="/static/img/fb.jpg" width="28"></a>
        <!-- div style="float:left;position:relative;width:40px;height:40px;overflow:hidden;border:0px solid red;">
        <object type="application/x-shockwave-flash" data="/static/js/clipboardCopy.swf" style="width:28px;height:28px;vertical-align:middle;margin:10px 5px;position:absolute;">
            <param name="menu" value="false" />
            <param name="allowFullScreen" value="false" />
            <param name="movie" value="/static/js/clipboardCopy.swf" />
            <param name="quality" value="high" />
            <param name="FlashVars" value="strCopy=http://ttolo.kr/linker/view/<?=$user?>&callback=alert&strMsg=URL이 복사되었습니다." />
        </object>
        <img src="/static/img/icons/glyphicons_152_check.png" width="28" style="position:absolute;top:13px;left:5px">
        </div -->
<? if(!empty($this->_user) && empty($write)) { ?>
        <a href="javascript:;" id="urlins" style="float:right"><img src="/static/img/icons/glyphicons_030_pencil.png" width="20"></a>
<? } else if(!empty($this->_user) && !empty($write)) { ?>
        <!-- a href="/linker" style="float:right"><img src="/static/img/icons/glyphicons_030_pencil.png" width="20"></a -->
<? } ?>
</div>
<script>

Kakao.init('1a3dc16be39930d816d899222d321cf6');
function kakaotalk(url) {
    Kakao.Link.sendTalkLink({
        label : "또로 MyLinker!!\n\nhttp://ttolo.kr/linker/view/" + url + "\n" ,
        webLink : {
            text : "또로 MyLinker 바로이동",
            url : "http://ttolo.kr/linker/view/" + url,
        }
    });
}
function kakaostory(url) {
    var win = window.open('http://story.kakao.com/share?url=http://ttolo.kr/linker/view/'+url,'kakaostory','width=550px,height=440px');
    if(win) { win.focus(); }
}
function facebook(url) {
    var win = window.open('http://www.facebook.com/sharer/sharer.php?u=http://ttolo.kr/linker/view/'+url,'facebook','width=550px,height=440px');
    if(win) { win.focus(); }
}
$(function() {
    $('#kakaotalk').click(function() { kakaotalk($(this).data('url')); });
    $('#kakaostory').click(function() { kakaostory($(this).data('url')); });
    $('#facebook').click(function() { facebook($(this).data('url')); });
    $('#urlins, #urlinsclose').click(function() {
        $('#urlinspage').slideToggle();
        $('#comment').val('');
        $('#url').val('');
        $('#submiturl').val('등록하기');
        $('#btnsecret').removeClass('btn-danger').addClass('btn-default').html('공개');
    });
});
</script>
