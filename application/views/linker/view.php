<? $this->load->view('linker/head'); ?>
<? $this->load->view('linker/sns'); ?>

<p class="bg-primary" id="ck_recent" style="padding:15px;cursor:pointer;background-color:#5cb85c;"><img src="/static/img/sign_02.png"> 최근 생성된 MyLinker 보기</p>
<div id="wrap_recent" style="display:none;">
<table class="linker_table" style="margin-bottom:10px;">
<? foreach($recentlist as $k => $v) { ?>
    <tr>
        <td class="td_cont gourl" data-url="http://ttolo.kr/linker/view/<?=$v['user'];?>" style="cursor:pointer"><h6>http://ttolo.kr/linker/view/<?=$v['user'];?></h6></td>
        <td class="td_go"><img src="/static/img/icons/glyphicons_217_circle_arrow_right.png" width="20" class="gourl" data-url="http://ttolo.kr/linker/view/<?=$v['user'];?>" style="cursor:pointer;padding-bottom:10px;"></td>
    </tr>
<? } ?>
    <tr>
        <td colspan="2" style="height:10px;"></td>
    </tr>
    <tr>
        <td colspan="2" style="line-height:2;text-align:center;cursor:pointer;background-color:#5cb85c;" class="bg-primary" id="ck_recentclose">close</td>
    </tr>
</table>
</div>

<table class="linker_table">
<? foreach($list as $k => $v) { ?>
    <tr>
        <td class="td_cont gourl" data-url="<?=$v['url']?>" style="cursor:pointer;"><h6 style="color:#999"><?=((empty($v['comment']))?"No Comment":$v['comment'])?> <small>(<?=substr($v['regdate'],2,8)?>)</small></h6><span class="run" data-tp="<?=$v['tp']?>" data-url="<?=$v['url']?>"><h6><?=$v['url']?></h6></span></td>
        <td class="td_go"><img src="/static/img/icons/glyphicons_217_circle_arrow_right.png" width="20" class="gourl" data-url="<?=$v['url']?>" style="cursor:pointer;padding-bottom:15px;"></td>
    </tr>
<? } ?>
</table>
<script>
$(function() {
    $("#ck_recent, #ck_recentclose").click(function() { $("#wrap_recent").slideToggle(); });
    $('.run').each(function() {
        var tp = $(this).data('tp');
        var wd = <?=($this->_device == 'W') ? "560" : "280"?>;
        var ht = <?=($this->_device == 'W') ? "315" : "180"?>;
        switch(tp) {
        case 'youtubewatch' :
            var tube = $(this).data('url');
            tube = tube.substr(32,11);
            $(this).before("<iframe width=\""+wd+"\" height=\""+ht+"\" src=\"//www.youtube.com/embed/"+tube+"\" frameborder=\"0\" allowfullscreen></iframe>");
            break;
        case 'youtubeembed' :
            var tube = $(this).data('url');
            tube = tube.substr(30,11);
            $(this).before("<iframe width=\""+wd+"\" height=\""+ht+"\" src=\"//www.youtube.com/embed/"+tube+"\" frameborder=\"0\" allowfullscreen></iframe>");
            break;
        case 'youtube' :
            var tube = $(this).data('url');
            tube = tube.substr(16,11);
            $(this).before("<iframe width=\""+wd+"\" height=\""+ht+"\" src=\"//www.youtube.com/embed/"+tube+"\" frameborder=\"0\" allowfullscreen></iframe>");
            break;
        case 'image' :
            $(this).before("<img src=\""+$(this).data('url')+"\" style=\"max-width:280px;min-width:50px;\">");
            break;
        case 'vimeo' :
            var vime = $(this).data('url');
            vime = vime.substr(37,11);
            $(this).before("<iframe width=\""+wd+"\" height=\""+ht+"\" src=\"//player.vimeo.com/video/"+vime+"\" frameborder=\"0\" allowfullscreen></iframe>");
            break;
        case 'youku' :
            var yk = $(this).data('url');
            yk = yk.substr(29,13);
            $(this).before("<iframe width=\""+wd+"\" height=\""+ht+"\" src=\"//player.youku.com/embed/"+yk+"\" frameborder=\"0\" allowfullscreen></iframe>");
            break;
        case 'youkuplayer' :
            var yk = $(this).data('url');
            yk = yk.substr(39,13);
            $(this).before("<iframe width=\""+wd+"\" height=\""+ht+"\" src=\"//player.youku.com/embed/"+yk+"\" frameborder=\"0\" allowfullscreen></iframe>");
            break;
        case 'string' :
            break;
        }
        
    });
    $('.gourl').click(function() {
        var url = $(this).data('url');
        go(url);
    });
});
</script>
<? $this->load->view('linker/footer'); ?>
