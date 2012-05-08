<?php
class Lib_array{
	function create_array($model,$arr_param){
		$output=array();
		foreach ($model as $mdl){
			$tmp=array();
			foreach ($arr_param as $arr){
				array_push($tmp, $mdl->$arr);
			}
			array_push($output, $tmp);
		}
		return $output;
	}
}