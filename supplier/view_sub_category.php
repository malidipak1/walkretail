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
                header("location:view_sub_category.php?action=view_sub_cat&catid=$pid&message=First Delete All The Sub Categories In This Category");
        }
        }
        else
        {       
                $sql11=mysql_query("DELETE FROM categories WHERE catid='$cats_id'");
                header('location:view_sub_category.php?message=Deleted Sucessfully');
                exit();
        }
        
}  

if(isset($_REQUEST['action']) && $_REQUEST['action']=='view_sub_cat')
{       

 $sql_prod = ("SELECT * FROM categories where catid= '".$_REQUEST['catid']."'");
   //$products_id=$_REQUEST['product_id'];
   $prod_results=mysql_query($sql_prod);
   $num=mysql_num_rows($prod_results);
   $catname="";
   $i=0;
    if($num>0)
          {
        $prod_row = mysql_fetch_row($prod_results);
        $parent_id=$prod_row[1];
        while($parent_id!=0)
        {
                $sql=mysql_query("select * from categories where catid='$parent_id'");
                $result=mysql_fetch_row($sql);
                $parent_id=$result[1];
                $catname[$i+1]=$result[0];
                $i++;
                
        }
        }
        $lcid=$catname[1];
        $catname=array_reverse($catname);
        $cat_path = implode(":", $catname);
        $cnt=count($catname);
 




        $cat_id=$_REQUEST['catid'];
   //echo $cat_id;
        $sql      =  mysql_query("select * from categories where parent_id='$cat_id'");
        $result   =  mysql_num_rows($sql);
        
        
        
        
        
        
        
        
  

}       
        
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
                                    <td width="182" align="left" valign="top" bgcolor="#b5f971" class="red" style="padding:0px; margin:0px;"><?php include('left_mnu.php');?></td>
                                    
          <td width="100%" align="center" valign="top" bgcolor="" class="red">
                  
                  <form method="post"  name="form1" id="form1" ACTION="">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="50" align="left" valign="middle">&nbsp;&nbsp;<span class="style2">&nbsp;<strong>View Sub Menu</strong></span></td>
              </tr>
              <tr>
                <td align="center" valign="middle"><table width="50%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
                  
                  <?php if(isset($_REQUEST['message']) && $_REQUEST['message']!=''){?>
                  <tr>
                    <td height="30" colspan="6" align="center" bgcolor="#FFFFFF" class="red"><?php echo $_REQUEST['message'];?></td>
                  </tr>
                  <?php }?>
                  <tr bgcolor="#3c7701000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000">
                    <td height="26" align="left" nowrap="nowrap" bgcolor="#3c7701" ><span class="style5">&nbsp;&nbsp;<strong> Sub Menu </strong></span></td>
                    <td height="26" align="center" nowrap="nowrap" ><span class="style5">&nbsp;<strong>Edit </strong></span></td>
                    <td height="26" align="center" nowrap="nowrap" ><span class="style5">&nbsp;<strong>Delete</strong></span></td>
                  </tr>
                  
                                        <?php 
        
if($result>0){
     while($row =mysql_fetch_array($sql))
         {
			//echo "<pre>"; print_r($row);exit;
        ?>
                  <tr bgcolor="#FFFFFF">
                  
                  
                    <td width="70%" height="28" align="left" nowrap="nowrap" >&nbsp;&nbsp;<a href="view_sub_category.php?action=view_sub_cat&catid=<?php echo $row['catid'];?>"> <?php echo $row['catname']; ?></a></td>
                    
                    
                    <td width="15%" height="26" align="center" valign="middle" nowrap="nowrap" >&nbsp;&nbsp;<a href="edit_sub_category.php?catid=<?php echo $row['catid'];?>&parent_catid=<?php echo $_REQUEST['catid'];?>&catlink=<?php echo $row['cat_link'];?>"><img src="images/b_edit.gif"  border="0"></a></td>
                    <td width="15%" height="26" align="center" valign="middle" nowrap="nowrap" >&nbsp;&nbsp;<a href="view_sub_category.php?action=delete&catid=<?php echo $row['catid'];?>" onClick=" javascript:return confirm('Are you sure! You want to delete this product category ');"><img src="images/b_drop.gif"  border="0"></a></td>
                  </tr>
                  <?php 
        }
        }
        else 
        {
        ?>
                  <tr bgcolor="#FFFFFF">
                    <td height="26" colspan="3" align="center" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF" class="red" >&nbsp;&nbsp;No  Menu  Exist&nbsp;&nbsp;</td>
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