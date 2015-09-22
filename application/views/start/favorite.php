    <div class="wrap_favorite" id="s_favorite">
        <ul class="h_favorite">
            <li><a href="http://www.todayhumor.co.kr">4오유</a></li>
            <li><a href="http://color106.egloos.com">블로그</a></li>
        </ul>
    </div>
<script type="text/javascript">
    function resizeLayer() {
        var fw = $('#fwrap');
        var f1 = $('#f1');
        var f2 = $('#f2');
        var w = $(window);
        var width = w.width();
        $('#width-size').text(width);
        if(width < 500) {
            fw.removeClass('fwrap').addClass('fwrap_f');
            f1.removeClass('f1').addClass('f1_f');
            f2.removeClass('f2').addClass('f2_f');
        } else {
            fw.removeClass('fwrap_f').addClass('fwrap');
            f1.removeClass('f1_f').addClass('f1');
            f2.removeClass('f2_f').addClass('f2');
        }
        var owidth = lp.length == 0 ? ol.width() : lp.width();
        var oheight = lp.lenght == 0 ? ol.height() : lp.height();
        var otop = (height - oheight)/2;
        var oleft = (width - owidth)/2;
        bl.css({ 'height' : height, 'top' : wtop });
        ol.css({ 'position' : 'fixed', 'top' : otop, 'left' : oleft });
    }
    $(function() {
        $(window).bind('resize', resizeLayer);
    });
</script>
<div id="width-size">100</div>
<div class="fwrap" id="fwrap">
    <div class="f1" id="f1">
        <h1>Hellow</h1>
    </div>
    <div class="f2" id="f2">
        <h1>World</h1>
    </div>
</div>
