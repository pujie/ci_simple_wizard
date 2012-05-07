<?php
class Register extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('auth');
	}
	function index(){
		$result = $this->auth->create_user('jojon','pelawak','puji@padi.net.id');
		if($result){
			echo 'success <br />';
		}
		else{
			echo 'error <br />';
		} 
		
	}
}