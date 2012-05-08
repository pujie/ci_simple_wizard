<?php
	echo form_open('back_office/login_handler');
	echo form_label('Name','name',array('class'=>'text_float_medium'));
	echo form_input('name') . '<br />';
	echo form_label('Password','password',array('class'=>'text_float_medium'));
	echo form_password('password') . '<br />';
	echo form_submit('Login','login','class="button"');
	echo form_close();