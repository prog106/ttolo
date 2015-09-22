<div data-role="page">
	<div data-role="header">
		<h1>GROW</h1>
	</div>

	<div data-role="content">
		<h1>LOGIN</h1>
		<form name="login" id="login">
			Email
			<input type="text" name="login_email" id="login_email">
			Password
			<input type="password" name="login_pwd" id="login_pwd">
			<button type="button" name="action" id="action">LOGIN</button>
		</form>
	</div>
</div>
<script>
$(function() {
	$('#action').click(function() {
		if(!$('#login_email').val()) {
			alert('Login Email please!');
			return false;
		}
		if(!$('#login_pwd').val()) {
			alert('Login Password Please!');
			return false;
		}

		$.ajax({
			type : 'POST',
			url : '/sign/login',
			data : $('#login').serialize(),
			success : function(d) {
				o = $.parseJSON(d);
				if(o.ret == 'OK') {
					alert('success');
					self.location.href='/home/main';
				} else if(o.ret == 'NOK') {
					alert('No Match Email or Password');
				}
			},
			error : function(d) {
				alert('error');
			}
		});
	});
});
</script>
