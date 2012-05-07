<?php
	echo 'WARNING !!!This step will erases your existing tables !<br />';
	echo 'Make sure you had backed up your data before commit Next Button below';
	echo form_open('install/handler');
	echo form_hidden('step',$step);
	echo form_submit(array('name'=>'next','value'=>'Next','class'=>'button'));
	echo form_close();