    <script type="text/javascript">
        function frm_adinsert_submit() {
            var frm = $('#frm_adinsert').serialize();
            $.ajax({
                url : '/adform/adinsert',
                type : 'POST',
                data : frm,
                datatype : 'json',
                success : function(data) {
                    alert(data);
                    location.href='/adform';
                },
                error : function(x,e) {
                    alert(x.status);
                    alert(e);
                },
            });
        }
    </script>
    <form class="form-horizontal" method="post" id="frm_adinsert" enctype="multipart/form-data">
    <input type="hidden" name="tps" value="insert">
        <div class="control-group">
            <label class="control-label" for="title">title</label>
            <div class="controls">
                <input type="text" id="title" name="title" placeholder="title" value="">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="desc">desc</label>
            <div class="controls">
                <input type="text" id="desc" name="desc" placeholder="desc" value="">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="startdate">start_date</label>
            <div class="controls">
                <div id="datetimepicker1" class="input-append date">
                    <input data-format="yyyy-MM-dd hh:mm:ss" type="text" id="startdate" name="startdate" placeholder="start_date" value="">
                    <span class="add-on">
                        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="enddate">end_date</label>
            <div class="controls">
                <div id="datetimepicker2" class="input-append date">
                    <input data-format="yyyy-MM-dd hh:mm:ss" type="text" id="enddate" name="enddate" placeholder="end_date" value="">
                    <span class="add-on">
                        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="money">money</label>
            <div class="controls">
                <input type="text" id="money" name="money" placeholder="money" value="">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="img1">main images</label>
            <div class="controls">
                <input type="file" id="_img1" name="_img1" placeholder="main image">
                <input type="hidden" id="img1" name="img1">
                <span id="review1"></span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="img2">contents images</label>
            <div class="controls">
                <input type="file" id="_img2" name="_img2" placeholder="contents images">
                <input type="hidden" id="img2" name="img2">
                <span id="review2"></span>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <button type="button" id="frm_adinsert_btn" class="btn">Create</button>
            </div>
        </div>
    </form>
    <script>
        <? $time = time(); ?>
        $(function() {
            $('#datetimepicker1').datetimepicker({ language: 'pt-BR' });
            $('#datetimepicker2').datetimepicker({ language: 'pt-BR' });
            $('#_img1').uploadify({
                'formData' : {
                    'timestamp' : '<?=$time;?>',
                    'token' : '<?=md5('prog106'.$time);?>',
                    'fileTypeDesc' : 'Image Files',
                    'fileTypeExts' : '*.jpg, *.gif, *.png',
                    'fileSizeLimit' : '100KB',
                },
                'swf' : '/static/js/uploadify.swf',
                'uploader' : '/imgctrl/imageinsert',
                'onUploadSuccess' : function(file, data) {
                    $('#img1').val(data);
                    $('#review1').html('<img src="/static/upload/' + data + '">');
                }
            });
            $('#_img2').uploadify({
                'formData' : {
                    'timestamp' : '<?=$time;?>',
                    'token' : '<?=md5('prog106'.$time);?>',
                    'fileTypeDesc' : 'Image Files',
                    'fileTypeExts' : '*.jpg, *.gif, *.png',
                    'fileSizeLimit' : '100KB',
                },
                'swf' : '/static/js/uploadify.swf',
                'uploader' : '/imgctrl/imageinsert',
                'onUploadSuccess' : function(file, data) {
                    $('#img2').val(data);
                    $('#review2').html('<img src="/static/upload/' + data + '">');
                }
            });
        });
        $('#frm_adinsert_btn').click(function() {
            var chkId = ['title', 'desc', 'startdate', 'enddate', 'money'];
            var chkMsg =['title', 'desc', 'start_date', 'end_date', 'money', 'image1', 'image2'];
            for(var i=0;i<chkId.length;i++) {
                if($('#' + chkId[i]).val() == '') {
                    alert(chkMsg[i] + ' is Null!');
                    $('#' + chkId[i]).focus();
                    return false;
                }
            }
            frm_adinsert_submit();
        });
    </script>
