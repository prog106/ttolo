    <div class="row">
        <?
        foreach($lists as $row) {
            $title = $row['ad_title'];
            $desc = $row['ad_desc'];
            $admoney = number_format($row['ad_money']);
            $imgurl = $row['ad_img1'];
        ?>
        <div class="span4">
            <a href="adform/edit?id=<?=$row['id'];?>"><img src="/static/upload/<?=$imgurl;?>" class="img-polaroid"></a>
            <p class="text-left"><strong><?=$title;?></strong><br><?=$admoney;?> won / <?=$desc;?></p>
        </div>
        <?
        }
        ?>
    </div>
