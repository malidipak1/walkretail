<?php 
include_once 'access_check.php';
include("database.inc.php");

if(isset($_REQUEST['action']) && $_REQUEST['action']=='change_password' ) {
$current_password		=	$_REQUEST['current_password'];
$new_password			=	$_POST['new_password'];

$sql_check_password 	= 	"SELECT * FROM admin WHERE uname ='admin' AND password ='".addslashes($current_password)."' ";

$result_check_password	=	mysql_query($sql_check_password);

if (mysql_num_rows($result_check_password) < 1)
{
		header("location: change_password.php?message=Your Current Password did not match the password in our records. Please try 
		again.");
		exit();
}else{
	$sql_update_password	=	"UPDATE admin SET password ='$new_password' WHERE uname='".$_SESSION['login']."' ";
	mysql_query($sql_update_password);
	header("location: change_password.php?message=Your password is changed successfully");
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
<body  onLoad="set_focus();">
<table width="100%" height="100%" align="center" cellpadding="0" cellspacing="0"  bordercolor="#5181BF">
  <tr>
    <td height="100"><?php include('head.php');?></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"  valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
                                    
                                    <td width="182" align="left" valign="top" bgcolor="#E9E9E9" class="red" style="padding:0px; margin:0px;"><?php include('left_mnu.php');?></td>
                                    <td width="100%" align="left" valign="top" bgcolor="" class="red"><table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0"  bordercolor="#000000">
                                      <tr>
                                        <td height="57" class="head_ing">Change Password </td>
                                      </tr>
                                      
									  <?php if(isset($_REQUEST['message']) && $_REQUEST['message']!='' )?>
									  <tr>
                                        <td  align="center" class="red"><?php echo $_REQUEST['message'];?>
                                        </td>
                                      </tr

  >
                                      <tr>
                                        <td height="254" bordercolor="#FFFFFF"  valign="top"><table width="100%" border="0" cellspacing="4" cellpadding="0">
                                              <tr>
                                                <td align="center" valign="middle">
												<form name="form1" method="POST" ACTION="change_password.php?action=change_password" onSubmit="javascript:return check_form();">
												<table width="41%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" >
                                                    <tr align="center" >
                                                      <td colspan="2" align="center" bgcolor="#3c7701"><div class="white">Change 
                                                      Your Password</div></td>
                                                    </tr>
                                                    <tr>
                                                      <td width="41%" height="25%" align="left" valign="top" bgcolor="#FFFFFF"> Current Password&nbsp;:</td>
                                                      <td width="59%" align="left" bgcolor="#FFFFFF"><input type="password" name="current_password" onFocus="select_box1()"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td width="41%" height="25%" align="left" valign="top" bgcolor="#FFFFFF"> New Password&nbsp;:</td>
                                                      <td width="59%" align="left" bgcolor="#FFFFFF"><input type="password" name="new_password" onFocus="select_box2()" ></td>
                                                    </tr>
                                                    <tr>
                                                      <td width="41%" height="25%" align="left" valign="top" bgcolor="#FFFFFF"> Confirm Password&nbsp;:</td>
                                                <td width="59%" align="left" bgcolor="#FFFFFF">
												<input type="password" name="confirm_password" onFocus="select_box3()"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td colspan="2" align="center" bgcolor="#3c7701">&nbsp;
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

function check_form()
{
   	var doc=document.form1;
	if(doc.current_password.value=="")
	{
		alert("Please enter current password .");
		doc.current_password.focus();
		return false;
	}
	if(doc.new_password.value=="")
	{
		alert("Please enter new password .");
		doc.new_password.focus();
		return false;
	}
	if(doc.confirm_password.value=="")
	{
		alert("Please enter confirm password .");
		doc.confirm_password.focus();
		return false;
	}
	if(doc.confirm_password.value!=doc.new_password.value)
	{
		alert("New password and confirm password does not match.");
		doc.confirm_password.focus();
		return false;
	}

}

function select_box1(){
	//var box_name	=	box_name;

   	//alert(document.form1.box_name.value);
	var len=document.form1.current_password.value.length;
	document.form1.current_password.select(0,len-1);
}
function select_box2(){
	//var box_name	=	box_name;
	//alert(box_name);
   	//alert(document.form1.box_name.value);
	var len=document.form1.new_password.value.length;
	document.form1.new_password.select(0,len-1);
}
function select_box3(){
	//var box_name	=	box_name;
	//alert(box_name);
   	//alert(document.form1.box_name.value);
	var len=document.form1.confirm_password.value.length;
	document.form1.confirm_password.select(0,len-1);
}

function set_focus()
{
var len=document.form1.current_password.focus();
}

</script>