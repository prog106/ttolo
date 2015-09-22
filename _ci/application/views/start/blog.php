    <div class="wrap_blog">
        <ul class="h_blog">
            <li><img src="<?=$info['url'];?>" width="<?=$info['width'];?>" height="<?=$info['height'];?>"></li>
            <li><span class="logos"><a href="<?=$info['link'];?>"><?=$info['title'];?></a><br><?=$info['description'];?></span></li>
        </ul>
        <ul class="h_blog_main">
            <?
            $i = 0;
            foreach($item as $row) {
            ?>
            <li><h3><?=$row['title'];?></h3></li>
            <li><?=$row['description'];?></li>
            <li class="subinfo"><?=$row['category'];?> | <?=$row['pubDate'];?> | <a href="<?=$row['link'];?>">Link</a></li>
            <? if($i > 4) break; else $i++; } ?>
        </ul>
    </div>
    <div class="wrap_like" id="s_like">
        <ul class="h_like">
            <li><? //print_r($info); ?></li>
            <li><? //print_r($item); ?></li>
        </ul>
    </div>
