<style type="text/css">
body { margin:0;padding:0; }
.container { border:1px solid #000;width:240px;height:1000px; }
.left { position:absolute;left:0; }
.right { position:absolute;right:0px; }
.backlayer { position:absolute; }
</style>
<script type="text/javascript">
    function openLayer() {
        var wheight = $(window).height();
        var backlayer_style = { 'width':'100%', 'height':wheight, 'background-color' : '#000', 'opacity' : '0.3' }
        $('.backlayer').css(backlayer_style).fadeIn('fast', function() {
            var cDiv = document.createElement('div');
            $(cDiv).attr('class', 'layer').appendTo(document.body);
            $(cDiv).hide().load('mysp/layer', function() { resizeLayer(); }).fadeIn('slow');
        });
    }
    function resizeLayer() {
        var bl = $('.backlayer');
        var ol = $('.layer');
        var lp = $('.layerpage');
        if(ol.length == 0) return false;
        var w = $(window);
        var height = w.height();
        var width = w.width();
        var wtop = w.scrollTop();
        var owidth = lp.length == 0 ? ol.width() : lp.width();
        var oheight = lp.lenght == 0 ? ol.height() : lp.height();
        var otop = (height - oheight)/2;
        var oleft = (width - owidth)/2;
        bl.css({ 'height' : height, 'top' : wtop });
        ol.css({ 'position' : 'fixed', 'top' : otop, 'left' : oleft });
    }
    function closeLayer() {
        $('.backlayer').hide('slow');
        $('.layer').remove();
    }
    $(function() {
        openLayer();
        $(window).bind('scroll', resizeLayer);
        $(window).bind('resize', resizeLayer);
        $('.backlayer').click(function() { closeLayer(); });
    });
</script>
<body>
<div class="backlayer"></div>
<div class="container">
</div>
</body>
