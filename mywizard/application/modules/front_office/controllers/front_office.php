<?php 
class Front_office extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		echo 'terst';
		$user = new User();
		$user->get();
		echo $user->username . '<br />';
	}
}