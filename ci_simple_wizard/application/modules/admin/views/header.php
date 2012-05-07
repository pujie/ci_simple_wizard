<link rel='stylesheet' href='<?php echo base_url();?>css/smoothness/jquery-ui-1.8.14.custom.css' />
<link rel='stylesheet' href='<?php echo base_url();?>css/custom.css' />
<script type='text/javascript' src='<?php echo base_url();?>js/jquery-1.7.1.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>js/jquery-ui-1.8.14.custom.min.js'></script>
<script type='text/javascript'>
$(document).ready(function(){
	$('.button').button();
});
</script>
<?php 
	echo '<div id="header">';
	$page_title=(isset($title))?$title:'';
	$header_text = (isset($head_text))?$head_text:'';
	echo '<title>' . $page_title . '</title>';
	echo '<h1>' . $header_text . '</h1>';
	$page_info = (isset($custom_text))?$custom_text:'';
	echo '<div class="page_info">' . $page_info . '</div>';
	echo '</div>';
?>
