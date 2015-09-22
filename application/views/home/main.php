<div data-role="page">
	<div data-role="header">
		<h1>GROW HOME</h1>
	</div>

	<div data-role="content">
		<h1>첫화면</h1>
		<? if($this->usersrl) { ?>
		<h3>반갑습니다. <?=$this->username;?>님</h3>
		<a href="<?=$this->commonurl;?>logout" data-role="button">LOGOUT</a>
		<? } else { ?>
		<a href="<?=$this->commonurl;?>signin" data-role="button">프로필 등록</a>
		<a href="<?=$this->commonurl;?>login" data-role="button">LOGIN</a>
		<? } ?>
	</div>
