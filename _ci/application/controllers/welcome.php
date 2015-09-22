<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Academic Free License version 3.0
 *
 * This source file is subject to the Academic Free License (AFL 3.0) that is
 * bundled with this package in the files license_afl.txt / license_afl.rst.
 * It is also available through the world wide web at this URL:
 * http://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world wide web, please send an email to
 * licensing@ellislab.com so we can send you a copy immediately.
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2013, EllisLab, Inc. (http://ellislab.com/)
 * @license		http://opensource.org/licenses/AFL-3.0 Academic Free License (AFL 3.0)
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
    public function debug_log($var="no data")
    {
        ob_start();
        print_r($var);
        $str = ob_get_clean();
        $str = "\n".$str."\n";

        $fp = fopen('/home/prog106/logs/rsslog', 'a');
        fputs($fp, $str);
        fclose($fp);
    }
    public function debug($var="no data", $die=false) {
        echo "<div stype='border:1px solid #FF0000;padding:5px'><pre>";
        print_r($var);
        echo "</pre></div>";
        if($die) die;
    }
    public function rss()
    {
        set_time_limit(0);
        ini_set('memory_limit' ,-1);
//        $rsshost['www'] = "http://www.ticketmonster.co.kr/";
        $rsshost['wvvw'] = "http://wvvw.ticketmonster.co.kr/";
        $rsshost['w1'] = "http://w1.prog106.d1.tmon.co.kr/";
        $rsshost['w2'] = "http://w2.prog106.d1.tmon.co.kr/";
        $rss['daily'] = "rss/daily?scode=9889&m=nomal";
        $rss['coup'] = "rss/couponmoa?scode=9889";
        $rss['coup_co'] = "rss/couponmoa_common?scode=9889";
        $rss['daone'] = "rss/daOneday";
        $rss['wow24'] = "rss/wow24";
        $rss['bbxml'] = "rss/bbxml";
        $rss['portal'] = "rss/portal";
        $rss['olleh'] = "rss/olleh_daily?scode=9889";
        $rss['dealtable'] = "rss/dealtable?scode=9889";
        $rss['couponmoachart'] = "rss/couponmoachart";
        $rss['shinhan'] = "rss/shinhancard?api_key=shinhan&secret=N1EB";
        $rss['naver'] = "Naverep/all.txt";
        $rss['thinkware'] = "rss/thinkware";

        $host = $this->input->get('host');
        $url = $this->input->get('url');

        if(empty($host) || empty($url)) {
            self::debug('host : ');
            self::debug($rsshost);
            self::debug('url : ');
            self::debug($rss, 1);
        }
        if(empty($host)) self::debug("host?", 1);
        if(empty($url)) self::debug("url?", 1);

        $rssurl = $rsshost[$host].$rss[$url];

        $fgc = file_get_contents($rssurl);
        self::debug_log($fgc);
        print_r('welcome!');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
