<?php
class Index extends CI_Controller{
var $user_data;
var $data;
	function __construct(){
		parent::__construct();
		$this->config->load('padi_config');
	}
	function index(){
		if($this->auth->is_logged_in()){
			redirect('front_page');
		}
		else{
			redirect('front_page/login');
		}
	}
}
