<?php
class Common {
	var $obj;
	function __construct(){
		$this->obj = & get_instance();
	}
	function check_is_install_folder_exist(){
		if(get_dir_file_info('./application/modules/install')){
			return true;
		}
		else 
		{
			return false;
		}
	}
	function remove_single_quote($string){
		return str_replace("'","''",$string);
	}
	function show_single_quote($string){
		return str_replace("''","'",$string);	
	}
	function thousand_separator($number=''){
		if($number==''){
		return '0.00';
		}
		$out='';
		$exploded = explode(".",$number);
		$k=0;
		for($c=strlen($exploded[0]);$c>=0;$c--){
			$out = substr($exploded[0],$c,1) . $out;
			if(($k%3==0) && ($k!=strlen($exploded[0]))&&($k!=0)){
				$out = ',' . $out;
			}
			$k++;
		}
		if(!empty($exploded[1])){
			$out.='.' . $exploded[1];
		}
		else 
		{
			$out.='.00';
		}
		return $out;
	}
	function de_decimalize($value){
		$output=$value;
		return str_replace(',','',$output);
	}
	function decimalize($value){
		return $value;
	}

}
