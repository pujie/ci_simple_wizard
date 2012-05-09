<?php
	echo '<div class="general_form">';
	echo form_open('install/handler');
	echo form_hidden('step','database_setting');
	
	echo form_label('Server name','server',array('class'=>'text_float_medium'));
	echo form_input('server') . '<br />';
	echo form_label('Database name','database',array('class'=>'text_float_medium'));
	echo form_input('database') . '<br />';
	echo form_label('User Name','username',array('class'=>'text_float_medium'));
	echo form_input('username') . '<br />';
	echo form_label('Password','password',array('class'=>'text_float_medium'));
	echo form_input('password') . '<br />';
	echo form_submit(array('name'=>'next','value'=>'Next','class'=>'button'));
	echo '</div>';