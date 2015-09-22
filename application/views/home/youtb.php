<script src="/static/js/jquery-1.9.1.min.js"></script>
<style>
.vBtn {width:750px;margin:26px auto 0;overflow:hidden;height:150px;}
.vBtn a.fv:hover {background-color:#ffcccc;}
.vBtn a.sv:hover {background-color:#00ff00;}
.vBtn a.tv:hover {background-color:#0000ff;}
.vList {cursor:pointer;float:left;width:150px;height:150px;padding:0 2px;}
a.fv.on {background-color:#ffcccc;}
a.sv.on {background-color:#00ff00;}
a.tv.on {background-color:#0000ff;}
</style>
<div class="vodwrap" style="height:330px;background-color:#ffcccc">
    <div style="width:800px;margin:0 auto;font-weight:bold;font-size:18px;text-align:center;line-height:100%;">
        동영상 플레이어 영역
        <div id="vod">
            <iframe src="http://www.youtube.com/embed/hHoyjg027WU?autoplay=0" width="745" height="435" id="tvcf_player" frameborder="0" data-tvid="hHoyjg027WU"></iframe>
        </div>
        <div class="vBtn">
            <a class="fv on vList" data-bgc="#ffcccc" data-tvid="hHoyjg027WU">CF 1탄 쇼핑편</a>
            <a class="sv vList" data-bgc="#00ff00" data-tvid="_OBlgSz8sSM">CF 2탄 쇼핑편</a>
            <a class="tv vList" data-bgc="#0000ff" data-tvid="jJyVFo240-g">CF 3탄 쇼핑편</a>
        </div>
    </div>
</div>
<script>
    var monstersale_player = {
        loadVideo : function(tvid,bgc) {
            var tvc=$('#tvcf_player');
            if(tvid != tvc.data('tvid')) {
                tvc.attr({'src':'http://www.youtube.com/embed/'+ tvid +'?autoplay=0'}).data('tvid', tvid);
                $('.vodwrap').css({'background-color':bgc});
            }
        },
        loadBtn : function(btn) {
            console.log(btn);
        }
    }

    //monstersale_player.loadVideo('_OBlgSz8sSM');
    $(".vList").click(function(e){
        //$(".vList").removeClass("selected");
        //self.addClass("selected");
        //$('.vList').attr({'bgcolor':'#FFFFFF'});
        $('.vList').removeClass('on');
        var self = $(this);
        self.addClass('on');
        monstersale_player.loadVideo(self.data('tvid'),self.data('bgc'));
    });
 
</script>
