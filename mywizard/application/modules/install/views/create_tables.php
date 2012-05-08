<?php
	echo '<div class="general_form">';
	echo 'This step will create database tables ...<br />';
	echo form_open('install/handler');
	echo form_hidden('step','create_tables');
	echo form_submit('Next','next','class="button"');
	echo form_close();
	echo '</div>';