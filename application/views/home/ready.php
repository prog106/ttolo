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
<div data-role="page" id="favi">
	<div data-role="header" class="nav-glyphish-example" data-theme="b" data-position="fixed">
	    <div data-role="navbar" class="nav-glyphish-example" data-grid="d">
	    <ul>
	        <li><a href="<?=$this->commonurl;?>" id="home" data-icon="home">Home</a></li>
	        <li><a href="<?=$this->commonurl;?>favi" id="favi" data-icon="eye">Favorite</a></li>
	        <li><a href="<?=$this->commonurl;?>comp" id="comp" data-icon="shop">Company</a></li>
	        <li><a href="<?=$this->commonurl;?>mail" id="mail" data-icon="mail">Mail</a></li>
	        <li><a href="<?=$this->commonurl;?>family" id="family" data-icon="heart">Family</a></li>
	    </ul>
	    </div>
	</div>
	<div date-role="content">
		prog106@gmail.com<br>
		준비중입니다.
	</div>
</div>
</body>
</html>