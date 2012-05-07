<?php
class Main extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		$file_info = get_dir_file_info('./application/modules/install',true);
		if($file_info){
			$this->load->view('common/header');
			$this->load->view('main/index');
		}		
		else 
		{
			redirect('helpo');
		}
		echo '<br />';
	}
}