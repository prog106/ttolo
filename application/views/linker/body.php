<body style="padding:60px 0 55px 0;">
<script>
function go(url) {
    var gurl = (url.length > 7) ? url.substring(0,7) : "";
    if(gurl != 'http://' && gurl != 'https:/') {
        url = 'http://' + url;
    }
    var win = window.open(url,'','');
    if(win) { win.focus(); }
}
function nickchk(str) {
    return (str.match(/[^(ㄱ-ㅎ가-힝0-9a-zA-Z)]/)) ? false : true;
}
function pwdchk(str) {
    return (str.match(/[^(0-9a-zA-Z)]/)) ? false : true;
}
function urlchk(str) {
    return (str.match(/[^(ㄱ-ㅎ가-힝0-9a-zA-Z:\/.-_=+&#@()~?)],/)) ? false : true;
}
</script>

<?
$navtext = (empty($this->_user)) ? "Login" : "Logout" ;
$navlink = (empty($this->_user)) ? "javascript:;" : "/linker/logout" ;
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <table width="100%">
        <tr>
            <td width="50%"><a class="navbar-brand" href="/linker">MyLinker</a></td>
            <td><a class="navbar-brand" style="float:right;background-color:#000;" id="url<?=$navtext?>" href="<?=$navlink?>"><?=$navtext?></a><a class="navbar-brand" href="javascript:self.location.reload();" style="float:right"><img src="/static/img/icons/glyphicons_081_refresh_white.png" style="width:20px;"></a></td>
        </tr>
    </table>
</nav>
<div id="wrap_login" style="display:none;">
<form id="urllogin_form" name="urllogin_form" method="post">
<table width="100%" style="margin:5px 0 20px 0;">
    <tr>
        <td style="padding:0 10px;background-color:#d9edf7;"><h4>MyLinker 로그인</h4></td>
    </tr>
    <tr>
        <td style="padding:10px"><h6 style="line-height:0">MyLinker 이름</h6><input type="text" id="urllogin_name" name="name" value="" placeholder="MyLinker 이름을 입력하세요." style="width:100%" class="form-control"></div>
    </tr>
    <tr>
        <td style="padding:0 10px"><h6 style="line-height:0">비밀번호</h6><input type="password" id="urllogin_password" name="password" value="" placeholder="비밀번호를 입력하세요." style="width:100%" class="form-control"></td>
    </tr>
    <tr>
        <td><input type="submit" class="btn btn-primary btn-sm" style="float:right;margin:7px 10px;padding:7px 25px;" value="MyLinker 로그인"></td>
    </tr>
</table>
</form>
</div>

<div id="urlsearchform" style="display:none">
<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
    <div id="urlsearchresult" class="urlsearchresult" style="display:none;">
    <table width="100%">
        <tr>
            <td style="line-height:2;text-align:center;cursor:pointer;" class="bg-primary" id="urlsearchclose">close</td>
        </tr>
        <tr>
            <td style="padding:0 10px 0 10px;border:1px solid #e1e1e8;"><h6 id="urlsearchhtml"></h6></td>
        </tr>
    </table>
    </div>
    <form id="urlsearch_form" name="urlsearch_form" method="post">
    <table width="100%">
        <tr>
            <td style="padding:0 5px 0 10px;height:55px;">
                <input type="text" id="urltxt" name="urltxt" value="" placeholder="MyLinker를 검색해 보세요." style="width:100%" class="form-control">
            </td>
            <td width="85">
                <input type="submit" class="btn btn-primary btn-sm" id="urltxtbtn" style="float:right;margin:5px 10px 5px 0;padding:7px 25px;" value="검색">
            </td>
        </tr>
    </table>
    </form>
</nav>
</div>

<script>
$(function() {
    $('input:not(#urltxt, #urltxtbtn)').focus(function() { $('#urlsearchform').hide(); });
    $('input').focusout(function() { $('#urlsearchform').show(); });
    $('#urlLogin').click(function () { $('#wrap_signin').slideUp(); $('#wrap_login').slideToggle(); });
    $("#urllogin_form").submit(function() {
        if(!$("#urllogin_name").val()) {
            alert('MyLinker 이름을 입력하세요.');
            $('#urllogin_name').focus();
            return false;
        }
        if(!nickchk($("#urllogin_name").val())) {
            alert('MyLinker 이름은 한글, 영문, 숫자만 입력해 주세요.');
            $('#urllogin_name').focus();
            return false;
        }
        if(!$("#urllogin_password").val()) {
            alert('비밀번호를 입력하세요.');
            $('#urllogin_password').focus();
            return false;
        }
        if(!pwdchk($("#urllogin_password").val())) {
            alert('비밀번호는 영문, 숫자만 입력해 주세요.');
            $('#urllogin_password').focus();
            return false;
        }
        $.ajax({
            cache : false,
            url : "/linker/login",
            type : "POST",
            data : $("#urllogin_form").serialize(),
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
    $("#urlsearch_form").submit(function() {
        if(!$("#urltxt").val()) {
            alert('검색할 닉네임을 입력하세요.');
            $("#urltxt").focus();
            return false;
        }
        if(!nickchk($("#urltxt").val())) {
            alert('닉네임에 사용할 수 없는 기호가 포함되어 있습니다.');
            $("#url").focus();
            return false;
        }
        $.ajax({
            cache : false,
            url : '/linker/urlsearch', 
            type : "POST",
            data : $('#urlsearch_form').serialize(),
            success : function(r) {
                var o = $.parseJSON(r);
                if(o.rtn == 'OK') {
                    $('#urlsearchhtml').html('').append(o.msg);
                    $('#urlsearchresult').show();
                    $('#urlsearchclose').click(function() { $('#urlsearchresult').hide(); });
                } else {
                    alert('검색에 실패하였습니다.');
                }
            },
            error : function(e) {
                alert('심각한 오류가 발생하였습니다.');
            }
        });
    });
});
</script>
