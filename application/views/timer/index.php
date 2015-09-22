<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>또로-타이머</title>
<script src="/static/js/jquery-1.9.1.min.js"></script>
<style>
.ui-btn {margin:.1em 0;padding:.7em .4em;}
div.ui-slider-switch { width: 120px; }
#popup_result-popup { position:'fixed',top:'0'; }
.ui-select { width:90px; }
.ui-select span { float:left; }
</style>
</head>

<body>
<span id="ti" style="font-size:100px"></span>
<script>
function timer() {
    var t = new Date();
    
    var ti = "Time ";
    ti += t.getHours() + " : ";
    ti += t.getMinutes() + " : ";
    ti += t.getSeconds();
    $('#ti').html(ti);
    setTimeout(function(){timer();},500);
}
timer();
</script>
</body>
</html>
