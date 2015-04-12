<?php
include_once 'lib/config.php';
if(!empty($_REQUEST['fileName'])) {
	header("Content-type: application/octet-stream");
	header("Content-Disposition:attachment;filename=" . $_REQUEST['fileName']);
	$fileName = UPLOAD_DOCS_DIR . $_REQUEST['fileName'];
	readfile($fileName);
	exit;
}
?>