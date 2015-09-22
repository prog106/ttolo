<!DOCTYPE html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<title>Test</title>
<link rel="apple-touch-icon" size="96x96" href="/static/img/ttolo_logo.png" />
<link rel="shortcut icon" href="/static/img/ttolo_logo.png" />
<script src="//code.jquery.com/jquery-1.8.3.min.js"></script>
</head>
<body>
<div id="game">
</div>
<script>
function goal() {
    $('#step4').animate({
        "top" : "+=50px",
        "font-size" : "50pt",
    },"slow", function() {
        restart();
    });
}
function nogoal() {
    $('#step5').animate({
        "top" : "+=50px",
        "font-size" : "50pt",
    },"slow", function() {
        restart();
    });
}
function restart() {
    $('span').hide();
    $('#restart').show();
}
function reset() {
    $.ajax({
        type : 'post',
        url : '/test/game',
        success : function(data) {
            $('#game').append(data);
            var st = 2;
            $('#step'+st).html('1');
            $('#k'+st).html('O');
            $('#leftk').click(function() {
                $('.st').html('');
                if(st > 1) { 
                    st = st - 1;
                    $('#step'+st).html('1');
                } else if(st == 1) {
                    $('#step1').html('1');
                }
            });
            $('#rightk').click(function() {
                $('.st').html('');
                if(st > 2) { 
                    $('#step3').html('1');
                } else if(st < 3) {
                    st = st + 1;
                    $('#step'+st).html('1');
                }
            });
            $('#go').click(function() {
                $.ajax({
                    type : 'post',
                    url : '/test/suc'
                }).done(function(data) {
                    $('.keeper').html('');
                    $('#k'+data).html('O');
                    $('#step'+st).animate({
                        "top" : "-=50px",
                        "font-size" : "0pt",
                    },"slow", function() {
                        $(this).css({"top" : "+=50px", "font-size" : "50pt"}).html('');
                        if(data == st) nogoal(); else goal();
                    });
                });
            });
            $('#restart').click(function() { $('#game').html(''); reset(); });
        }
    });
}
reset();
</script>
</body>
</html>
