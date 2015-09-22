    <div class="jumbotron loginage">
        <h2 class="form-signin-heading">이메일 로그인</h2>
        <table>
            <tr>
                <td width="120">메일주소</td>
                <td width="460"><input type="text" name="mail" id="mail" value="prog106@gmail.com" class="form-control"></td>
            </tr>
            <tr>
                <td>비밀번호</td>
                <td><input type="password" name="pwd" id="pwd" value="" class="form-control"></td>
            </tr>
        </table>
        <br>
        <div id="st" style="color:#C00;" class="highlight"></div>
        <button onclick="maillogin();" style="cursor:pointer;" id="mailsignin" class="btn btn-success btn-block">또로 로그인</button>
        <h2 class="form-signin-heading">Facebook 로그인</h2>
        <button onclick="facebooklogin();" style="cursor:pointer;" id="mailsignin" class="btn btn-primary btn-block">Facebook 로그인</button>
    </div> <!-- /container -->
<script type="text/javascript">
window.fbAsyncInit = function() {
    FB.init({appId: '583415775113190', status: true, cookie: true,xfbml: true});
    FB.getLoginStatus(function(response) {
        if(response.status == 'connected') {
            //facebooklogin();
        } else if(response.status == 'not_authorized') {
            FB.login();
        } else {
            FB.login();
        }
    });
};
 
(function(d){
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement('script'); js.id = id; js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    ref.parentNode.insertBefore(js, ref);
}(document));
 
function facebooklogin() {
    FB.login(function(response) {
        var accessToken = response.authResponse.accessToken;
        FB.api('/me', function(user) {
            $.ajax({
                type : "post",
                url : "/signin/facebooklogin",
                data : {
                    "id" : user.id,
                    "fbaccesstoken" : accessToken,
                    "from" : "facebook"
                }
            }).done(function(data) {
                if(data == 'SUC') {
                    msg = "로그인 되었습니다.";
                    self.location.href="/";
                } else if(data == 'NOT') {
                    msg = "회원가입 후 이용바랍니다";
                } else
                    msg = "모르는 에러가 발생하였습니다.";
                alert(msg);
            });
        });
    });
}

var action;
function maillogin() {
    var mail = $('#mail').val();
    var pwd = $('#pwd').val();
    if(!mail) {
        $('#st').html('메일주소를 입력해 주세요.');
        return false;
    }
    if(!pwd) {
        $('#st').html('비밀번호를 입력해 주세요.');
        return false;
    }
    if(pwd.length < 4) {
        $('#st').html('비밀번호를 4자 이상 입력해 주세요.');
        return false;
    }

    if(action) return false;

    var login_data = {
        mail : $('#mail').val(),
        pwd : $('#pwd').val(),
    };
    $.ajax({
        type : "post",
        url : "/signin/maillogin",
        data : login_data
    }).done(function(data) {
        if(data == 'CHK') 
            msg = "mail 주소를 확인해 주세요.";
        else if(data == 'ALR') {
            msg = "이미 로그인 되어 있습니다.";
            alert(msg);
            self.location.href = '/';
            return false;
        }
        else if(data == 'NOT')
            msg = "로그인에 실패하였습니다.";
        else if(data == 'SUC') {
            action = '1';
            self.location.href = '/';
            return false;
        } else
            msg = "모르는 에러가 발생하였습니다.";
        alert(msg);
    });
}

$(function() {
    $('#mail').keyup(function() {
        $.ajax({
            type : "post",
            url : "/signin/parammail",
            data : { mail : $(this).val() }
        }).done(function(data) {
            if(data == 'OK') {
                $('#st').html('');
            } else {
                $('#st').html('옳바른 메일 주소를 입력해 주세요.');
            }
        });
    });
});
</script>
