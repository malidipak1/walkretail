<?php
ob_start(); 
error_reporting(~E_ALL);
include("database.inc.php");
session_start();
if(!isset($_SESSION['login']))
   {
    header('Location: index.php');
        exit;
   }
   $cat_id=$_REQUEST['catid'];
   

if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit')
{
        $cats_id=$_REQUEST['cats_id'];
        $catname=$_REQUEST['catname'];
		$catlink=$_REQUEST['catlink'];
		$disp=$_REQUEST['disp'];
       //echo "UPDATE categories SET catname = '$catname', cat_link = '$catlink', disp = '$disp' WHERE catid = '$cats_id'";exit;
		$sql      =  mysql_query("UPDATE categories SET catname = '$catname', cat_link = '$catlink', disp = '$disp' WHERE catid = '$cats_id'");
        $result   =  mysql_num_rows($sql);
        header('location:view_category.php?message=Category Name Updated Sucessfully');
exit();
}
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/css.css" rel="stylesheet" type="text/css">
<script language="javascript">
function validate()
{
        var doc=document.form1;
        if(doc.catname.value=="")
        {
                alert("Please enter category name.");
                doc.catname.focus();
                return false;
        }
}
</script>

<style type="text/css">
<!--
.style2 {color: #FFFFFF}
-->
</style>
</head>
<body>
<table width="100%" height="100%" align="center" cellpadding="0" cellspacing="0"  bordercolor="#5181BF">
  <tr>
    <td height="41"><?php include('head.php');?></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"  valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
                                    <td width="182" align="left" valign="top" bgcolor="#b5f971" class="red" style="padding:0px; margin:0px;"><?php include('left_mnu.php');?></td>
                                    
          <td width="100%" align="center" valign="top" bgcolor="" class="red">
                  
                  <form method="post"  name="form1" id="form1" ACTION="edit_menu.php?action=edit" onSubmit="return validate()">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="40"><strong class="head_ing">Edit Menu</strong></td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="37%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                  <tr>
                    <td height="27" colspan="2" bgcolor="#3c7701"><p><span class="style2"><strong>Edit</strong><strong> Category </strong></span></p></td>
                  </tr>
                  <?php if(isset($_REQUEST['message']) && $_REQUEST['message']!=''){?>
                  <tr>
                    <td height="28" colspan="5" align="center" bgcolor="#FFFFFF" class="red"><?php echo $_REQUEST['message'];?> </td>
                  </tr>
                  <?php }?>
                  <tr bgcolor="#FFFFFF">
                    <td width="33%" align="left" nowrap="nowrap" >&nbsp;&nbsp;<strong>Menu Name  :</strong> </td>
                    <?php 
        $result = mysql_query("SELECT * FROM categories WHERE catid='$cat_id'");
        $row = mysql_fetch_row($result);
        
?>
                    <td width="67%" align="left" nowrap="nowrap" ><input name="catname" type="text" id="catname" size="35" value="<?php echo $row[2]; ?>">
                        <input name="cats_id" type="hidden" id="cats_id" value="<?php echo $cat_id ;?>"></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td align="left" nowrap="nowrap" >&nbsp;<strong>Menu Link  :</strong></td>
                    <td height="29" align="left" nowrap="nowrap" ><input name="catlink" type="text" id="catlink" size="35" value="<?php echo $row[3]; ?>"></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td align="left" nowrap="nowrap" ><strong>Where to display</strong> :</td>
                    <td height="29" align="left" nowrap="nowrap" > 
                    
                    <input type="checkbox" name="disp"  value="top" id="disp1" <?php if($row[4]=='top')  echo 'checked'; ?> >
                     Top 
                     
                     <input type="checkbox" name="disp"  value="footer1" id="disp2" <?php if($row[4]=='top_middle')  echo 'checked'; ?>>
                      Footer 1
                      
                      <input type="checkbox" name="disp"  value="footer2" id="disp3" <?php if($row[4]=='right')  echo 'checked'; ?>>                      Footer 2
                      
                      <input type="checkbox" name="disp"  value="footer3" id="disp3" <?php if($row[4]=='right')  echo 'checked'; ?>>                      Footer 3
                      
                      </td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td align="left" nowrap="nowrap" >&nbsp;</td>
                    <td height="29" align="left" nowrap="nowrap" ><input type="submit" name="Submit" value="Update" ></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td height="29" colspan="2" align="left" nowrap="nowrap" bgcolor="#3c7701" >&nbsp;</td>
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