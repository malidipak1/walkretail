<?php 
include("database.inc.php");
session_start();
if(!isset($_SESSION['login']))
   {
     header('Location: index.php');
	 exit;
   }
$sql					=	mysql_query("select * from rightlink1");
$result					=	mysql_num_rows($sql);

$form_action="insert";
$button_value="INSERT";

$rightlink1_id			= "";
$rightlink1_heading		= "";
$rightlink1_details		= "";

$rightlink1_heading2		= "";
$rightlink1_details2		= "";
if(isset($_REQUEST['action']) && $_REQUEST['action']=='insert')
{
	$rightlink1_heading			=	$_REQUEST['rightlink1_heading'];
	$rightlink1_details			=	addslashes($_REQUEST['rightlink1_details']);
	
	$rightlink1_heading2			=	$_REQUEST['rightlink1_heading2'];
	$rightlink1_details2			=	addslashes($_REQUEST['rightlink1_details2']);
	
	$sql_change_admin_email 		= 	"SELECT * FROM rightlink1 WHERE rightlink1_heading ='".$rightlink1_heading."' ";
	$result_change_admin_email		=	mysql_query($sql_change_admin_email);
	$num_rows_change_admin_email	=	mysql_num_rows($result_change_admin_email);	
	
	if ($num_rows_change_admin_email > 0)
	{
		header("location: add_new_right_link1.php?message=This already exist !!");
		exit;
	}
	else
	{
		$sq3=mysql_query("INSERT INTO rightlink1 VALUES('','$rightlink1_heading','$rightlink1_details','$rightlink1_heading2','$rightlink1_details2')");
		header("location: add_new_right_link1.php?message=Added successfully.");
		exit;
	}
}
#################################      EDIT         #########################################
if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit')
{
	$form_action			=	"update";
	$button_value			=	"Update";
	$sql_edit				=	mysql_query("select * from rightlink1 where rightlink1_id='".$_REQUEST['rightlink1_id']."' ");
	$result_edit			=	mysql_num_rows($sql_edit);
	$row_edit 				=	mysql_fetch_array($sql_edit);
	$rightlink1_id			=	$row_edit['rightlink1_id'];
	$rightlink1_heading		=	$row_edit['rightlink1_heading'];
	$rightlink1_details		=	$row_edit['rightlink1_details'];
	
	$rightlink1_heading2	=	$row_edit['rightlink1_heading2'];
	$rightlink1_details2	=	$row_edit['rightlink1_details2'];
}
#################################  	END	  #########################################


#################################   UPDATE    #########################################
if(isset($_REQUEST['action']) && $_REQUEST['action']=='update')
{
	$form_action		=	"update&rightlink1_id=$image_name";
	$button_value		=	"Update";
	$sql	=	"UPDATE rightlink1 SET rightlink1_heading='".addslashes(ucfirst($_REQUEST['rightlink1_heading']))."',rightlink1_details ='".addslashes(ucfirst($_REQUEST['rightlink1_details']))."',rightlink1_details2 ='".addslashes(ucfirst($_REQUEST['rightlink1_details2']))."',rightlink1_heading2='".addslashes(ucfirst($_REQUEST['rightlink1_heading2']))."' where rightlink1_id='".$_REQUEST['rightlink1_id']."'";
	mysql_query($sql);
	$rightlink1_id 		=	$_REQUEST['rightlink1_id'];
	header("location:view_right_link1.php?message=Updated successfully");
	exit();
}

