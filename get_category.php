<?php
	include_once 'DBUtil.php';
	$strResp = "";
	$dbObj = new DBUtil();
	$arrParam = array('parent_id' => $_REQUEST['catid']);
	$arrCat = $dbObj->getCategories($arrParam);
// 	/print_r($arrCat);
	foreach ($arrCat as $cat) {
		$strResp .=  $cat['catid'] . ":" . $cat['catname'] . ",";
	}
	echo $strResp = substr($strResp, 0, -1);
?>