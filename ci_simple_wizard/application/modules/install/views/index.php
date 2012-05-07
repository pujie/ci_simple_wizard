<?php
	echo form_open('install/handler');
	echo $step;
	echo form_hidden('step',$step);
	echo form_label('Warning these steps will <strong>erase</strong> your existing tables !',array('class'=>'warning')) . '<br />';
	echo form_submit(array('name'=>'next','value'=>'Next','class'=>'button'));
	echo form_close();