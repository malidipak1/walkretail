<?php
ob_start(); 
error_reporting(~E_ALL);
include("database.inc.php");
session_start();
//echo $_SESSION['uid'];
if(!isset($_SESSION['login']))
{
	header('Location: index.php');
	exit;
}
$sql      =  mysql_query("select * from categories where parent_id='0'");
$result   =  mysql_num_rows($sql);

if(isset($_REQUEST['action']) && $_REQUEST['action']=='insert')
{
	$parentid=$_REQUEST['categ'];
	$catname=addslashes($_REQUEST['txtcat']);
	$catlink=$_REQUEST['catlink'];
	$disp=$_REQUEST['disp'];
	/*if($result==7 && $parentid=="")
	{
		header('location:add_category.php?message=Cannot insert Top main menu more than 7');
		exit();
	}
	else
	{*/
		$sq3=mysql_query("INSERT INTO categories VALUES('','$parentid','$catname','$catlink','$disp')");
		header('location:add_category.php?message=Category added sucessfully');
		exit();
	/*}*/
	
}

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
                  <form method="post"  name="form1" id="form1" ACTION="add_menu.php?action=insert" onSubmit="return validate()">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="40"><span class="head_ing">&nbsp;&nbsp;<strong>&nbsp;Add Menus</strong></span></td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td align="center" valign="top"><table width="50%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                  <tr>
                    <td height="27" colspan="2" bgcolor="#3c7701"><strong class="white">&nbsp;Add Category </strong></td>
                  </tr>
                  <?php if(isset($_REQUEST['message']) && $_REQUEST['message']!=''){?>
                  <tr>
                    <td height="18" colspan="3" align="center" bgcolor="#FFFFFF" class="red"><?php echo $_REQUEST['message'];?></td>
                  </tr>
                  <?php }?><?php if($result>0)
{
$flag=1;
?>
                  <tr bgcolor="#FFFFFF">
                    <td height="40" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Category</strong><strong> :</strong>
                        <?php $i=1; ?></td>
                    <td width="64%" colspan="-2" align="left" nowrap="nowrap"><select id="<?php echo 'cat'.$i;?>" name="<?php echo 'cat'.$i;?>" onChange="chk_str(this.value,1);">
                        <option value="">--Select Category--</option>
                        <?php
          
     while($row =mysql_fetch_array($sql))
                    {?>
                        <option value="<?php echo $row['catid'];?>"> <?php echo ucfirst($row['catname']);?></option>
                        <?php }?>
                      </select>
                        <input name="categ" type="hidden" id="categ" /></td>
                  </tr>
                  
                  <tr align="center" bgcolor="#FFFFFF" >
                    <td height="25" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Sub Menu : </strong></td>
                    <td height="30" colspan="-2" align="left" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF" ><div id="subcate" style="vertical-align:middle">
                        <div id="txtHint1" class="red">Select categories to get its sub categories <br>
                        </div>
                    </div></td>
                  </tr>
                                  <?php } ?>
                  <tr align="center" bgcolor="#FFFFFF" >
                    <td height="30" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong><?php if ($flag==1){echo $lbl="Enter Menu";}else { echo $lbl="Enter Menu";}?></strong></td>
                    <td colspan="-2" align="left" nowrap="nowrap" ><input name="txtcat" type="text" size="22" /></td>
                  </tr>
                  
                  <tr align="center" >
                    <td height="27" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Menu Link (if any)</strong></td>
                    <td height="27" align="left" nowrap="nowrap" bgcolor="#FFFFFF">
                      <input type="text" name="catlink" id="catlink"></td>
                    </tr>
                    <tr align="center" bgcolor="#FFFFFF">
                    <td height="27" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Where to display</strong></td>
                    <td height="27" align="left" nowrap="nowrap" bgcolor="#FFFFFF">
                      <input type="radio" name="disp"  value="top" id="disp1">
                     Top 
                        <input type="radio" name="disp"  value="top_middle" id="disp2">
                      Top and Middle both
                      <input type="radio" name="disp"  value="right" id="disp3">
                      Bottom</td>
                  </tr>
                  <tr align="center" bgcolor="#FFFFFF" >
                    <td height="30" colspan="2" align="center" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF"><em>
                        <input name="submit" type="submit" value="Save" />
                        &nbsp;
                        <INPUT name="button" TYPE="button" onClick="window.location='add_category.php'" value="Reset">
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
