<?php
class Menu {
	function get_menus(){
		$menus = '<div class="menus">' . anchor('chapters','Chapters','class="button"') . anchor('admin/logout','Log Out','class="button"') . '</div>';
		return $menus;
	}
}