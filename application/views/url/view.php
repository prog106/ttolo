<? $this->load->view('url/head'); ?>

<p class="bg-success" style="padding:5px 10px">
<a style="line-height:3" href="http://ttolo.kr/url/view/<?=$user?>" target="_blank">http://ttolo.kr/url/view/<?=$user?></a>
<a href="javascript:;" id="kakaotalk" data-url="<?=$user?>"><img src="/static/img/kt.jpg" width="41"></a>
<a href="javascript:;" id="kakaostory" data-url="<?=$user?>"><img src="/static/img/ks.png" width="35"></a>
</p>

<div class="list-group">
<? foreach($list as $k => $v) { ?>
    <a href="<?=$v['url']?>" target="_blank" class="list-group-item">
    <h5 class="list-group-item-heading"><?=($v['comment']) ? $v['comment'] : "<small>No Comment</small>"?> <small>(<?=substr($v['regdate'],2,8)?>)</small></h5>
        <h6 class="list-group-item-text"><?=$v['url']?></h6>
    </a>    
<? } ?>
</div>
<? $this->load->view('url/footer'); ?>
