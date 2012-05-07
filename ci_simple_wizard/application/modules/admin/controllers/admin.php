<?php
class Admin extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('menu');
//		$this->load->library('auth');
	}
	function index(){
		$header_data = array(
			'title'=>'Admin Page',
			'head_text'=>'Admin Page',
			'custom_text'=>'<span class="custom_info">User</span> : <span class="humanize">' . $this->session->userdata['username'] . '</span>',
		);
		$footer_data = array('menu'=>$this->menu->get_menus());
		if($this->auth->is_logged_in()){
			$this->load->view('header',$header_data);
			$this->load->view('admin/index');
			$this->load->view('footer',$footer_data);
		}
		else{
			redirect(base_url() . 'index.php/admin/login');
		}
	}
	function login(){
		$header_data = array(
			'title'=>'Admin Page',
			'custom_text'=>'<span class="custom_info">User</span>:<span class="humanize">x</span>',
		);
		$footer_data = array('menu'=>$this->menu->get_menus());
		$this->load->view('header',$header_data);
		$this->load->view('admin/login');
		$this->load->view('footer',$footer_data);
	}
	function login_handler(){
		$params = $this->input->post();
		foreach ($params as $key => $value){
			echo $key . ' and ' . $value . '<br />';
		}
		if($this->auth->log_in($params['name'],$params['password'])){
			redirect(base_url() . 'index.php/admin');
		}
		else 
		{
			echo 'not mat5ch';
		}
	}
	function logout(){
		$this->auth->log_out();
	}
	
	function is_logon(){
		echo $this->session->userdata('username');
//		if ($this->auth->is_logged_in()){
//			echo 'yes';
//		}
//		else{
//			echo 'no';
//		}
	}
}