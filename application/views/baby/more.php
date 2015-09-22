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
                $timer = $dgap."D ";
                $timer .= " ago";
            } else if($dgap == 1) {
                $timer = "Yesterday";
            } else {
                $timer = ($mgap < 1)? '': $mgap."H ";
                $timer .= $hgap."M ";
                $timer .= " ago";
            }

            $imgview = ($row['mu_imagesrc'])? '<div class="imagesrc"><img src="/static/upload/'.$row['mu_imagesrc'].'"></div>' : '';
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
                <div class="comment" id="<?=$row['mu_id'];?>"><?=$row['mu_comment'];?></div>
            </li>
<?
*/
            }
            ?>
<script>
$(function () {
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
});
</script>
