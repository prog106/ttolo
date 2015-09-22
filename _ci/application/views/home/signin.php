<div data-role="page">
	<div data-role="header">
		<h1>GROW</h1>
	</div>

	<div data-role="content">
		<h1>프로필 등록</h1>
		<form name="sign" id="sign">
			Nick Name
			<input type="text" name="nick" id="nick">
			Birth Day
			<input type="date" name="birth" id="birth">
			<button type="button" name="action" id="action">등록</button>
		</form>
	</div>
</div>
<script>
$(function() {
	$('#action').click(function() {
		if(!$('#nick').val()) {
			alert('Nick Name please!');
			return false;
		}
		if(!$('#birth').val()) {
			alert('Birth Day Please!');
			return false;
		}

		$.ajax({
			type : 'POST',
			url : '/ci/sign/register',
			data : $('#sign').serialize(),
			success : function(d) {
				o = $.parseJSON(d);
				if(o.ret == 'OK') {
					alert('success' + o.msg);
				}
				//self.location.href='/ci/home/main';
			},
			error : function(d) {
				alert('error');
			}
		});
	});
});
</script>