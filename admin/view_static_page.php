<?php
include_once 'access_check.php';
include_once '../DBUtil.php';
include_once '../Util.php';
   
$dbObj = new DBUtil();
$arrPage = $dbObj->getStaticPage();
?>
<html>
<head>
<title>::: (Admin Panel) :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" height="100%" align="center" cellpadding="0" cellspacing="0"  bordercolor="#5181BF">
  <tr>
    <td height="100"><?php include('head.php');?></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"  valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
                                    
                                    <td width="182" align="left" valign="top" bgcolor="#D6E7F6" class="red" style="padding:0px; margin:0px;"><?php include('left_mnu.php');?></td>
                                    <td width="100%" align="center" valign="top" bgcolor="" class="red"><table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0"  bordercolor="#000000">
                                      <tr>
                                        <td valign="middle" height="20"  align="left"><table width="767" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              
                      <td width="399" height="57" class="head_ing"> 
                        Manage Static Pages </td>
                                              <td width="368"  align="right" class="red">&nbsp;</td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td bordercolor="#FFFFFF"  valign="top" align="center"><table width="100%" border="0" cellspacing="4" cellpadding="0">
                                              <tr>
                                              <td  align="center" class="red">                                              </tr>
											   
										 <tr>
                                                <td align="center" valign="top" >
												<form action="add_static_page.php" method="post" name="form1" id="form1">
<table width="52%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<tr align="center" bgcolor="#3c7701" >
  <td width="38%" height="25"  class="white" > Page Menu</td>
  
<!--<td width="18%" ><div class="white" align="center">
<div align="center"><b>Delete</b></div>
</div></td>-->
</tr>
<!--<tr align="center" bgcolor="#f5f5f5">
<td height="33" colspan="3" align="left"  bgcolor="#FFFFFF" class="red">Links</td>
</tr>-->	
<?php foreach ($arrPage as $page) {?>

<tr align="center" bgcolor="#f5f5f5">
<td height="33" align="left"  bgcolor="#FFFFFF">

<a href="add_static_page.php?page_code=<?php echo $page['page_code'];?>">
<?php echo $page['page_title'];
?> </a> 	  </td>


</tr>
<?php }?>
<tr bgcolor="#FFFFFF">
											<!--  <td height="25%" align="right" valign="top"  >&nbsp;</td> -->
<td height="33" colspan="7" align="center" bgcolor="#3c7701">
<!-- <input name="add" type="submit" value="Add New Static Page"/>		</td> -->
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
function navigate(url_page)
{
  
  	document.form1.action=url_page;
	document.form1.submit();
    
}
</script>