#################################  END update    #########################################
?>
<html>
<head>
<title>::: (Admin Panel) :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<?php include("common_tinymce.php");?>
</head>
<body>
<table width="100%" height="100%" align="center" cellpadding="0" cellspacing="0"  bordercolor="#5181BF" bgcolor="#ffffff">
  <tr>
    <td height="100"><?php include('head.php');?></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"  valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
                                    
                                    <td width="182" align="left" valign="top" bgcolor="#E9E9E9" class="red" style="padding:0px; margin:0px;"><?php include('left_mnu.php');?></td>
                                    <td width="100%" align="left" valign="top" bgcolor="" class="red"><table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0"  bordercolor="#000000">
                                      <tr>
                                        <td class="head_ing">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td class="head_ing">Manage Right Area</td>
                                      </tr>
                                      <tr>
                                       <td align="center" valign="top" class="red" ><?php if(isset($_REQUEST['message'])){?>
                                                  <?php echo $_REQUEST['message'];?>
                                                  <?php }?></td>
                                      </tr>
                                      <tr>
                                        <td height="254" bordercolor="#FFFFFF"  valign="top"><table width="100%" border="0" cellspacing="4" cellpadding="0">
                                              <tr>
                                                <td align="center" valign="middle">
	<form name="form1" method="POST" ACTION="add_new_right_link1.php?action=<?php echo $form_action; ?>" ><table width="41%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" >
                                                    <tr align="center" >
                                                      <td colspan="2" align="left" class="white" bgcolor="#3270B4">Add Right Link</td>
                                                    </tr>
                                                    <tr>
                                                      <td width="41%" height="25%" align="left" valign="top" bgcolor="#FFFFFF" class="admin-txt"> Heading&nbsp;:</td>
                                                      <td width="59%" align="left" bgcolor="#FFFFFF" class="admin-txt"><input name="rightlink1_heading" type="text" id="rightlink1_heading" value="<?php echo $rightlink1_heading;?>" /><input name="rightlink1_id" id="rightlink1_id" type="hidden" value="<?php echo $rightlink1_id;?>" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td width="41%" height="25%" align="left" valign="top" bgcolor="#FFFFFF" class="admin-txt"> Details&nbsp;:</td>
                                                      <td width="59%" align="left" bgcolor="#FFFFFF" class="admin-txt"><textarea name="rightlink1_details" cols="140" rows="25" id="rightlink1_details" ><?php echo $rightlink1_details;?></textarea></td>
                                                    </tr>
                                                    <tr>
                                                      <td width="41%" height="25%" align="left" valign="top" bgcolor="#FFFFFF" class="admin-txt"> Second Heading :</td>
                                                      <td width="59%" align="left" bgcolor="#FFFFFF" class="admin-txt"><input name="rightlink1_heading2" type="text" id="rightlink1_heading2" value="<?php echo $rightlink1_heading2;?>" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td width="41%" height="25%" align="left" valign="top" bgcolor="#FFFFFF" class="admin-txt">Second Details:</td>
                                                      <td width="59%" align="left" bgcolor="#FFFFFF" class="admin-txt"><textarea name="rightlink1_details2" cols="140" rows="25" id="rightlink1_details2"><?php echo $rightlink1_details2;?></textarea></td>
                                                    </tr>
                                                    <tr>
                                                      <td colspan="2" align="center"bgcolor="#3270B4" class="admin-txt">&nbsp;
                                                      <input type="submit" name="Submit" value="<?php echo $button_value;?>" /></td>
                                                    </tr>
                                                </table></form></td>
                                              </tr>
                                          </table></td>
                                      </tr>
                                    </table></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"  valign="top" height="20"><?php include("footer.inc.php"); ?></td>
  </tr>
</table>
</body>
</html>
<script language="javascript">
/*function check()
{
   	var doc=document.form1;
	var email=doc.new1.value;
	if(doc.current.value=="")
	{
		alert("Please enter current email id.");
		doc.current.focus();
		return false;
	}
	else if(doc.new1.value=="")
	{
		alert("Please enter new email id.");
		doc.new1.focus();
		return false;
	}
	else if(email.indexOf('@')==-1)
	{
	alert('Invalid email id, check(@ or .\'s)');
	doc.new1.focus();	
	return false;
	}
	else if(email.indexOf('.')==-1)
	{
	alert('Invalid email id, check(@ or .\'s)');
	doc.new1.focus();	
	return false;
	}
	else if(doc.conform.value=="")
	{
		alert("Please enter confirm email id .");
		doc.conform.focus();
		return false;
	}
	else if(doc.conform.value!=doc.new1.value)
	{
		alert("New email id and confirm email id does not match.");
		var len=doc.conform.value.length;
		doc.conform.select(0,len-1);		
		doc.conform.focus();
		return false;
	}else{
	return true;
	}
	
	
}
*/

</script>