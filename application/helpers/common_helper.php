<?
function page($cnt, $cntperpg, $viewpg) {
    $html = "<div class=\"pagination\"><ul>";
    for($i=1;$i<=((int)($cnt/$cntperpg))+1;$i++) {
        $cl = ($viewpg == $i)? "disabled" : "active";
        //$html .= "<li class=\"".$cl."\"><a href=\"macham?pgno=".$i."\">".$i."</a></li>";
        $html .= "<li><a href=\"macham?pgno=".$i."\">".$i."</a></li>";
    }
    $html .= "</ul></div>";
    return $html;
}
function txtlimit($txt, $limit=55) {
    if(mb_strlen($txt, 'UTF-8') > $limit) {
        $txt = mb_substr($txt, 0, $limit, 'UTF-8').'...';
    }
    return $txt;
}
function calendar($month='') {
    if(empty($month)) {
        $cal = array(
            'toyear' => date('Y'),
            'tomonth' => date('m'),
            'today' => date('j'),
        );
        $today = $cal['today'];
    } else {
        $part = explode("-", $month);
        $cal = array(
            'toyear' => $part[0],
            'tomonth' => $part[1],
            'today' => 1,
        );
        $today = ($part[0] == date('Y') && $part[1] == date('m'))? date('j') : 0;
    }

    $sday = mktime(0,0,0,$cal['tomonth'],1,$cal['toyear']);
    $day = mktime(0,0,0,$cal['tomonth'],$cal['today'],$cal['toyear']);
    $cal['eday'] = date('t', $day);
    $eday = mktime(0,0,0,$cal['tomonth'],$cal['eday'],$cal['toyear']);

    $prev = mktime(23,59,59,date('m',$day),1-1,date('Y',$day));
    $prevmonth = date('Y-m', $prev);
    $prevlastday = date('t', $prev);
    $nextmonth = date('Y-m', mktime(23,59,59,date('m',$day)+2,1-1,date('Y',$day)));

    $cal['sday_week'] = date('w', $sday); // 1 : 0-6 sun-sat
    $cal['day_week'] = date('w', $day); // 1 : 0-6 sun-sat
    $cal['eday_week'] = date('w', $eday); // last day 28-31

    $firstweek = $cal['sday_week'];
    $lastweek = $cal['eday_week'];
    $html = '
<table class="calendar">
    <tr class="month">
        <td colspan="2"><span id="'.$prevmonth.'" class="prev" onclick="move(\'prev\')"><i class="icon-backward"></i></span></td>
        <td colspan="3">'.$cal["toyear"].'-'.$cal["tomonth"].'</td>
        <td colspan="2"><span id="'.$nextmonth.'" class="next" onclick="move(\'next\')"><i class="icon-forward"></i></span></td>
    </tr>
    <tr class="week">
        <td class="sun">SUN</td>
        <td>MON</td>
        <td>TUE</td>
        <td>WED</td>
        <td>THU</td>
        <td>FRI</td>
        <td class="sat">SAT</td>
    </tr>
    <tr class="day">
';
    $prevday = $prevlastday - $firstweek + 1;
    for($i=0;$i<$firstweek;$i++) {
        $class = ($i == 0)? ' class="sun"': '';
        $html .= "
        <td".$class." id=\"before\">".$prevday."</td>";
        $prevday++;
    }

    for($i=1;$i<=$cal['eday'];$i++) {
        $class = ($firstweek % 7 == 0)? ' class="sun"': (($firstweek % 7 == 6)? ' class="sat"': '');
        $id = ($i == $today)? ' id="today"': '';
        $html .= "
        <td".$class.$id.">".$i."</td>";
        if($firstweek % 7 == 6) {
            $html .= '
    </tr>
    <tr class="day">
';
        }
        $firstweek++;
    }

    $nextday = 6 - $lastweek;
    for($i=0;$i<$nextday;$i++) {
        $class = ($i == ($nextday - 1))? " class=\"sat\"" : "";
        $html .= "
        <td".$class." id=\"after\">".($i+1)."</td>";
    }

    $html .= "
    </tr>
</table>
";

    return $html;
}
?>
