<?php
class authentication{
var $obj;
	function __construct(){
		$this->obj = & get_instance();
	}
	function is_authenticated(){
		if($this->obj->simple_auth->is_logged_in()){
			return true;
		}
		else
		{
			$footer_data=array('navigator'=>array(array(anchor('front_page/login','Login','class="button"'))));
			$this->obj->load->view('front_page/not_loged_in',$footer_data);
			return false;
		}
	}
}