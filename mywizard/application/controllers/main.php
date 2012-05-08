<?php
class Main extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		if($this->common->check_is_install_folder_exist()){
			$header_data = array('param_title'=>'Install Folder Exists !','param_header'=>'Wizard Warning ...');
			$this->load->view('common/header',$header_data);
			$this->load->view('common/install_folder_is_exist');
			$this->load->view('common/footer');
		}
		else 
		{
			redirect('front_office');
		}
	}
}