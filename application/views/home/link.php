<!DOCTYPE html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<title>HOME</title>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/mobile/1.4.1/jquery.mobile-1.4.1.min.js"></script>
<link type="text/css" rel="stylesheet" href="//code.jquery.com/mobile/1.4.1/jquery.mobile-1.4.1.min.css">
</head>
<body>
<div data-role="page">
	<div data-role="header" class="nav-glyphish-example" data-theme="b" data-position="fixed">
	    <h1>prog106.phps.kr w</h1>
	</div>
	<div date-role="content">
		<ul data-role="listview" data-inset="true">
		    <li data-role="list-divider">prog106@gmail.com</li>
		    <? foreach($ms as $k => $v) { ?>
		    <li><a href="<?=$v;?>" target="_blank"><?=$k;?></a></li>
		    <? } ?>
		</ul>
	</div>
	<button type="button" id="testalert">alert</button><br>
	<input type="radio" name="testradio" value="A"><br>
	<input type="radio" name="testradio" value="B"><br>
	<input type="radio" name="testradio" value="C">
</div>
<script>
$(function() {
	$('#testalert').click(function() {
		alert('alert 테스트');
	});
});
</script>
</body>
</html>