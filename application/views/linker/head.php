<!DOCTYPE html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
<!-- 페이스북 메타태그 -->
<meta property="fb:admins" content="ttolo" />
<meta property="og:title" content="또로 MyLinker" />
<meta property="og:image" content="http://ttolo.kr/static/img/ttolo_logo_96.png" />
<meta property="og:description" content="나만의 즐겨찾기를 공유하는 MyLinker!" />
<meta property="og:url" content="http://ttolo.kr/linker" />
<meta name="subject" content="또로 MyLinker">
<meta name="description" content="나만의 즐겨찾기를 공유하는 MyLinker!">
<meta name="author" content="ttolo.kr">
<meta name="keywords" content="즐겨찾기,favorite,mylinker,link,링크,마이링커">
<link rel="icon" href="/static/img/ttolo_logo_96.png">
<link rel="apple-touch-icon" size="96x96" href="/static/img/ttolo_logo_96.png">
<link rel="shortcut icon" href="/static/img/ttolo_logo_96.png">
<title>MyLinker</title>
<link rel="stylesheet" href="/static/css/bootstrap.css">
<link rel="stylesheet" href="/static/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="/static/css/bootstrap-docs.min.css">
<script type="text/javascript" src="/static/js/jquery-1.9.1.min.js" charset="utf-8"></script>
<script src="/static/js/jquery.slides.min.js"></script>
<script src="/static/js/bootstrap.min.js"></script>
<script src="/static/js/kakao3.0.link.js"></script>
<!-- script src="/static/js/angular/angular.js"></script -->
<style>
.linker_table {width:100%;}
.linker_table .td_del {cursor:pointer;width:40px;text-align:center;background-color:#f7f7f9;border:1px solid #e1e1e8;}
.linker_table .td_cont {padding:0 10px 10px 10px;border:1px solid #e1e1e8;border-right:0px;}
.linker_table .td_set {cursor:pointer;width:30px;text-align:center;background-color:#f7f7f9;border:1px solid #e1e1e8;}
.linker_table .td_cont span {font-size:12px;margin-top:10px;word-break:break-all;}
.linker_table .td_go {width:30px;text-align:center;border:1px solid #e1e1e8;border-left:0px;vertical-align:bottom;}
.td_mod {position:absolute;left:30px;}
.td_mod_table {background-color:#fff;border:1px solid #e1e1e8;}
.td_mode .td_del {cursor:pointer;width:40px;text-align:center;background-color:#f7f7f9;border:1px solid #e1e1e8;}
.td_mod_hide {display:none;}
.td_mod_del {cursor:pointer;text-align:center;width:50px;}
.td_mod_top {cursor:pointer;text-align:center;width:50px;}
.td_mod_fav {cursor:pointer;text-align:center;width:50px;}
.td_mod_sec {cursor:pointer;text-align:center;width:50px;}
.td_mod_mod {cursor:pointer;text-align:center;width:50px;}
.snsbar {width:100%;padding:0 10px;margin-bottom:7px;line-height:3.2;}
.snsbar a {padding:0 5px;}
.hidden {display:none;}
</style>
</head>
<? $this->load->view('linker/body'); ?>
