<link rel='stylesheet' href='<?php echo base_url();?>css/smoothness/jquery-ui-1.8.14.custom.css' />
<link rel='stylesheet' href='<?php echo base_url();?>css/custom.css' />
<script type='text/javascript' src='<?php echo base_url();?>js/jquery-1.5.1.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>js/jquery-ui-1.8.14.custom.min.js'></script>
<script type='text/javascript'>
$(document).ready(function(){
	$('.button').button();
}
);
</script>
<?php 
	$title=(isset($param_title))?$param_title:'';
	echo '<title>' . $title . '</title>';
	$header=(isset($param_header))?$param_header:'';
	echo '<h1>' . $header . '</h1>';
	?>