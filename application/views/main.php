<!DOCTYPE html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<title>또로 프로젝트</title>
<link rel="apple-touch-icon" size="96x96" href="/static/img/ttolo_logo.png" />
<link rel="shortcut icon" href="/static/img/ttolo_logo.png" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
<script src="//code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="//code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>
</head>
<body>
<div data-role="page">
	<div data-role="header" class="nav-glyphish-example" data-theme="a" data-position="fixed">
	    <h1>또로 프로젝트</h1>
    </div>
    <br>
	<div>
		<ul data-role="listview" data-inset="true" data-theme="d" data-divider-theme="d">
		    <li data-role="list-divider">프로젝트 링크</li>
		    <? foreach($ms as $k => $v) { ?>
		    <li><a href="<?=$v;?>" target="_blank"><?=$k;?></a></li>
		    <? } ?>
		</ul>
	</div>
</div>
</body>
</html>
