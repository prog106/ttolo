<style type="text/css">
body { background-color:#EEE; }
.wrapper ul { margin:0;padding:0; }
.wrapper li { list-style-type:none;border-bottom:1px solid #CCC; }
.wrap { clear:both;background-color:#C00;width:900px;min-height:100%;margin:22px auto 0px;padding:20px 20px 0 20px;border:1px solid #000; }
.wrapper { position:relative;overflow:hidden; }
.logo { color:white;border:0px solid #000;cursor:pointer; }
.left { float:left;border:1px solid #000;background-color:white;width:540px; }
.right { float:right;border:1px solid #000;background-color:white;width:340px; }
.right li { border-bottom:0px solid #CCC; padding:2px; }
.right li table { margin:auto; }

.info { background-color:#EEE; }
.info .writer { font-weight:bold;font-size:12pt; }
.info .company { font-size:10pt; }
.info .timer { float:right;padding-right:3px; }
.info1 { cursor:pointer;margin:3px 3px 3px 15px; }
.info1 .title { font-size:10pt; }
.info1 .no { font-size:10pt;font-weight:bold; }
.info1 .timer { font-size:9pt;float:right;padding-right:3px; }
#view { background-color:#F4F4F4;border-bottom:1px solid #CCC; }
.comment { font-size:12pt;padding:5px 0 5px 0;cursor:pointer; }
.fullcomment { font-size:10pt;padding:5px 15px 5px 15px; }
.btn { margin-top:5px; }
.cal { height:200px; }
.calendar td { border:0px solid #000;width:30px;text-align:center; }
.calendar .month { font-size:12pt;font-weight:bold; }
.calendar .month .prev { cursor:pointer; }
.calendar .month .next { cursor:pointer; }
.calendar .week { font-size:7pt; }
.calendar .sun { color:#C00; }
.calendar .sat { color:#00C; }
.calendar .day { font-size:10pt; }
.calendar #today { background-color:#CCC; }
.calendar #before { font-size:7pt;background-color:#EEF; }
.calendar #after { font-size:7pt;background-color:#EEF; }

.reviewimage { width:200px;margin:5px 0 0 0;padding:5px; }
.reviewimage .on { width:200px;margin:5px 0 0 0;padding:5px;border:1px solid #000; }

.img { text-align:center;margin:5px auto 0; padding:5px;border:1px solid #CCC;display:none; }
.imagesrc { margin:5px auto 0; padding:5px;border:0px solid #CCC; }
.move { width:900px;height:20px;position:fixed;bottom:20px;display:none;padding-left:70px }
.move .top { float:right;font-weight:bold;color:#000;cursor:pointer; }
.remove { position:absolute;left:520px;cursor:pointer;padding-top:5px; }

.pagination { text-align:center; }
</style>
<script type="text/javascript">
    function frm_comment_submit() {
        var frm = $('#frm_comment').serialize();
        $.ajax({
            url : '/macham/commentinsert',
            type : 'POST',
            data : frm,
            datatype : 'json',
            success : function(data) {
                alert(data);
                location.href='/macham';
            },
            error : function(x,e) {
                alert(x.status);
                alert(e);
            },
        });
    }
    function move(cal) {
        $('.calendar').load('/macham/calendars', { 'month' : $('.'+cal).attr('id') });
    }
</script>
<? $time = time(); ?>
<div class="wrap">
    <div class="move"><span class="top"><i class="icon-arrow-up"></i>Top</span></div>
    <h3 class="logo">Ma Cham</h3>
    <div class="wrapper">
        <ul class="left">
            <?
            foreach($comments as $row) {
            $ctp = explode(" ", $row['mu_create_date']);
            $ct = explode("-", $ctp[0]);
            $cp = explode(":", $ctp[1]);
            $time = time();
            $commenttime = mktime($cp[0], $cp[1], $cp[2], $ct[1], $ct[2], $ct[0]);
            $gap = $time - $commenttime; // now - reg 3100

            $dgap = (int)($gap/(24*60*60)); // hour -> day
            if($dgap > 0) $gap = $gap - ($dgap*24*60*60);

            $mgap = (int)($gap/(60*60)); // min -> hour
            if($mgap > 0) $gap = $gap - ($mgap*60*60);

            $hgap = (int)(($gap)/60); // sec -> min
            if($hgap > 0) $gap = $gap - ($hgap*60);

            if($dgap > 1) {
                $timer = $dgap."day ";
                $timer .= " ago";
            } else if($dgap == 1) {
                $timer = "Yesterday";
            } else {
                $timer = ($mgap < 1)? '': $mgap."h ";
                $timer .= $hgap."m ";
                $timer .= " ago";
            }
            ?>
            <li id="li<?=$row['mu_id'];?>">
                <div class="info1" id="<?=$row['mu_id'];?>">
                    <span class="title"><?=($row['mu_title'])? txtlimit($row['mu_title'], 30) : txtlimit($row['mu_comment'], 30);?></span>
                    <span class="timer"><?=$timer;?></span>
                </div>
            </li>
<?
/*
            <li>
                <div class="info">
                    <span class="writer"><?=$row['mu_eater'];?></span>
                    <span class="company">compamy</span>
                    <span class="timer"><?=$timer;?></span>
                </div>
                <div class="remove" id="remove<?=$row['mu_id'];?>" style="display:none;"><i class="icon-remove"></i></div>
                <div class="comment" id="<?=$row['mu_id'];?>"><?=($row['mu_title'])? txtlimit($row['mu_title']) : txtlimit($row['mu_comment']);?></div>
            </li>
*/
?>
            <?
            }
            ?>
            <li id="moreview">
                <!-- ?=$paging;? -->
                <button class="btn btn-inverse" id="more">more view...</button>
                <input type="hidden" name="moreno" id="moreno" value="1">
            </li>
        </ul>
        <ul class="right">
            <li>
                <div id="countdown"></div>
            </li>
            <form class="form-horizontal" method="post" id="frm_comment" onSubmit="return false;">
            <li>
                <input type="hidden" name="eater" value="prog106">
                <input type="hidden" name="tps" id="tps" value="s">
                <input type="text" name="title" id="title" placeholder="Title Please" style="width:315px;margin:3px 0 5px 0;display:none;">
                <textarea name="comment" id="comment" placeholder="Comment Please" style="width:315px;height:100px;resize:none;"></textarea>
                <button type="button" id="frm_comment_btn" class="btn btn-info">Go!</button>
                <span class="btn btn-warning fileinput-button">
                    <i class="icon-camera icon-white"></i>
                    <input id="fileupload" type="file" name="photo[]" multiple>
                    <input type="hidden" name="timestamp" value="<?=$time;?>">
                    <input type="hidden" name="token" value="<?=md5('prog106'.$time);?>">
                    <input type="hidden" name="imagesrc" id="imagesrc" value="">
                </span>
                <button type="button" id="write" class="btn btn-danger">Long Write!</button>
                <div class="img"><img id="img" /><button class="btn btn-success" id="imgremove">Image Delete</button></div>
            </li>
            </form>
            <!-- li>
                user info / company / I'm write ...
            </li>
            <li>
                <select name="company">
                    <option>ALL</option>
                </select>
            </li -->
            <li class="cal"><?=$calendar;?>
            </li>
        </ul>
    </div>
</div>
<script>
$(function () {
    'use strict';
    var url = '/imgctrl/imagemacham';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $('#img').attr({ src : 'http://localhost/static/uploadready/' + data.result.returnname });
            $('.img').show();
            $('#imagesrc').val(data.result.returnname);
            $('.fileinput-button').hide();
        }
    });
    $('.logo').click(function() { location.href='/macham'; });
    $('.info1').click(function() {
        $(this).toggleClass(function() {
            $('#view').remove();
            var has = $(this).hasClass('open');
            if(!has) {
                var idx = this.id
                $.ajax({
                    type : 'post',
                    url : '/macham/viewcomment',
                    data : { srl : idx }
                }).success(function(result) {
                    $('#li'+idx).after(result);
                });
            }
            return 'open';
        });
    });
    $('#write').click(function() {
        $('#title').toggle('slow', function () {
            if($('#write').text() == 'Long Write!') {
                $('#write').text('Short Write!');
                $('#comment').css({ height:'250px', });
                $(this).focus();
                $('#tps').val('l');
            } else {
                if($('#title').val() != '') {
                    alert('Title is not insert!');
                }
                $('#write').text('Long Write!');
                $('#comment').css({ height:'100px', }).focus();
                $('#tps').val('s');
            }
        });
    });
    $(window).scroll(function() {
        if($(this).scrollTop() > 10) {
            $('.move').fadeIn();
        } else {
            $('.move').fadeOut();
        }
    });
    $('.top').click(function() {
        $('html body').animate({ scrollTop : 0}, 100);
        return false;
    });
    $('#imgremove').click(function() {
        $.ajax({
            type : 'post',
            url : '/imgctrl/imagemachamdrop',
            data : { imgsrc : $('#imagesrc').val() }
        }).done(function() {
            $('#imagesrc').val('');
            $('.img').hide();
            $('.fileinput-button').show();
        });
    });
    $('#more').click(function() {
        $.ajax({
            type : 'post',
            url : '/macham/viewmore',
            data : { moreno : $('#moreno').val() }
        }).success(function(data) {
            var no = $('#moreno').val();
            $('#moreview').before(data);
            no++;
            $('#moreno').val(no);
        });
    });
    $('#frm_comment_btn').click(function() {
        if($('#title').val() == '' && $('#tps').val() == 'l') {
            alert('Title Insert Please!');
            $('#title').focus();
            return false;
        }
        if($('#tps').val() == 's') {
            $('#title').val('');
        }
        if($('#comment').val() == '') {
            alert('Comment Insert Please!');
            $('#comment').focus();
            return false;
        }
        frm_comment_submit();
    });
    var austDay = new Date();
    austDay = new Date(<?=date('Y');?>, <?=date('n');?> - 1, <?=date('j');?>, 23, 59, 59);
    $('#countdown').countdown({
        until: austDay,
        format:'HMS',
        compact:true,
        layout: '{hnn}{sep}{mnn}{sep}{snn} Left Today' + "(<?=date('Y-m-d');?>)"
    });
    $('#comment').focus();
    $('textarea').keypress(function(e) {
//        if(e.keyCode == 13) return false;
    });
});
</script>
