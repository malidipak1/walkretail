<?php
include_once 'access_check.php';
require_once '../DBUtil.php';
$dbObj = new DBUtil();

if($_REQUEST['action'] == 'delete') {
	$dbObj->deleteMenu($_REQUEST['catid']);
	header("Location: menulist.php");
}

if(!empty($_POST) && !empty($_POST['catname'])) {
	$dbObj->addMenu($_POST['catname'], $_POST['parent_id'],$_POST['status'], $_POST['catid']);
}

if(!empty($_REQUEST['catid'])) {
	$arrParam = array('catid' => $_REQUEST['catid']);
	$arrMenu = $dbObj->getMenu($arrParam);
	$arrMenu = $arrMenu[0];
}

require_once '../Util.php';
$arrCat = Util::getParentCategoryList();

?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/css.css" rel="stylesheet" type="text/css">
<script language="javascript" src="ajax_js.js"></script>
<script language="javascript" type="text/javascript">
function validate()
{
	var doc=document.form1;
	if(doc.catname.value=="")
	{
		alert("Please enter category name.");
		doc.catname.focus();
		return false;
	}
	return true;
}

function deleteCat() {
	var catid = document.form1.catid.value;
	if(confirm ("Are you sure to Delete?")) {
		window.location = "menu.php?action=delete&catid=" + catid;
	}
}
</script>
</head>
<body >
<table width="100%" height="100%" align="center" cellpadding="0" cellspacing="0"  bordercolor="#4c9309">
  <tr>
    <td height="41"><?php include('head.php');?></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"  valign="top" ><table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>                                
	 <td width="17" align="left" valign="top" bgcolor="#b5f971" class="red" style="padding:0px; margin:0px;"><?php include('left_mnu.php');?></td>
                                    
          <td width="1392" align="center" valign="top" bgcolor="" class="red">
	<form method="post"  name="form1" id="form1" onsubmit="return validate();">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="40"><span class="head_ing">&nbsp;&nbsp;<strong>&nbsp;Add Menus</strong></span></td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td align="center" valign="top"><table width="50%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                  <tr>
                    <td height="27" colspan="2" bgcolor="#3c7701"><strong class="white">&nbsp;Add Category </strong></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td height="40" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Parent Category</strong><strong> :</strong>
                        <?php $i=1; ?></td>
                    <td width="64%" colspan="-2" align="left" nowrap="nowrap">
                    	<select name="parent_id">
                    		<option value="0">-SELECT-</option>
                    		<?php foreach ($arrCat as $cat) {
                    			$selected = "";
                    			if($cat['catid'] == $arrMenu['parent_id']) {$selected = "selected='selected'";}
                    		?>
                    		<option <?php echo $selected?> value="<?php echo $cat['catid']?>"><?php echo $cat['catname']?></option>
                    		<?php }?>
                    	</select>
					</td>
                  </tr>
                  <tr align="center" bgcolor="#FFFFFF" >
                    <td height="30" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Enter Category Name</strong></td>
                    <td colspan="-2" align="left" nowrap="nowrap" ><input name="catname" type="text" size="22" value="<?php echo $arrMenu['catname']?>" />
                    	<input type="hidden" name="catid" value="<?php echo $arrMenu['catid']?>" />
                    </td>
                  </tr>
                  
                  <tr align="center" bgcolor="#FFFFFF" >
                    <td height="30" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Status</strong></td>
                    <td colspan="-2" align="left" nowrap="nowrap" >
                    	<select name="status">
                    		<?php 
                    		$select1 = ""; $select2 = "";
                     		if ( $arrMenu['status'] == '1') { 
                    				$select1 = "selected = 'selected'"; 
                    			} else {
                    				$select2 = "selected = 'selected'";
                    			}?>		
                    		<option <?php echo $select1?> value="1">Active</option>
                    		<option <?php echo $select2?> value="0">Inactive</option>
                    	</select>
                    </td>
                  </tr>
                  <tr align="center" bgcolor="#FFFFFF" >
                    <td height="30" colspan="2" align="center" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF"><em>
                        <input name="submit" type="submit" value="Save" />
                        &nbsp;
                        <INPUT name="reset" TYPE="reset" value="Reset">
                        &nbsp;
                        <INPUT name="delete" TYPE="button" value="Delete" onclick="deleteCat();">
                    </em></td>
                    </tr>
                  <tr align="center" bgcolor="#C28FC0" >
                    <td height="27" colspan="2" align="left" nowrap="nowrap" bgcolor="#3c7701">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table>
                  </form>
                  </td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"  valign="top" height="20">
      <?php include("footer.inc.php"); ?>
    </td>
  </tr>
</table>
</body>
</html>
