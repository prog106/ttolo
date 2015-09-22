<? $this->load->view('url/head'); ?>
<form id="url_form" name="url_form" method="post">
<table width="100%">
    <tr>
        <td style="padding:0 10px"><h6 style="line-height:0">닉네임(url으로 사용)</h6><input type="text" id="url_name" name="name" value="" placeholder="닉네임" style="width:100%" class="form-control"></div>
    </tr>
    <tr>
        <td style="padding:0 10px"><h6 style="line-height:0">비밀번호</h6><input type="password" id="url_password" name="password" value="" placeholder="비밀번호" style="width:100%" class="form-control"></td>
    </tr>
    <tr>
        <td><input type="submit" class="btn btn-primary btn-sm" style="float:right;margin:3px 10px;padding:5px 25px;" value="Signin"></td>
    </tr>
</table>
</form>
<script>
$(function() {
    $("#url_form").submit(function() {
        if(!$("#url_name").val()) {
            alert('사용하실 닉네임을 입력하세요.');
            $(this).focus();
            return false;
        }
        if(!$("#url_password").val()) {
            alert('비밀번호를 입력하세요.');
            $(this).focus();
            return false;
        }
        $.ajax({
            cache : false,
            url : "/url/signin",
            type : "POST",
            data : $("#url_form").serialize(),
            success : function(r) {
                var o = $.parseJSON(r);
                if(o.rtn == 'OK') {
                    alert('정상적으로 ' + o.msg + '되었습니다.');
                    self.location.reload();
                } else if(o.rtn == 'POK') {
                    alert('이미 사용중인 아이디입니다.\n\n(정확한 ' + o.msg + '를 입력해 주세요.)');
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
</script>
<div class="bs-callout bs-callout-info" style="margin:10px;">
    <h4>환영합니다!</h4>
    <p>이곳은 MyLinker 입니다.</p>
</div>
<div class="bs-callout bs-callout-warning" style="margin:10px;">
    <h4>MyLinker 소개</h4>
    <p>내가 모아놓은 URL을 PC와 Mobile에서 자유롭게 볼 수 있도록 제작되었습니다. <code>입력하신 닉네임으로 보기전용 URL이 자동생성</code>되며, 이 URL을 공유할 수 있습니다.</p>
</div>
<div class="bs-callout bs-callout-danger" style="margin:10px;">
    <h4>MyLinker 정책?</h4>
    <p>입력하신 닉네임과 비밀번호는 모두 저장되지만 <code>암호화는 진행하지 않습니다.</code> 어떠한 개인정보도 저장하지 않고, 요청하지도 않습니다. <code>어떠한 해킹시에도 책임을 지지 않습니다.</code></p>
</div>
<? $this->load->view('url/footer'); ?>
