<?php
	echo form_open('admin/login_handler');
	echo form_label('Name','name','class="label_float_long"');
	echo form_input('name') . '<br />';
	echo form_label('Password','password','class="label_float_long"');
	echo form_password('password') . '<br />';
	echo form_submit(array('name'=>'login','value'=>'Login','class'=>'button'));
	echo form_submit(array('name'=>'close','value'=>'Close','class'=>'button'));
	echo form_close();