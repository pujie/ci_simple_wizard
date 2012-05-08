<?php
/*
 * accept array of label - input
 * 
 * 
 * 
 * 
 * 
 * 28 sept 2011
 * */
class Padi_forms{
	var $obj;
	var $input_array=array();
	function __construct(){
		$this->obj = & get_instance();
		$this->input_array=array(
			array(form_label('Person name','person_name'),form_input('person_name')),
			array(form_label('Person Address','person_address'),form_input('person_address')));
	}
	public function inputs($id,$title){
		echo '<div id=' . $id . '>';
		echo '<p class=divtitle>' . $title . '</p>';
		foreach($this->input_array as $input_component){
			foreach ($input_component as $component){
				echo $component ;
			}
			echo '<br>';
		}
		echo '</div>';
	}
}