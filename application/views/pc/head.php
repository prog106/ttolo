<!DOCTYPE html>
<html lang="kr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/static/img/ttolo_logo.png">
    <title>또로 Project</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script type="text/javascript" src="/static/js/jquery-1.9.1.min.js" charset="utf-8"></script>
    <script src="/static/js/jquery.slides.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/static/css/ttolo.0.1.css">
    <script>
        $(function() {
            $('#jumbotronslides').slidesjs({
                width : 700,
                height : 450,
                navigation : false,
                effect : { slide : { speed : 1000 }, },
                play : { auto : true, interval : 5000 }
            });
        });
    </script>
<style>
#jumbotronslides .slidesjs-pagination { display:none; }
#jumbotronslides .slidesjs-navigation { margin-top:3px; }
#jumbotronslides .slidesjs-previous { margin-right: 5px;float: left; }
#jumbotronslides .slidesjs-next { margin-right: 5px;float: left; } 
</style>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
<?
if(empty($this->isttolo)) {
    $url = array("Home" => "/", "로그인" => "/signin/login", "회원가입" => "/signin/choose", "Contact" => "/pc/contact");
} else {
    $url = array("Home" => "/", "로그아웃" => "/signin/logout", "Contact" => "/pc/contact");
}
foreach($url as $k => $v) {
    echo "<li ".(($_SERVER['REQUEST_URI'] == $v)? "class=\"active\" " : "")."><a href=\"".$v."\">".$k."</a></li>";
}
?>
        </ul>
        <h3 class="text-muted">또로 프로젝트</h3>
        </div>
