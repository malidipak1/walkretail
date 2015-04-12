<?php 
if(isset($_REQUEST['action']) && $_REQUEST['action']=='check_login')
{
	include('database.inc.php');
	session_start();
	$user_name		=$_REQUEST['user_name'];
	$password		=$_REQUEST['password'];
	
	$sql=mysql_query("select * from admin where uname ='".addslashes($user_name)."' and password='".addslashes($password)."'");
	$num=mysql_num_rows($sql);
	if($num >0){
		$_SESSION['login']=$user_name;
		header('Location: admin_page.php');
		exit;
	}else
	{ 
		header("Location: index.php?message=Invalid login. Please try again");
		exit;
	}

} // end

?>

<html>
<head>
<title>::: (Admin Panel)  :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="set_focus()">
<table width="100%" height="100%" border="0"  align="center" cellpadding="0" cellspacing="0"  bordercolor="#000000">
  <tr>
    <td height="100"><?php include('head.php');?></td>
  </tr>
  <tr><td></hr></td>
  </tr>

   <?php if(isset($_REQUEST['message']) && $_REQUEST['message']!=''){?>
   <tr>
 <td height="20" colspan="2" align="center" class="red">
			<?php echo $_REQUEST['message'];?></td>
  </tr>
	<?php }?>	  
  <tr> 
    <td  align="center" valign="middle" bordercolor="#000000"> 
        <table bgcolor="#697A1A" border="0" cellpadding="5" cellspacing="1" width="450">
        <form name="form1" method="POST" ACTION="index.php?action=check_login" onSubmit="return form_check();">
          <tbody>
            <tr>
              <td bgcolor="#f1f3f5" width="100%"><center>
                </center>
                  <table border="0" cellpadding="5" cellspacing="0" width="100%">
                    <tbody>
                      <tr>
                        <td width="30%"><p align="center"><img src="images/security.png" border="0" height="64" width="64" /> </p>
                            <p><strong>Welcome!</strong><br />
                                <br />
                              Use a valid username and password to logon...</p></td>
                        <td valign="top" width="70%"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                              <tr>
                                <td width="100%"><h1>login</h1></td>
                              </tr>
                              <tr>
                                <td width="100%">
                                    <table bgcolor="#c0c0c0" border="0" cellpadding="0" cellspacing="1" width="100%">
                                      <tbody>
                                        <tr>
                                          <td bgcolor="#e6e6e6" width="100%"><table border="0" cellpadding="5" cellspacing="0" width="100%">
                                              <tbody>
                                                <tr>
                                                  <td width="100%"><strong>Username<br />
                                                    </strong>
                                                  <input type="text" name="user_name" tabindex="0"></td>
                                                </tr>
                                                <tr>
                                                  <td width="100%"><strong>Password<br />
                                                    </strong>
                                                  <input type="password" name="password" tabindex="0"></td>
                                                </tr>
                                                <tr>
                                                  <td width="100%">
                                                  <input name="submit" type="submit" value="Submit"  >
                                                  &nbsp;                                                    <a href="admin_forgot_password.php" style="text-decoration:underline; color:#006633;">Forgot Password</a> </td>
                                                </tr>
                                              </tbody>
                                          </table></td>
                                        </tr>
                                      </tbody>
                                  </table></td>
                              </tr>
                            </tbody>
                        </table></td>
                      </tr>
                    </tbody>
                </table></td>
            </tr>
          </tbody></form>
      </table>
        <br>
        <br>
        <br>
        <br>
        <br>
    </form></td>
  </tr>
  <tr>
    <td  align="center" valign="middle" bordercolor="#000000" height="20"><?php include("footer.inc.php"); ?></td>
  </tr>
</table>
</body>
</html>
<script language="javascript">
function form_check()
{
   	var doc=document.form1;
   	
	if(doc.user_name.value=="")
	{	
		alert("Please enter user name");
		doc.user_name.focus();
		return false;
	}
	else if(doc.password.value=="")
	{
		alert("Please enter password");
		doc.password.focus();
		return false;
	}
	else{
		return true;
	}
}

function set_focus()
{
	document.form1.user_name.focus();
}
</script>
