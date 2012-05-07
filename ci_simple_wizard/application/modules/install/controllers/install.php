<?php
class Install extends CI_Controller{
	function __construct(){
		parent::__construct();
//		$this->load->library('auth');
	}
	function index(){
		$step = ($this->uri->segment(3)=='')?'First':$this->uri->segment(3);
		$header_data = array('title'=>$step);
		$data = array('step'=>$step);
		$this->load->view('admin/header',$header_data);
		switch ($step){
			case 'First':
				$this->load->view('install/step1',$data);
				break;
			case 'step2':
				$this->load->view('install/step2',$data);
				break;
			case 'step3':
				$this->load->view('install/step3',$data);
				break;
		}
	}
	function handler(){
		$params = $this->input->post();
		if(isset($params['next'])){
			switch ($params['step']){
				case 'First':
					$this->create_tables();
					redirect(base_url() . 'index.php/install/index/step2');
					break;
				case 'step2':
					$this->create_admin();
					redirect(base_url() . 'index.php/install/index/step3');
					break;
			}
		}
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
		$this->auth->create_user($params['admin'],$params['password1'],$params['email']);
	}
}