<?php
if(!ini_get('post_max_size'))
	ini_set('post_max_size', '100M');
if(!ini_get('upload_max_filesize'))
	ini_set('upload_max_filesize', '100M');
if(!ini_get('display_errors'))
	ini_set('display_errors', '1');

error_reporting(0); //turn off error reporting
error_reporting(E_ALL ^ E_NOTICE);

?>