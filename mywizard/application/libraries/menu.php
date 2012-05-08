<?php
class Menu{
var $obj;
	public $outputmenu = '';
	function __construct(){
		$this->obj = & get_instance();
		$this->obj->load->helper('url');
		$this->obj->load->library('lib_table_manager');
	}
	function create_menu($param){
		$menu = '<table>';
		$menu .= '<tbody>';
		$menu .= '<tr>';
		foreach($param as $prm){
			$menu .= $prm;
		}
		$menu .= '</tr>';
		$menu .= '</tbody>';
		$menu .= '</table>';
		$this->outputmenu=$menu;
	}
	function show_menu(){
		return $this->outputmenu;
	}
	function links($list){
		$this->obj->lib_table_manager->create_table($list);
	}
}
class MenuHeader{
	function header($menu_name,$param){
		$menu = '<td class="menuheader">' . $menu_name;
		$menu .= '<ul class="menudetail">';
		foreach($param as $prm){
			$menu .= '<li>' . $prm . '</li>';
		}
		$menu .= '</ul>';
		$menu .= '</td>';
		return $menu;
	}
}