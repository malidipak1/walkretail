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
if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{       
        $cats_id=$_REQUEST['catid'];
        $sql_subcat = mysql_query("SELECT * FROM categories WHERE parent_id='$cats_id'");
        $num_rows_subcat = mysql_num_rows($sql_subcat);
        if($num_rows_subcat!=0)
        {       
        $sql1 = mysql_query("SELECT * FROM categories WHERE catid='$cats_id'");
        $num_rows = mysql_num_rows($sql1);
                if($num_rows!=0)
        {       
                $row_pid = mysql_fetch_row($sql1);
                $pid=$row_pid[1];
                header("location:view_category.php?action=view_sub_cat&catid=$pid&message=First Delete All The Sub Categories In This Category");
        }
        }
        else
        {       
                $sql11=mysql_query("DELETE FROM categories WHERE catid='$cats_id'");
                header('location:view_category.php?message=Category Deleted Sucessfully');
                exit();
        }
}  
		$cat_id=$_REQUEST['catid'];
		//echo "select * from categories where parent_id='$cat_id'";
		$sql      =  mysql_query("select * from categories where parent_id='$cat_id'");
		$result   =  mysql_num_rows($sql);
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/css.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style2 {font-size: 16}
.style5 {color: #FFFFFF; font-size: 12px; }
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
                                    <td width="182" align="left" valign="top" bgcolor="#63b610" class="red" style="padding:0px; margin:0px;"><?php include('left_mnu.php');?></td>
                                    
          <td width="100%" align="center" valign="top" bgcolor="" class="red">
                  
                  <form method="post"  name="form1" id="form1" ACTION="">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="50" align="left" valign="middle">&nbsp;&nbsp;<span class="style2">&nbsp;<strong>View Menus</strong></span></td>
              </tr>
              <tr>
                <td align="center" valign="middle"><table width="50%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
                  
                  <tr bgcolor="#3c7701">
                    <td height="26" align="left" nowrap="nowrap" ><span class="style5">&nbsp;&nbsp;<strong> Menu Name </strong></span></td>
                    <td height="26" align="center" nowrap="nowrap" ><span class="style5">&nbsp;<strong>Edit </strong></span></td>
                    <td height="26" align="center" nowrap="nowrap" ><span class="style5">&nbsp;<strong>Delete</strong></span></td>
                  </tr>
                                                    <?php if(isset($_REQUEST['message']) && $_REQUEST['message']!=''){?>
                  <tr>
                    <td colspan="6" align="center" bgcolor="#FFFFFF" class="red"><?php echo $_REQUEST['message'];?></td>
                  </tr>
                  <?php }?>

                  <?php 
        
if($result>0){
	$i=0;
     while($row =mysql_fetch_array($sql))
         {
        ?>
            <tr bgcolor="#FFFFFF">
             <td width="70%" height="28" align="left" nowrap="nowrap" >&nbsp;&nbsp;<a href="view_sub_category.php?action=view_sub_cat&catid=<?php echo $row['catid'];?>"> <?php echo $row['catname']; ?></a></td>
                    <td width="15%" height="26" align="center" valign="middle" nowrap="nowrap" >&nbsp;&nbsp;<a href="edit_menu.php?catid=<?php echo $row['catid'];?>"><img src="images/b_edit.gif"  border="0"></a></td>
                    <td width="15%" height="26" align="center" valign="middle" nowrap="nowrap" >&nbsp;&nbsp;<a href="view_menu.php?action=delete&catid=<?php echo $row['catid'];?>" onClick=" javascript:return confirm('Are you sure! You want to delete this product category ');"><img src="images/b_drop.gif"  border="0"></a></td>
                  </tr>
                  <?php $i++;
        }
        }
        else 
        {
        ?>
                  <tr bgcolor="#FFFFFF">
                    <td height="26" colspan="3" align="center" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF" class="red" >&nbsp;&nbsp;No Menu Exist&nbsp;&nbsp;</td>
                    </tr>
                  <?php
        }
        ?>
                  <tr bgcolor="#C899C6">
                    <td height="27" colspan="3" align="center" nowrap="nowrap" bgcolor="#FFFFFF" >&nbsp;</td>
                  </tr>
                  <tr bgcolor="#C899C6">
                    <td height="27" colspan="3" align="center" nowrap="nowrap" bgcolor="#3c7701" ><input type="button" name="Button" value="Back" onClick="history.go(-1) " ></td>
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