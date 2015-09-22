<!DOCTYPE html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<title>Lotto</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
<script src="/ci/static/js/shake.js"></script>
<style>
td {text-align:center}
</style>
<body>
<center>
<div data-role="header">
    <h1>로또</h1>
</div>
<table>
    <thead>
    <tr>
        <td>회차</td>
        <td width="200">번호</td>
        <td>Bonus</td>
    </tr>
    </thead>
    <tbody>
<?
$ttolo = array_reverse($ttolo);
$nbc = count($ttolo);
foreach($ttolo as $k => $v) {
?>
    <tr>
        <td><?=$nbc--;?></td>
        <td>
<?
    for($i=0;$i<6;$i++) {
        echo $v[$i];
        if($i < 5) echo ", ";
    }
?>
</td>
        <td><?=$v[6];?></td>
    </tr>
<?
}
?>
    </tbody>
</table>
</body>
</html>
