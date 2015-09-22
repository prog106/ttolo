<!-- div onclick="facebooklogin()" style="cursor: pointer;display:none;" id="fblogin">facebook login</div>
<div onclick="facebooklogout()" style="cursor: pointer;display:none;" id="fblogout">logout</div>
<div id="fbstatus"></div -->

    <div class="jumbotron signpage">
        <h2 class="form-signin-heading">또로 프로젝트 회원가입(메일인증)</h2>
        <table>
            <tr>
                <td width="120">메일주소</td>
                <td width="260"><input type="text" name="mail" id="mail" value="" class="form-control" onfocus="resetst('mail');"></td>
                <td width="200"><span id="mail_st"></span></td>
            </tr>
            <tr>
                <td>비밀번호</td>
                <td><input type="password" name="pwd" id="pwd" value="" class="form-control" onfocus="resetst('pwd');"></td>
                <td><span id="pwd_st"></span></td>
            </tr>
            <tr>
                <td>비밀번호 확인</td>
                <td><input type="password" name="repwd" id="repwd" value="" class="form-control"></td>
                <td></td>
            </tr>
            <tr>
                <td>이름</td>
                <td><input type="text" name="name" id="name" value="길동이" class="form-control" onfocus="resetst('name');"></td>
                <td><span id="name_st"></span></td>
            </tr>
        </table>
        <br>
        <div id="st" style="color:#C00;" class="highlight">정보를 입력해 주세요.</div>
        <button onclick="mailsignin();" style="cursor:pointer;" id="mailsignin" class="btn btn-success btn-block">또로 회원가입</button>
    </div> <!-- /container -->
<script type="text/javascript">
/*
window.fbAsyncInit = function() {
    FB.init({appId: '583415775113190', status: true, cookie: true,xfbml: true});
    FB.getLoginStatus(function(response) {
        var logst = (response.status == 'connected') ? true : false;
        facebookloginstatus(logst);
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
            $.post("/signin/signin", {
                "param" : user,
                "fbaccesstoken" : accessToken,
                "from" : "facebook"
            }, function(responsephp) {
                facebookloginstatus(responsephp);
            });
        });
    }, {
        scope: 'publish_stream,user_likes'
    });
}

function facebooklogout() {
    FB.logout(function(response) {
        facebookloginstatus();
    });
}

function facebookloginstatus(res) {
    if(res) {
        FB.api('/me', function(response) {
            $('#fbstatus').html(response.name + '님 방가방가!');
            $('#fblogin').hide(); $('#fblogout').show();
        });
    } else {
        $('#fbstatus').html('로그인 후 이용해 주세요.');
        $('#fblogin').show(); $('#fblogout').hide();
    }
}
 */
var action;
function mailsignin() {
    var mail = $('#mail').val();
    var pwd = $('#pwd').val();
    var repwd = $('#repwd').val();
    var name = $('#name').val();
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
    if(pwd != repwd) {
        $('#st').html('입력하신 비밀번호가 다릅니다.');
        return false;
    }
    if(!name) {
        $('#st').html('이름을 입력해 주세요.');
        return false;
    }

    if(action) return false;

    var sign_data = {
        mail : $('#mail').val(),
        pwd : $('#pwd').val(),
        name : $('#name').val(),
    };
    $.ajax({
        type : "post",
        url : "/signin/mailsignin",
        data : sign_data
    }).done(function(data) {
        if(data == 'CHK') 
            msg = "mail 주소를 확인해 주세요.";
        else if(data == 'ALR')
            msg = "이미 가입되어 있는 메일입니다.";
        else if(data == 'ERR')
            msg = "메일발송에 실패하였습니다.";
        else if(data == 'SUC') {
            action = '1';
            msg = "인증메일이 발송되었습니다.\n\n메일인증이 완료되면 로그인하실 수 있습니다.";
        } else
            msg = "모르는 에러가 발생하였습니다.";
        alert(msg);
    });
}

$(function() {
    $('#mail').focusout(function() {
        $.ajax({
            type : "post",
            url : "/signin/parammail",
            data : { mail : $(this).val() }
        }).done(function(data) {
            if(data == 'OK') {
                $('#mail_st').html('');
            } else {
                $('#mail_st').html('정확한 메일 주소를 입력해 주세요.');
            }
        });
    });
    $('#pwd').focusout(function() {
        $.ajax({
            type : "post",
            url : "/signin/parampwd",
            data : { pwd : $(this).val() }
        }).done(function(data) {
            if(data == 'L')
                msg = "4~15자 이내로 입력해주세요.";
            else if(data == 'D')
                msg = "영문(소)과 숫자의 조합으로 입력해 주세요.";
            else if(data == 'C')
                msg = "보안등급 [하]";
            else if(data == 'B')
                msg = "보안등급 [중]";
            else if(data == 'A')
                msg = "보안등급 [상]";
            $('#pwd_st').html(msg);
        });
    });
});

function resetst(input) {
    $('#'+input+'_st').html('');
}
function validatePassword(password)
{
    var checkVal = 0;
    if (password.match(/[0-9]/g)!=null) checkVal++;
    if (password.match(/[a-z]/g)!=null) checkVal++;
    if (password.match(/[A-Z]/g)!=null) checkVal++;
    if (password.match(/\W/g)!=null) checkVal++;

    if (checkVal < 2)
        throw {message:'비밀번호는 영문 대/소문자, 숫자, 특수문자 중 2개 이상 조합되어야 합니다.'};

    var ch = '';
    var cnt = 0;
    for(var i=0;i<password.length;i++)
    {
        if(password.charAt(i)==ch)
        {
            cnt++;
            if(cnt>=4)
            {
                throw {message:'4개 이상의 연속된 문자는 입력할 수 없습니다.'};
            }
        }
        else
        {
            cnt = 1;
            ch = password.charAt(i);
        }
    }

    if (password.length < 6 || password.length > 15)
        throw {message:'비밀번호는 6~15자 범위로 입력하셔야 합니다.'};
}
</script>
