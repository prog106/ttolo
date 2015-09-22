    <div class="jumbotron signpage">
        <h2 class="form-signin-heading">회원가입(선택1)</h2>
        <button onclick="gosignin();" style="cursor:pointer;" id="mailsignin" class="btn btn-success btn-block">이메일 인증 회원가입</button>
        <h2 class="form-signin-heading">회원가입(선택2)</h2>
        <button onclick="facebooksignin();" style="cursor:pointer;" id="mailsignin" class="btn btn-primary btn-block">Facebook 회원가입</button>
        <span id="fbst"></span>
    </div> <!-- /container -->
<script type="text/javascript">
window.fbAsyncInit = function() {
    FB.init({appId: '583415775113190', status: true, cookie: true, xfbml: true});
    FB.Event.subscribe('auth.authResponseChange', function (response) {
        if(response.status == 'connected') {
            //facebooksignin();
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
 
function facebooksignin() {
    FB.login(function(response) {
        var accessToken = response.authResponse.accessToken;
        FB.api('/me', function(user) {
            $.post("/signin/signinFacebook", { "param" : user, "fbaccesstoken" : accessToken, "from" : "facebook" },
                function(data) {
                    if(data == 'ALR')
                        msg = "이미 가입되어 있습니다.";
                    else if(data == 'SUC') {
                        msg = "회원가입 되었습니다.";
                    } else
                        msg = "모르는 에러가 발생하였습니다.";
                    alert(msg);
                }
            );
        });
    }, {scope : 'publish_stream'});
}

function gosignin() {
    self.location.href='/signin';
}
</script>
