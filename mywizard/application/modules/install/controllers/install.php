<?php 
class Install extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		switch ($this->uri->segment(3)){
			case 'database_setting':
				$header_data = array('param_title'=>'Database Setting','param_header'=>'Database Setting');
				$this->load->view('common/header',$header_data);
				$this->load->view('install/database_setting');
				$this->load->view('common/footer');
				break;
			case 'create_tables':
				$header_data = array('param_title'=>'Create Tables','param_header'=>'Create Tables');
				$this->load->view('common/header',$header_data);
				$this->load->view('install/create_tables');
				$this->load->view('common/footer');
				break;
			case 'create_admin':
				$header_data = array('param_title'=>'Create Admin','param_header'=>'Create Admin');
				$this->load->view('common/header',$header_data);
				$this->load->view('install/create_admin');
				$this->load->view('common/footer');
				break;
		}
	}
	function handler(){
		$params = $this->input->post();
		switch ($params['step']){
			case 'database_setting':
				if($this->database_setting()){
					redirect('install/index/create_tables');
				}
				break;
			case 'create_tables':
				$this->create_tables();
				redirect('install/index/create_admin');
				break;
			case 'create_admin':
				$this->create_admin();
				$header_data = array('param_title'=>'Installation Success','param_header'=>'Installation Success');
				$this->load->view('common/header',$header_data);
				$this->load->view('install/installation_success');
				break;
		}
	}
	function database_setting(){
		return TRUE;
	}
	function create_tables(){
		$db_prefix='';
		
		$query = 'drop table if exists ' . $db_prefix . 'ci_sessions; ';
		$result = $this->db->query($query);
		if($result){
			echo 'drop ci_sessions success ...<br />';
		}
		else 
		{
			echo 'drop ci_sessions error ...<br />';
		}
		
		$query = 'create table ' . $db_prefix . 'ci_sessions ';
		$query.= '(session_id varchar(40) primary key default 0,ip_address varchar(16) default 0,user_agent varchar(100), last_activity int(10) unsigned default 0, user_data text)';
		$result = $this->db->query($query);
		if($result){
			echo 'create table ci_sessions success ...<br />';
		}
		else 
		{
			echo 'create table ci_sessions error ...<br />';
		}
		
		$query = 'drop table if exists ' . $db_prefix . 'chapters; ';
		$result = $this->db->query($query);
		if($result){
			echo 'drop chapters success ...<br />';
		}
		else 
		{
			echo 'drop chapters error ...<br />';
		}
		
		$query = 'create table ' . $db_prefix . 'chapters ';
		$query.= '(id int primary key auto_increment,name varchar(50),chapter_description  text)';
		$result = $this->db->query($query);
		if($result){
			echo 'create table chapters success ...<br />';
		}
		else 
		{
			echo 'create table chapters error ...<br />';
		}
		$query = 'drop table if exists ' . $db_prefix . 'users; ';
		$result = $this->db->query($query);
		if($result){
			echo 'drop table users success <br />';
		}
		else 
		{
			echo 'drop table users error <br />';
		}
		$query = 'create table ' . $db_prefix . 'users ';
		$query.= '(id int primary key auto_increment, 
		username varchar(40),
		email varchar(50),
		password varchar(40),
		salt varchar(40), 
		status varchar(1))';
		$result = $this->db->query($query);
		if($result){
			echo 'create table users success <br />';
		}
		else 
		{
			echo 'create table users error <br />';
		}
	}
	function create_admin(){
		$params = $this->input->post();
		$this->auth->create_user($params['admin'],$params['password'],$params['email']);
	}
	
}