<?php
session_start();
if(!isset($_SESSION['login']))
{
	header('Location: index.php');
	exit;
}

if(!empty($_POST)) {
	
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
<script language="javascript">
function validate()
{
	var doc=document.form1;
	if(doc.txtcat.value=="")
	{
			alert("Please enter Sub category name.");
			doc.txtcat.focus();
			return false;
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
	<form method="post"  name="form1" id="form1" onSubmit="return validate()">
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
                    		<?php foreach ($arrCat as $cat) {?>
                    		<option value="<?php echo $cat['catid']?>"><?php echo $cat['catname']?></option>
                    		<?php }?>
                    	</select>
					</td>
                  </tr>
                  <tr align="center" bgcolor="#FFFFFF" >
                    <td height="30" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Enter Category Name</strong></td>
                    <td colspan="-2" align="left" nowrap="nowrap" ><input name="txtcat" type="text" size="22" /></td>
                  </tr>
                  <tr align="center" bgcolor="#FFFFFF" >
                    <td height="30" colspan="2" align="center" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF"><em>
                        <input name="submit" type="submit" value="Save" />
                        &nbsp;
                        <INPUT name="submit" TYPE="submit" value="Reset">
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
