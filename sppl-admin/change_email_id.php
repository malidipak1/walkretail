<?php 
include("database.inc.php");
session_start();
if(!isset($_SESSION['login']))
   {
     header('Location: index.php');
	 exit;
   }
if(isset($_REQUEST['action']) && $_REQUEST['action']=='change_admin_email'){

$current			=	$_REQUEST['current'];
$new				=	$_REQUEST['new1'];
$conform			=	$_REQUEST['conform'];

$sql_change_admin_email 		= 	"SELECT * FROM admin WHERE email ='".$current."' ";
$result_change_admin_email		=	mysql_query($sql_change_admin_email);
$num_rows_change_admin_email	=	mysql_num_rows($result_change_admin_email);	

if ($num_rows_change_admin_email > 0)
{
	$sql_update_admin_email		=	"UPDATE admin SET email ='".$new."' WHERE uname ='".$_SESSION['login']."'";
	mysql_query($sql_update_admin_email);
	header("location: change_email_id.php?message=Email Id changed successfully.");
	exit;
}else
	{
		header("location: change_email_id.php?message=Invalid email id !");
		exit;
	}
}
?>

<html>
<head>
<title>::: (Admin Panel) :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
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
                                        <td class="head_ing">Change Email Id </td>
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
	<form name="form1" method="POST" ACTION="change_email_id.php?action=change_admin_email" onSubmit="javascript:return check();"><table width="41%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" >
                                                    <tr align="center" >
                                                      <td colspan="2" align="left" class="white" bgcolor="#3c7701"><strong>Change 
                                                      Your Email Id </strong></td>
                                                    </tr>
                                                    <tr>
                                                      <td width="41%" height="25%" align="left" valign="top" bgcolor="#FFFFFF" class="admin-txt"> Current email id &nbsp;:</td>
                                                      <td width="59%" align="left" bgcolor="#FFFFFF" class="admin-txt"><input type="text" name="current" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td width="41%" height="25%" align="left" valign="top" bgcolor="#FFFFFF" class="admin-txt"> New email id&nbsp;:</td>
                                                      <td width="59%" align="left" bgcolor="#FFFFFF" class="admin-txt"><input type="text" name="new1"></td>
                                                    </tr>
                                                    <tr>
                                                      <td width="41%" height="25%" align="left" valign="top" bgcolor="#FFFFFF" class="admin-txt"> Confirm email id&nbsp;:</td>
                                                      <td width="59%" align="left" bgcolor="#FFFFFF" class="admin-txt"><input type="text" name="conform" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td colspan="2" align="center"bgcolor="#3c7701" class="admin-txt">&nbsp;
                                                      <input type="submit" name="Submit" value="Submit" /></td>
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
function check()
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


</script>