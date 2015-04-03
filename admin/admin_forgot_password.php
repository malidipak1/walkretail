<?php 
include('database.inc.php'); // database.inc.php is databse connection file which will be included 
session_start();
// $form_action will set the action of the  form 
// $button_value is the value of the button 
$form_action="forgot_password";
$button_value="Send Mail";
#################################   FORGOT PASSWORD     #########################################
if(isset($_REQUEST['action']) && $_REQUEST['action']=='forgot_password'){
	$sql_admin		=	"select * from admin where uname='admin' ";
	$result_admin	=	mysql_query($sql_admin);
	$row_admin		=	mysql_fetch_array($result_admin);
	$from			=	$row_admin['email'];
		
	$sql_user		=	"select * from admin where uname='".$_REQUEST['login']."' ";
	$result			=	mysql_query($sql_user);
	$count			=	mysql_num_rows($result);
	
	// when user enters admin username it will send a mail to the admin email id which will conatin its password 
	if($count >0 )
		{
			$row=mysql_fetch_array($result);
		
			$first_name	=	$row['uname'];
			$password	=	$row['password'];
			$email 		=	$row['email'];
		
			$to 	    = $email;
			
			####################   For fetching mail format from the database  ######################################
			
			$mail_format_subject	=	"Vedic Kranti Admin forgot password";
			$mail_format_body		="";
			
			####################   					END 						 ######################################
			
			$from		=	$from;	
			$subject 	= $mail_format_subject;
			// this $message will contain table formts  which wil contain his password 
			$message	=	ereg_replace("!uname",$first_name,$mail_format_body);
			$message	=	ereg_replace("!email_id",$email,$message);
			$message	=	ereg_replace("!password",$password,$message); 
			//$message ;
			
			
			$xheaders .= "From: ".$from." \r\n"; 
			//$xheaders .= "X-Mailer: PHP\n"; // mailer
			$xheaders .= "X-Priority: 6\n"; // Urgent Message!
			$xheaders.= "Content-Type: text/html; charset=iso-8859-1\n";
			mail($to, $subject, $message, $xheaders);
			header("Location: admin_forgot_password.php?message=A Mail Containing Your Password Has Been Sent to Your Mail Id  ");	
	
		}
		else{
		header("Location: admin_forgot_password.php?message=Invalid Admin ! You Dont Have Right To Access Admin Part");	
		}
exit();
}
#################################   END FORGOT PASSWORD    #########################################

?>
<html>
<head>
<title>::: (Admin Panel) :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style2 {
	color: #FFFFFF;
	font-weight: bold;
}
.style3 {color: #FF0000}
-->
</style>
<script language="JavaScript" type="text/javascript" src="js/popcalendar.js"></script>
<script language="JavaScript" type="text/javascript" src="js/cal.js"></script>
</head>
<body onLoad="set_focus()">
<table width="100%" height="100%" align="center" cellpadding="0" cellspacing="0"  bordercolor="#5181BF" style="border-left:1px solid #006ecc;border-right:1px solid #006ecc;">
  <tr>
    <td height="100"><?php include('head.php');?></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"  valign="top">
	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" >
  		<tr>  
		  <td width="100%" align="center" valign="top" bgcolor="" class="red">
		  		<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0"  bordercolor="#000000" >
                           <tr>
                                        <td bordercolor="#FFFFFF"  valign="top" align="center"><table width="100%" border="0" cellspacing="4" cellpadding="0">
                                              <tr>
                                                <td  align="center" class="red">
                                              </tr>
                                              <tr>
                                                <td align="center" valign="top" ><form action="admin_forgot_password.php?action=<?php echo $form_action; ?>" onsubmit ="return check_form();" method="post" name="admin_forgot_password" id="forgot_password">
 <div align="center"><br><br><br></div> 
 <table width="45%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<?php if(isset($_REQUEST['message'])){?>
 <tr align="center" bgcolor="#5b6c0c" >
   <td height="25" colspan="2" align="center" bgcolor="#ffffff" class="red" ><div align="center"><?php echo $_REQUEST['message'];?></div></td>
 </tr>
<?php }?>
 <tr align="center" bgcolor="#3270B4" >
 <td height="25" colspan="2" align="left" bgcolor="#3270B4">
 <div class="white">
   <div align="center" >Forgot Password </div>
 </div> <div class="white"></div></td>
  </tr>
    <tr align="center" bgcolor="#f5f5f5">
      <td height="33" colspan="2" align="center" bgcolor="#FFFFFF"><p class="style3">If you've forgotten your password, enter your user name below and  we'll send you an e-mail message containing your new password.</td>
      </tr>
    <tr align="center" bgcolor="#f5f5f5">
      <td width="53%" height="33" align="center" bgcolor="#FFFFFF"><div align="center" class="head_ing">Enter User Name </div>
        <div align="left"></div></td>
      <td width="47%"  align="center" bgcolor="#FFFFFF"><div align="center">
            <input name="login" type="text" id="login">
          </div><div align="left"></div></td>
      </tr>
    
	
	<tr bgcolor="#FFFFFF">
                                                        <!--  <td height="25%" align="right" valign="top"  >&nbsp;</td> -->
    	<td height="33" colspan="5" align="center" bgcolor="#3270B4"><input name="add" type="submit" value="<?php echo $button_value;?>"/></td>
    </tr>
    </table>
    </form></td>
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
<script language="JavaScript">
function check_form()
{
  	var doc=document.admin_forgot_password;
	if(doc.login.value=='')
	{
	alert('Enter admin user name ');
	doc.login.focus();
	return false;
	}
	else{
	return true;
	}   
}

function set_focus()
{
document.admin_forgot_password.login.focus();
}

</script>