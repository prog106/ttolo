<!DOCTYPE html>
<html lang="kr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="/static/img/ttolo_logo.png">
<title>Login page</title>
<link rel="stylesheet" href="/static/css/bootstrap.css">
<link rel="stylesheet" href="/static/css/assets.docs.min.css">
<link rel="stylesheet" href="/static/css/ttolo.0.1.css">
<script type="text/javascript" src="/static/js/jquery-1.9.1.min.js" charset="utf-8"></script>
<script src="/static/js/bootstrap.min.js"></script>
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
    $('#st').html('정보를 입력해 주세요.');
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
            msg = "인증메일이 발송되었습니다. 메일인증이 완료되면 로그인하실 수 있습니다.";
        } else
            msg = "모르는 에러가 발생하였습니다.";
        alert(msg);
    });
}
</script>
</head>

<body>
<!-- div onclick="facebooklogin()" style="cursor: pointer;display:none;" id="fblogin">facebook login</div>
<div onclick="facebooklogout()" style="cursor: pointer;display:none;" id="fblogout">logout</div>
<div id="fbstatus"></div -->
    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li><a href="/">Home</a></li>
          <!-- li><a href="#">About</a></li -->
          <li class="active"><a href="/signin">회원가입</a></li>
          <li><a href="/pc/contact">Contact</a></li>
        </ul>
        <h3 class="text-muted">또로 프로젝트</h3>
      </div>

    <div class="jumbotron signpage">
        <h2 class="form-signin-heading">또로 프로젝트 회원가입</h2>
        <table>
            <tr>
                <td width="120">메일주소</td>
                <td width="460"><input type="text" name="mail" id="mail" value="prog106@gmail.com" class="form-control"></td>
            </tr>
            <tr>
                <td>비밀번호</td>
                <td><input type="password" name="pwd" id="pwd" value="" class="form-control"></td>
            </tr>
            <tr>
                <td>비밀번호 확인</td>
                <td><input type="password" name="repwd" id="repwd" value="" class="form-control"></td>
            </tr>
            <tr>
                <td>이름</td>
                <td><input type="text" name="name" id="name" value="길동이" class="form-control"></td>
            </tr>
        </table>
        <br>
        <div id="st" style="color:#C00;" class="highlight">정보를 입력해 주세요.</div>
        <button onclick="mailsignin();" style="cursor:pointer;" id="mailsignin" class="btn btn-success btn-block">또로 회원가입</button>
    </div> <!-- /container -->
</body>
</html>
