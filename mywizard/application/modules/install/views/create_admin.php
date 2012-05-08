<?php
	echo '<div class="general_form">';
	echo 'This step will create application admin ...<br />';
	echo form_open('install/handler');
	echo form_hidden('step','create_admin');
	echo form_label('Name','admin',array('class'=>'text_float_medium'));
	echo form_input('admin') . '<br />';
	echo form_label('Email','email',array('class'=>'text_float_medium'));
	echo form_input('email') . '<br />';
	echo form_label('Password','password',array('class'=>'text_float_medium'));
	echo form_password('password') . '<br />';
	echo form_label('Password Again','password_again',array('class'=>'text_float_medium'));
	echo form_password('password_again') . '<br />';

	echo form_submit('Next','next','class="button"');
	echo form_close();
	echo '</div>';