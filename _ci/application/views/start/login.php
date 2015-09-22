<script>
$(function() {
    $('#login_frm').submit(function() {
        if($('#login_email').val() == '') {
            $('#login_email_alert').fadeIn(0).delay(3000).fadeOut(0);
            $('#login_email').focus();
            return false;
        }
        if($('#login_pwd').val() == '') {
            $('#login_pwd_alert').fadeIn(0).delay(3000).fadeOut(0);
            $('#login_pwd').focus();
            return false;
        }
    });
});
</script>
<div class="wrap_login">
    <form role="form" id="login_frm" action="/sign/login" method="POST">
        <div class="form-group">
            <label for="login_email">Email address</label>
            <input type="text" name="login_email" class="form-control" id="login_email" placeholder="이메일주소를 입력해 주세요." required>
            <div class="alert alert-danger" id="login_email_alert" style="display:none;margin-top:5px;">이메일주소를 입력하세요.</div>
        </div>
        <div class="form-group">
            <label for="login_pwd">Password</label>
            <input type="password" name="login_pwd" class="form-control" id="login_pwd" placeholder="비밀번호를 입력해 주세요." required>
            <div class="alert alert-danger" id="login_pwd_alert" style="display:none;margin-top:5px;">비밀번호를 입력하세요.</div>
        </div>
        <button type="submit" id="login_btn" class="btn btn-primary">LOGIN</button>
    </form>
</div>
<div id="login_result"></div>
