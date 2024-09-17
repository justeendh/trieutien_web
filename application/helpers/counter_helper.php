<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if ( ! function_exists('count_visitor')) {
    function count_visitor($count = true)
    {
		
        $filecounter=(APPPATH . 'logs/counter.txt');
        $kunjungan=file($filecounter);
        if(!isset($_SESSION['useraccess'])) {
			if($count){
				$kunjungan[0]++;
				$CI =& get_instance();
				$counterdeleteOld = $CI->db->query("DELETE FROM hd_userbydatelogs WHERE DATE_ACCESS < DATE_SUB('".date('Y-m-d')."', INTERVAL 365 DAY)");
				$counterdatecheck = $CI->db->query("SELECT COUNTER FROM hd_userbydatelogs WHERE DATE_ACCESS = '".date('Y-m-d')."'");
				if($counterdatecheck->num_rows() == 0 ){
					$CI->db->query("INSERT INTO hd_userbydatelogs (DATE_ACCESS, COUNTER) VALUES ('".date('Y-m-d')."', 1)");
				}
				else $CI->db->query("UPDATE hd_userbydatelogs SET COUNTER = COUNTER+1 WHERE DATE_ACCESS = '".date('Y-m-d')."'");
				
				//OS
				if (strpos(strtolower($CI->agent->platform()), 'macintosh') !== false
				   || strpos(strtolower($CI->agent->platform()), 'iphone') !== false
				   || strpos(strtolower($CI->agent->platform()), 'ipod') !== false
				   ||strpos(strtolower($CI->agent->platform()), 'ipad') !== false){
					$CI->db->query("UPDATE hd_userbybrowserlogs SET COUNTER = COUNTER+1 WHERE KEY__LOGS = 'apple'");
				}
				else if (strpos(strtolower($CI->agent->platform()), 'windows 10') !== false
						|| strpos(strtolower($CI->agent->platform()), 'windows nt 10') !== false){
					$CI->db->query("UPDATE hd_userbybrowserlogs SET COUNTER = COUNTER+1 WHERE KEY__LOGS = 'windows10'");
				}
				else if (strpos(strtolower($CI->agent->platform()), 'windows') !== false){
					$CI->db->query("UPDATE hd_userbybrowserlogs SET COUNTER = COUNTER+1 WHERE KEY__LOGS = 'windows'");
				}
				else if (strpos(strtolower($CI->agent->platform()), 'android') !== false){
					$CI->db->query("UPDATE hd_userbybrowserlogs SET COUNTER = COUNTER+1 WHERE KEY__LOGS = 'android'");
				}
				else if (strpos(strtolower($CI->agent->platform()), 'linux') !== false
				   || strpos(strtolower($CI->agent->platform()), 'fedora') !== false
				   || strpos(strtolower($CI->agent->platform()), 'ubuntu') !== false){
					$CI->db->query("UPDATE hd_userbybrowserlogs SET COUNTER = COUNTER+1 WHERE KEY__LOGS = 'apple'");
				}
				else {
					$CI->db->query("UPDATE hd_userbybrowserlogs SET COUNTER = COUNTER+1 WHERE KEY__LOGS = 'othersOs'");
				}
				
				//browser
				if (strpos(strtolower($CI->agent->agent_string()), 'firefox') !== false){
					$CI->db->query("UPDATE hd_userbybrowserlogs SET COUNTER = COUNTER+1 WHERE KEY__LOGS = 'firefox'");
				}
				else if (strpos(strtolower($CI->agent->agent_string()), 'edge') !== false){
					$CI->db->query("UPDATE hd_userbybrowserlogs SET COUNTER = COUNTER+1 WHERE KEY__LOGS = 'edge'");
				}				
				else if (strpos(strtolower($CI->agent->agent_string()), 'crom') !== false
						|| strpos(strtolower($CI->agent->agent_string()), 'coc_coc_browser') !== false){
					$CI->db->query("UPDATE hd_userbybrowserlogs SET COUNTER = COUNTER+1 WHERE KEY__LOGS = 'crom'");
				}
				else if (strpos(strtolower($CI->agent->agent_string()), 'chrome') !== false){
					$CI->db->query("UPDATE hd_userbybrowserlogs SET COUNTER = COUNTER+1 WHERE KEY__LOGS = 'chrome'");
				}
				else if (strpos(strtolower($CI->agent->agent_string()), 'safari') !== false){
					$CI->db->query("UPDATE hd_userbybrowserlogs SET COUNTER = COUNTER+1 WHERE KEY__LOGS = 'safari'");
				}
				else{
					$CI->db->query("UPDATE hd_userbybrowserlogs SET COUNTER = COUNTER+1 WHERE KEY__LOGS = 'othersBrowser'");
				}
			}
			$_SESSION['useraccess'] = "hasaccess";
			
		}
		
        $file=fopen($filecounter, 'w');
        fputs($file, $kunjungan[0]);
        fclose($file);
        return $kunjungan[0];
    }
}