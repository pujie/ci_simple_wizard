<?php
	echo 'Create Administrator Account';
	echo form_open('install/handler');
	echo form_hidden('step',$step);
	echo form_label('Admin','admin',array('class'=>'label_float_long'));
	echo form_input(array('name'=>'admin')) . '<br />';
	echo form_label('Password','password',array('class'=>'label_float_long'));
	echo form_password(array('name'=>'password1')) . '<br />';
	echo form_label('Password (Confirm)','password',array('class'=>'label_float_long'));
	echo form_password(array('name'=>'password2')) . '<br />';
	echo form_label('Email','email',array('class'=>'label_float_long'));
	echo form_input(array('name'=>'email')) . '<br />';
	echo form_submit(array('name'=>'next','value'=>'Next','class'=>'button'));
	echo form_close();