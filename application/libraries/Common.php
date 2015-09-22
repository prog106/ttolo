<?
class Common {
    public function debug_log($var="no data",$opt=false)
    {
        ob_start();
        print_r($var);
        $str = ob_get_clean();
        $str = "\n".$str."\n";
        if($opt) $str .= debug_backtrace()."\n";

        $fp = fopen('/Users/prog106/Sites/LOG/prog106log', 'a');
        fputs($fp, $str);
        fclose($fp);
    }
    public function debug($var="no data", $opt=false) {
        echo "<div style='border:1px solid #FF0000;padding:5px'><pre>";
        print_r($var);
        if($opt) print_r(debug_backtrace());
        echo "</pre></div>";
    }
}
?>
