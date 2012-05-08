<?php
class Lib_table{
var $header;
var $head;
	var $column_alignment;
	var $column_width;
	function set_head($heads){
		$list='';
		foreach($heads as $head){
			$list.='<th>' . $head . '</th>';
		}
		$this->head=$list;
	}
	function set_head2($heads){
	$list='';
		foreach($heads as $head){
			$list.='<th colspan=' . $head['colspan'] . '>' . $head['val'] . '</th>';
		}
		$this->head=$list;
	}
	function set_body($bodies){
		$tr_array='';
		$k=0;
			foreach($bodies as $tr){
				$td_array='';
				$c=0;
				foreach($tr as $td){
					//8okt2011
//					if (!empty($this->column_width[$c])){
//					$td_array.='<td width=' . $this->column_width[$c] . '>' . $td . '</td>';
					$wdt=(empty($this->column_width[$c])) ?'':'width=' . $this->column_width[$c];
//					}
					
					if (!empty($this->column_alignment[$c])){
					$td_array.='<td align=' . $this->column_alignment[$c] . $wdt . '>' . $td . '</td>';
					}
					else{
					$td_array.='<td>' . $td . '</td>';
					}
					$c++;
				}
				if ($k%2==0)
				{
					$tr_array.='<tr class="lib_table_body_even">' . $td_array . '</tr>';
				}else{
					$tr_array.='<tr class="lib_table_body_odd">' . $td_array . '</tr>';
				}
				$k++;
			}
		return '<tbody class="lib_table_tbody">' . $tr_array . '</tbody>';
	}
	function set_head_object($head){
		$this->header=$head;
	}
	function extract_object($object,$header){
		$body=array();
		foreach($object as $obj){
		$row=array();
			foreach($header as $hdr){
				array_push($row,$obj->$hdr);
			}
			array_push($body,$row);
		}
		if ($this->header<>null){
			$header=$this->header;
		}
		return $this->set_table('x',$header,$body);
	}
	function set_alignment($col,$alignment){
		$this->column_alignment[$col]=$alignment;
	}
	function set_multi_alignment($array_of_attributes){
		foreach($array_of_attributes as $key=>$value){
			$this->column_alignment[$key]=$value;
		}
	}

	function set_width($col,$width){
		$this->column_width[$col]=$width;
	}
	function set_multi_width($array_of_attributes){
		foreach($array_of_attributes as $key=>$value){
			$this->column_width[$key]=$value;
		}
	}
	
	
	function set_table($table_id,$head,$body){
		$this->set_head($head);
		return 	'<table id=' . $table_id . ' class="table-display">' . 
				'<thead class="thead-display"><tr>' . $this->head . $this->set_body($body) . '</table>';
	}
	function set_table2($table_id,$head,$body){
		$this->set_head2($head);
		return 	'<table id=' . $table_id . ' class="table-display">' . 
				'<thead class="thead-display"><tr>' . $this->head . $this->set_body($body) . '</table>';
	}
}