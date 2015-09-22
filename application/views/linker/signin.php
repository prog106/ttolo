<? $this->load->view('linker/head'); ?>
<p class="bg-primary" id="ck_signin" style="margin-top:5px;padding:15px;cursor:pointer;"><img src="/static/img/sign_01.png"> MyLinker를 만들어 보세요.</p>
<div id="wrap_signin" style="display:none;">
<form id="url_form" name="url_form" method="post">
<table width="100%" style="margin-bottom:20px;">
    <tr>
        <td style="padding:0 10px"><h6 style="line-height:0">MyLinker 이름 <code>URL로 사용됩니다.</code></h6><input type="text" id="url_name" name="name" value="" placeholder="MyLinker 이름을 입력하세요." style="width:100%" class="form-control"></div>
    </tr>
    <tr>
        <td style="padding:10px"><h6 style="line-height:0">비밀번호</h6><input type="password" id="url_password" name="password" value="" placeholder="비밀번호를 입력하세요." style="width:100%" class="form-control"></td>
    </tr>
    <tr>
        <td style="padding:0 10px"><h6 style="line-height:0">비밀번호 확인</h6><input type="password" id="url_password_re" name="password_re" value="" placeholder="비밀번호를 다시한번 입력하세요." style="width:100%" class="form-control"></td>
    </tr>
    <tr>
        <td><input type="submit" class="btn btn-primary btn-sm" style="float:right;margin:7px 10px;padding:7px 25px;" value="MyLinker 만들기"></td>
    </tr>
</table>
</form>
</div>
<p class="bg-primary" id="ck_recent" style="padding:15px;cursor:pointer;background-color:#5cb85c;"><img src="/static/img/sign_02.png"> 최근 생성된 MyLinker 보기</p>
<div id="wrap_recent" style="display:none;">
<table class="linker_table" style="margin-bottom:10px;">
<? foreach($recentlist as $k => $v) { ?>
    <tr>
        <td class="td_cont gourl" data-url="http://ttolo.kr/linker/view/<?=$v['user'];?>" style="cursor:pointer"><h6>[ <strong><?=$v['user']?></strong> ] http://ttolo.kr/linker/view/<?=$v['user'];?></h6></td>
        <td class="td_go"><img src="/static/img/icons/glyphicons_217_circle_arrow_right.png" width="20" class="gourl" data-url="http://ttolo.kr/linker/view/<?=$v['user'];?>" style="cursor:pointer;padding-bottom:10px;"></td>
    </tr>
<? } ?>
</table>
</div>
<p class="bg-primary" id="ck_linkinfo" style="padding:15px;cursor:pointer;background-color:#eea236;"><img src="/static/img/sign_03.png"> MyLinker 란?</p>
<div id="wrap_linkinfo" style="display:none;margin:0px;">
<div class="bs-callout bs-callout-info" style="margin:10px;">
    <h4>환영합니다!</h4>
    <p>이곳은 <code>MyLinker</code>입니다.</p>
</div>
<div class="bs-callout bs-callout-warning" style="margin:10px;">
    <h4>MyLinker 소개</h4>
    <p>Mobile에 최적화 되어 제작되었습니다만, PC에서도 충분히 사용이 가능합니다. 입력하신 MyLinker 이름으로 <code>MyLinker URL이 생성</code>되며, 나만의 Bookmark 모음 페이지를 만들고 관리 및 공유할 수 있습니다.</p>
</div>
<div class="bs-callout bs-callout-danger" style="margin:10px;">
    <h4>MyLinker 정책</h4>
    <p>입력하신 MyLinker 이름과 비밀번호는 모두 저장되지만, <code>암호화는 진행하지 않습니다.</code> 어떠한 개인정보도 저장 및 요청하지 않습니다. <code>해킹시 어떠한 책임도 지지 않습니다.</code></p>
</div>
</div>
<script>
$(function() {
    $(".gourl").click(function() { go($(this).data('url')); });
    $("#ck_signin").click(function() { $('#wrap_login').slideUp(); $("#wrap_signin").slideToggle(); });
    $("#ck_recent").click(function() { $("#wrap_recent").slideToggle(); });
    $("#ck_linkinfo").click(function() { $("#wrap_linkinfo").toggle(); });
    $("#url_form").submit(function() {
        if(!$("#url_name").val()) {
            alert('사용하실 MyLinker 이름을 입력하세요.');
            $('#url_name').focus();
            return false;
        }
        if(!nickchk($("#url_name").val())) {
            alert('MyLinker 이름은 한글, 영문, 숫자만 입력해 주세요.');
            $('#url_name').focus();
            return false;
        }
        if(!$("#url_password").val()) {
            alert('비밀번호를 입력하세요.');
            $('#url_password').focus();
            return false;
        }
        if(!pwdchk($("#url_password").val())) {
            alert('비밀번호는 영문, 숫자만 입력해 주세요.');
            $('#url_password').focus();
            return false;
        }
        if(!$("#url_password_re").val()) {
            alert('비밀번호를 다시한번 입력하세요.');
            $('#url_password_re').focus();
            return false;
        }
        if($("#url_password").val() != $("#url_password_re").val()) {
            alert('입력하신 비밀번호가 일치하지 않습니다.');
            return false;
        }
        $.ajax({
            cache : false,
            url : "/linker/signin",
            type : "POST",
            data : $("#url_form").serialize(),
            success : function(r) {
                var o = $.parseJSON(r);
                if(o.rtn == 'OK') {
                    alert('정상적으로 ' + o.msg + '되었습니다.');
                    self.location.reload();
                } else if(o.rtn == 'POK') {
                    alert(o.msg);
                } else {
                    alert('오류가 발생하였습니다.');
                }
            },
            error : function(e) {
                alert('심각한 오류가 발생하였습니다.');
            }
        });
        return false;
    });
});
angular.module('ngLinker',[])
.controller("LinkerCtrl", ['$scope', function($scope) {
    $scope.recentlist = [
<? foreach($recentlist as $k => $v): ?>
        {'url':'http://ttolo.kr/linker/view/<?=$v['user'];?>','urlkey':'<?=$v['user'];?>'},
<? endforeach; ?>
    ];
}]);
</script>
<? $this->load->view('linker/footer'); ?>
