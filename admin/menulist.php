<?php
include_once 'access_check.php';
require_once '../DBUtil.php';
$dbObj = new DBUtil();

if($_REQUEST['action'] == 'delete' && !empty($_REQUEST['catid'])) {
	$dbObj->deleteCategories($_REQUEST['catid']);
	header("Location: menulist.php");
	exit;
}


	$arrMenu = $dbObj->getCategories();
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/css.css" rel="stylesheet" type="text/css">
<script language="javascript" src="ajax_js.js"></script>
<script type="text/javascript">
function deleteCat(val) {
	if(confirm ("Are you sure to Delete?")) {
		window.location = 'menulist.php?catid=' + val+ '&action=delete';
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
	<form method="post"  name="form1" id="form1" onSubmit="return validate();">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="40"><span class="head_ing">&nbsp;&nbsp;<strong>&nbsp;Add Menus</strong></span></td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td align="center" valign="top"><table width="50%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                  <tr>
                    <td height="27" colspan="3" align="center" valign="middle" bgcolor="#3c7701"><strong class="white">&nbsp;List Category </strong></td>
                  </tr>
                   <tr align="center" bgcolor="#FFFFFF" >
                    <td height="30" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Category Name</strong></td>
                    <td  align="left" nowrap="nowrap" ><strong>Status</strong></td>
                    <td  align="left" nowrap="nowrap" ><strong>Action</strong></td>
                  </tr>
              		<?php foreach ($arrMenu as $menu) {
              		$status = ($menu['cat_status'] == 1) ? "Active" : "Inactive";
              		?>
                  <tr align="center" bgcolor="#FFFFFF" >
                    <td height="30" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><a href="menu.php?catid=<?php echo $menu['catid']?>"><?php echo $menu['catname']?></a></td>
                    <td colspan="-2" align="left" nowrap="nowrap" ><?php echo $status?></td>
                    <td><a href="javascript:void(0);" onClick="deleteCat('<?php echo $menu['catid']?>');"> 
                    		<img width="12" height="12" border="0" alt="Delete" src="images/b_drop.gif">
						</a>
                    </td>
                    
                  </tr>
                 <?php }?>
                  <tr align="center" bgcolor="#C28FC0" >
                    <td height="27" colspan="3" align="left" nowrap="nowrap" bgcolor="#3c7701">&nbsp;</td>
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
