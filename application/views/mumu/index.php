    <style>
    input { width:240px; }
    .container { width:480px; }
    .btn { height:80px; }
    .table { width:480px; }
    .table tr { border:0px solid #000; }
    .table th { text-align:center; }
    .table td { vertical-align:middle;padding:10px 22px 10px 20px;border-top:0px;border:0px solid #000; }
    .table .thside { width:70px; }
    .table .thcenter { width:180px; }
    .table .tdgap { border-bottom:1px solid #CCC; }
    .table .comment { vertical-align:top; }
    </style>
    <script type="text/javascript">
        function frm_comment_submit() {
            var frm = $('#frm_comment').serialize();
            $.ajax({
                url : '/mumu/commentinsert',
                type : 'POST',
                data : frm,
                datatype : 'json',
                success : function(data) {
                    alert(data);
                    location.href='/mumu';
                },
                error : function(x,e) {
                    alert(x.status);
                    alert(e);
                },
            });
        }
    </script>
    <table class="table">
        <tr>
            <td class="comment">
                <form class="form-horizontal" method="post" id="frm_comment" onSubmit="return false;">
                <input type="hidden" name="eater" value="prog106">
                <div class="input-append">
                    <input type="text" id="comment" name="comment" placeholder="Hungry!" style="width:350px;height:70px;">
                    <button type="button" id="frm_comment_btn" class="btn">Go Eat!</button>
                </div>
                </form>
                <table style="width:430px;">
                    <thead>
                    <? 
                    $nowdate = date('Y-m-d');
                    ?>
                    <tr>
                        <th><?=$nowdate;?></th>
                    </tr>
                    </thead>
                    <tr>
                        <td class="tdgap" colspan="3"></td>
                    </tr>
                    <?php
                    foreach($lists as $row) {
                    ?>
                    <tr class="tdgap" id="<?=$row['mu_id'];?>">
                        <td>
                            [<?=substr($row['mu_create_date'],11,8);?>]
                            <?=$row['mu_comment'];?> - 
                            <?=$row['mu_eater'];?>
                        </td>
                    </tr>
                    <?
                    }
                    ?>
                </table>
            </td>
        </tr>
    </table>
    <script>
        $('#frm_comment_btn').click(function() {
            var chkId = ['comment'];
            var chkMsg =['comment'];
            for(var i=0;i<chkId.length;i++) {
                if($('#' + chkId[i]).val() == '') {
                    alert(chkMsg[i] + ' is Null!');
                    $('#' + chkId[i]).focus();
                    return false;
                }
            }
            frm_comment_submit();
        });
    </script>
