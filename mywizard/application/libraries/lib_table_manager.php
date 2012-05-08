<?php
class Lib_table_manager{
public $obj;
	 function __construct(){
		$this->obj = & get_instance();
		$this->obj->load->library('table');
	 }
	function set_heading($heading){
		$this->obj->table->set_heading($heading);
	}
	function create_table($rows){
		if(empty($rows)){
			echo 'There is no data to show';
		}	
		else{
			foreach($rows as $value){
				$this->obj->table->add_row($value);
			}
			echo $this->obj->table->generate();
		}
	}
	function create_table_template($tbl_id){
		$tmpl = array (
			'table_open'          => '<table border="0" cellpadding="4" cellspacing="0" id="' . $tbl_id . '">',

			'heading_row_start'   => '<tr>',
			'heading_row_end'     => '</tr>',
			'heading_cell_start'  => '<th>',
			'heading_cell_end'    => '</th>',

			'row_start'           => '<tr>',
			'row_end'             => '</tr>',
			'cell_start'          => '<td>',
			'cell_end'            => '</td>',

			'row_alt_start'       => '<tr>',
			'row_alt_end'         => '</tr>',
			'cell_alt_start'      => '<td>',
			'cell_alt_end'        => '</td>',

			'table_close'         => '</table>'
		);
		return $tmpl;

	}

}