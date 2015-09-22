<!DOCTYPE html>
<html lang="kr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/static/img/ttolo_logo.png">

    <title>또로 Project</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/static/css/ttolo.0.1.css">

  </head>

  <body>
<select name="cate1">
    <option value="">선택</option>
<?
foreach($rows as $k => $v) {
?>
    <option value="<?=$v['id'];?>"><?=$v['cat_name'];?></option>
<?
}
?>
</select>

<select name="cate2">
</select>

<select name="cate3">
</select>
<script>
function catech(d, v) {
    if(d==2 && !v) {
        $("select[name='cate2']").html('');
        $("select[name='cate3']").html('');
    }
    var depth = d;
    $.ajax({
        type : "post",
        dataType : 'json',
        url : "/cate/getcate",
        data : { depth : depth, parent_id : v }
    }).done(function(list) {
        $("select[name='cate"+d+"']").html('');
        for(var i=0;i<list.length;i++) {
            $("select[name='cate"+d+"']").append("<option value='"+list[i][0]+"'>"+list[i][1]+"</option>");
            if(i==0 && d==2) { catech('3', list[i][0]); }
        }
    });
}
$("select[name='cate1']").change(function() {
    catech('2', $(this).val());
});
$("select[name='cate2']").change(function() {
    catech('3', $(this).val());
});
</script>
