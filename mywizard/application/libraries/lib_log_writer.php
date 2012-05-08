<?php
class Lib_log_writer{
	function __construct(){
		$this->load->helper('file');
	}
	function write(){
		$data=array('satu','dua','tiga');
		if(!write_file('log.php',$data)){
			echo 'Unable to write data';
		}
		else{
			echo 'data written';
		}
	}
}