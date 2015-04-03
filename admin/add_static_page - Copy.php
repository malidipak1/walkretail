<?php
ob_start(); 
//error_reporting(~E_ALL);
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
$button_value		=	"INSERT";
$form_action		=	"insert";
if(isset($_REQUEST['action']) && $_REQUEST['action']=='insert')
{
	$parentid=$_REQUEST['categ'];
	$page_title=$_REQUEST['page_title'];
	$specification=$_REQUEST['specification'];
	$case_study=$_REQUEST['case_study'];
	$sql      =  mysql_query("select * from static_page where page_category_id='$parentid'");
	$result   =  mysql_num_rows($sql);
if($result==0)
{
	//echo "INSERT INTO static_page VALUES('','".ucfirst(addslashes($page_title))."','$parentid','".ucfirst(addslashes($specification))."','".$_SERVER['REMOTE_ADDR']."','".ucfirst(addslashes($case_study))."')";exit;
	$sq3=mysql_query("INSERT INTO static_page VALUES('','".ucfirst(addslashes($page_title))."','$parentid','".ucfirst(addslashes($specification))."','".$_SERVER['REMOTE_ADDR']."','".ucfirst(addslashes($case_study))."')");
	header('location:add_static_page.php?message=Page added sucessfully');
	exit();
		//echo "INSERT INTO static_page VALUES('','".ucfirst(stripslashes($page_title))."','$parentid','".ucfirst(stripslashes($specification))."')";exit;
}
else
{
	header('location:add_static_page.php?message=Page already exist');
	exit();
	
}
	
}
#################################      EDIT         #########################################
if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit')
{
$form_action		=	"update";
$button_value		=	"Update";

$sql				=	mysql_query("select * from static_page  where page_id='".$_REQUEST['page_id']
						."' ");

$result				=	mysql_num_rows($sql);
$row 				=	mysql_fetch_array($sql);

$page_title 		=	$row['page_title'];
$page_category_id	=	$row['page_category_id'];

$page_detail		=	$row['page_description'];
$case_study			=	$row['case_study'];
$page_id			= 	$_REQUEST['page_id'];
}
#################################  	END	  #########################################


#################################   UPDATE    #########################################
// when admin clicks on UPDATE this area of php code will execute 
if(isset($_REQUEST['action']) && $_REQUEST['action']=='update')
{
$form_action	=	"update";
$button_value	=	"Update";

$page_category_id		=	$_REQUEST['page_category_id'];

//$page_name		=	str_replace (" ", "",$page_title);

$sql	=	mysql_query("UPDATE static_page SET page_title='".addslashes($_REQUEST['page_title'])."',page_category_id='$page_category_id',page_description='".addslashes($_REQUEST['specification'])."',ip_address='".$_SERVER['REMOTE_ADDR']."',case_study='".addslashes($_REQUEST['case_study'])."' WHERE page_id='".$_REQUEST['page_id']."' ");
header("location:view_static_page.php?message=Page updated sucessfully");
}
#################################  END update    #########################################

?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<?php include("common_tinymce.php");?>
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
<table width="100%" height="100%" align="center" cellpadding="0" cellspacing="0"  bordercolor="#5181BF">
  <tr>
    <td height="41"><?php include('head.php');?></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"  valign="top" ><table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>                                
                                    <td width="17" align="left" valign="top" bgcolor="#b5f971" class="red" style="padding:0px; margin:0px;"><?php include('left_mnu.php');?></td>
                                    
          <td width="1392" align="center" valign="top" bgcolor="" class="red">
                  <form method="post"  name="form1" id="form1" ACTION="add_static_page.php?action=<?php echo $form_action; ?>" onSubmit="return validate()">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
              <td height="40"><span class="head_ing">&nbsp;&nbsp;<strong>&nbsp;Add Static Pages</strong></span></td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td align="center" valign="top"><table width="50%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                  <tr>
                    <td height="27" colspan="2" bgcolor="#3270B4"><strong class="white">&nbsp;Add Category </strong></td>
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
                    <td width="64%" colspan="-2" align="left" nowrap="nowrap"><?php if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit'){ echo "<b>".$_REQUEST['path']."</br>"; }else { ?><select id="<?php echo 'cat'.$i;?>" name="<?php echo 'cat'.$i;?>" onChange="chk_str(this.value,1);">
                        <option value="">--Select Category--</option>
     <?php 
     while($row =mysql_fetch_array($sql))
                    {?>
                        <option value="<?php echo $row['catid'];?>"> <?php echo ucfirst($row['catname']);?></option>
                        <?php } ?>
                      </select>
                        <input name="categ" type="hidden" id="categ" /><?php } ?></td>
                  </tr>
                <?php if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit'){}else { ?>  
                  <tr align="center" bgcolor="#FFFFFF" >
                    <td height="25" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Sub Category : </strong></td>
                    <td height="30" colspan="-2" align="left" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF" ><div id="subcate" style="vertical-align:middle">
                        <div id="txtHint1" class="red">Select categories to get its sub categories <br>
                        </div>
                    </div></td>
                  </tr>
                                  <?php }} ?>
                      <tr align="center" bgcolor="#FFFFFF" >
                                    <td height="30" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Page Title :</strong></td>
                                    <td colspan="-2" align="left" nowrap="nowrap" ><label for="page_title"></label>
                        <input name="page_title" type="text" id="page_title" value="<?php echo $page_title; ?>" size="70" maxlength="67"> <input type="hidden" name="page_id" value="<?php echo $page_id; ?>" ><input type="hidden" name="page_category_id" value="<?php echo $page_category_id; ?>" ></td>
                      </tr> 
                      <tr align="center" bgcolor="#FFFFFF" >
                    <td height="30" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong><?php if ($flag==1){echo $lbl="Enter Sub Category";}else { echo $lbl="Enter Category";}?></strong></td>
                    <td colspan="-2" align="left" nowrap="nowrap" >&nbsp;</td>
                  </tr>
                    <tr align="center" bgcolor="#FFFFFF" >
                    <td height="30" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong><?php if ($flag==1){echo $lbl="Case study";}else { echo $lbl="Case study";}?></strong></td>
                    <td colspan="-2" align="left" nowrap="nowrap" >
                    <textarea name="case_study" id="case_study" cols="140" rows="25" ><?php echo $case_study;?></textarea></td>
                  </tr>
                     <!-- <tr align="center" bgcolor="#FFFFFF" >
                        <td height="30" align="center" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF">Sidebar :</td>
                        <td height="30" align="left" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF"><input type="radio" name="chk_sidebar" id="radio" value="yes" <?php // if($sidebar=='yes') { echo "checked"; } ?>>                          
                        Yes 
                        <input type="radio" name="chk_sidebar" id="radio2" value="no" <?php // if($sidebar=='no') { echo "checked"; } ?>> 
                        No</td>
                      </tr>-->
                      <tr align="center" bgcolor="#FFFFFF" >
                    <td height="30" colspan="2" align="center" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF"><em>
                        <input name="submit" type="submit"  value="<?php echo $button_value;?>" />
                        &nbsp;
                        <INPUT name="button" TYPE="button" onClick="window.location='add_static_page.php'" value="Reset">
                    </em></td>
                    </tr>
                  <tr align="center" bgcolor="#C28FC0" >
                    <td height="27" colspan="2" align="left" nowrap="nowrap" bgcolor="#3270B4">&nbsp;</td>
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
<script language="JavaScript" type="text/JavaScript">
function set_page_limit(records){
document.search_product.action="<?php echo $file_name?>?action=search_product&per_page="+records;
document.search_product.submit();
}
</script>

</body>
</html>
