<?
class Xmls {
    function __construct() {
        $rpcconfig = &get_instance();
        $this->rpclist = $rpcconfig->config->item('RPC_URL');
    }
    public function getData($rpcname, $data) {
        /* 다른 방법
        $config = $GLOBALS['CFG']->config;
        $rpc = $config['RPC_URL'][$rpcname];
        */
        $rpc = $this->rpclist[$rpcname];
        $datatype = $rpc['datatype'];
        $host = $rpc['host'];
        $port = $rpc['port'];
        $url = $rpc['url'];

        if(!($fp = fsockopen($host, $port, $errno, $errstr, 180))) {
            return array('status' => 'FAIL', 'result' => array('errno' => $errno, 'errstr' => $errstr));
        }
        $getValues = null;
        $postValues = null;
        if($datatype == 'GET') {
            $getValues = "?";
            $length = "0";
            $getValues .= http_build_query($data);
        } else {
            $postValues = http_build_query($data);
            $length = strlen($postValues);
        }
        fputs($fp, $datatype." ".$url.$getValues." HTTP/1.1\r\n");
        fputs($fp, "Host: ".$host."\r\n");
        fputs($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
        fputs($fp, "Content-Length : ".$length."\r\n");
        fputs($fp, "Connection: close\r\n\r\n");
        fputs($fp, $postValues);
        $result = null;
        while(!feof($fp)) {
            $result .= fgets($fp,1024);
        }
        fclose($fp);
        $split = explode("\r\n\r\n", $result, 2);
        return array('status' => 'OK', 'result' => json_decode($split[1],1));
    }
}
?>
