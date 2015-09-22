<? $this->load->view('url/head'); ?>

<p class="bg-success" style="padding:5px 10px">
<a style="line-height:3" href="http://ttolo.kr/url/view/<?=$user?>" target="_blank">http://ttolo.kr/url/view/<?=$user?></a>
<a href="javascript:;" id="kakaotalk" data-url="<?=$user?>"><img src="/static/img/kt.jpg" width="41"></a>
<a href="javascript:;" id="kakaostory" data-url="<?=$user?>"><img src="/static/img/ks.png" width="35"></a>
</p>

<form id="url_form" name="url_form" method="post">
<table width="100%">
    <tr>
        <td style="padding:0 10px"><h6 style="line-height:0">Comment (선택)</h6><input type="text" id="comment" name="comment" value="" placeholder="Comment" style="width:100%" class="form-control"></div>
    </tr>
    <tr>
        <td style="padding:0 10px"><h6 style="line-height:0">Url (필수)</h6><input type="text" id="url" name="url" value="" placeholder="URL" style="width:100%" class="form-control"></td>
    </tr>
    <tr>
        <td><input type="submit" class="btn btn-primary btn-sm" style="float:right;margin:3px 10px;padding:5px 25px;" value="등록하기"></td>
    </tr>
</table>
</form>
<div class="list-group">
<? foreach($list as $k => $v) { ?>
    <div class="list-group-item">
    <button type="button" class="btn btn-danger btn-xs del" data-id="<?=$v['srl']?>">Delete</button>
    <a href="<?=$v['url']?>" target="_blank" class="list-group-item" style="border:0px;">
    <h5 class="list-group-item-heading"><?=($v['comment']) ? $v['comment'] : "<small>No Comment</small>"?> <small>(<?=substr($v['regdate'],2,8)?>)</small></h5>
        <h6 class="list-group-item-text"><?=$v['url']?></h6>
    </a>
    </div>
<? } ?>
</div>
<script>
$(function() {
    $("#url_form").submit(function() {
        if(!$("#url").val()) {
            alert('URL을 입력하세요.');
            $("#url").focus();
            return false;
        }
        $.ajax({
            cache : false,
            url : "/url/urlsave",
            type : "POST",
            data : $("#url_form").serialize(),
            success : function(r) {
                var o = $.parseJSON(r);
                if(o.rtn == 'OK') {
                    alert('정상적으로 등록 되었습니다.');
                    self.location.reload();
                } else {
                    alert('등록에 실패하였습니다.');
                }
            },
            error : function(e) {
                alert('심각한 오류가 발생하였습니다.');
            }
        });
        return false;
    });
    $(".del").click(function() {
        if(confirm('정말 삭제하시겠습니까?')) {
            $.ajax({
                cache : false,
                url : "/url/urldel",
                type : "POST",
                data : {srl:$(this).data('id')},
                success : function(r) {
                    var o = $.parseJSON(r);
                    if(o.rtn == 'OK') {
                        //alert('정상적으로 삭제 되었습니다.');
                        self.location.reload();
                    } else {
                        alert('삭제에 실패하였습니다.');
                    }
                },
                error : function(e) {
                    alert('심각한 오류가 발생하였습니다.');
                }
            });
            return false;
        }
    });
});
</script>
<? $this->load->view('url/footer'); ?>
