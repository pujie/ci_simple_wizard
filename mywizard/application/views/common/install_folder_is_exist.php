<?php
	echo '<div class="common_paragraph">';
	echo 'The "<strong>Install</strong>" Folder is exist <br />';
	echo 'If You had install this application before, please ensure you remove the "<strong>Install</strong>" folder <br />';
	echo 'If You want to create a new Installation, please follow the wizard by click the "<strong>Next</strong>" button below <p />';
	echo '<strong>CAUTION</strong>, this step will delete your existing settings and installation data <br />';
	echo anchor('install/index/database_setting','Install',array('class'=>'button'));
	echo '</div>';