<?php
include("database.inc.php"); 
 // db.inc.php is databse connection file which will be included
session_start();
// this condition will check whether the admin has logged in or not 
// if he has not logged in or session has expired it will take you at the login page(index.php)
if(!isset($_SESSION['login']))
   {
     header('Location: index.php');
	 exit;
   }

###########################################  PAGING WITH PER PAGE            #####################################
$file_name			=	"view_static_page.php"; // this is file name which is used during paging  , included at the bottom of the page
$paging_table_name	=	"static_page";
$c="";
include("paging/paging_query.inc.php");

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{
	$sql				=	mysql_query("select * from static_page where page_id='".$_REQUEST['page_id']."' ");

$row 				=	mysql_fetch_array($sql);
$page_category_id	=	$row['page_category_id'];
	
	//echo "delete from static_page where page_id = '".$_REQUEST['page_id']."'";
	//echo "delete from categories where catid='".$page_category_id."' ";exit;
	
$sql=mysql_query("delete from static_page where page_id = '".$_REQUEST['page_id']."' ");

//$sql=mysql_query("select page_id, page_title,page_detail from static_page ORDER BY page_title ");
$quesrys=mysql_query("select * from categories where parent_id='".$page_category_id."' ");
$numrows=mysql_num_rows($quesrys);
if($numrows==0)
{
	$sql	=	mysql_query("delete from categories where catid='".$page_category_id."' ");
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
                                              <td width="368"  align="right" class="red">&nbsp;<?php include("paging/no_of_records.inc.php"); ?></td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td bordercolor="#FFFFFF"  valign="top" align="center"><table width="100%" border="0" cellspacing="4" cellpadding="0">
                                              <tr>
                                              <td  align="center" class="red">                                              </tr>
											   
											    	
										  <?php if(isset($_REQUEST['message'])){?>
											 
											  <tr>
                                                <td  align="center" class="red"><?php echo $_REQUEST['message'];?></td>
                                              </tr>
											   <?php }?> 
                                              <tr>
                                                <td align="center" valign="top" >
												<form action="add_static_page.php" method="post" name="form1" id="form1">
<table width="52%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<tr align="center" bgcolor="#3c7701" >
  <td width="38%" height="25"  class="white" > Page Menu</td>
  <td width="22%" class="white" >Edit</td>
  <td width="22%" class="white" > Delete</td>
<!--<td width="18%" ><div class="white" align="center">
<div align="center"><b>Delete</b></div>
</div></td>-->
</tr>
<!--<tr align="center" bgcolor="#f5f5f5">
<td height="33" colspan="3" align="left"  bgcolor="#FFFFFF" class="red">Links</td>
</tr>-->		
<?php 
############################################ END PAGING WITH PER PAGE       ##############################################


#################################   DELETE    #########################################
  ############################################ END PAGING WITH PER PAGE       ##############################################

$sql_left_links	=	mysql_query("select * from static_page LIMIT $eu, $limit  ");
$result_left_links=mysql_num_rows($sql_left_links);

#############################################			END    					#########################################
if($result_left_links> 0) { ?>
<?php while($row_left_links =mysql_fetch_array($sql_left_links))
{

?>
<tr align="center" bgcolor="#f5f5f5">
<td height="33" align="left"  bgcolor="#FFFFFF">
<?php

$x=$row_left_links['page_category_id'];
$y="";
while($x!=0)
{
	//echo "select * from categories where catid=".$x."";
	$sql_left_links1	=	mysql_query("select * from categories where catid=".$x."");
	$result_left_links1=mysql_fetch_row($sql_left_links1);
	$x=$result_left_links1[1];
	$y[]=$result_left_links1[2];
}
$reversed = array_reverse($y);
$page_indicator = implode(" > ",$reversed);
?>
<a href="add_static_page.php?action=edit&page_id=<?php echo $row_left_links['page_id'];?>&path=<?php echo $page_indicator; ?>&image_name=<?php echo $row_left_links['gallery_image_name']; ?>">
<?php echo $page_indicator;
?> </a> 	  </td>

<td width="22%"   bgcolor="#FFFFFF">
  <a href="add_static_page.php?action=edit&page_id=<?php echo $row_left_links['page_id'];?>&path=<?php echo $page_indicator; ?>&image_name=<?php echo $row_left_links['gallery_image_name']; ?>">
    <img src="images/Edit.gif"  border="0" /></a> </td>

<td width="18%"   bgcolor="#FFFFFF">
  <a href="view_static_page.php?action=delete&page_id=<?php echo $row_left_links['page_id']?>&message=Page deleted successfully"  onclick=" javascript: return confirm('Are you sure You want to delete the Static Page ');">
    <img src="images/del.gif" border="0" /></a></td>
</tr>
<?php }

}?>	

<!-- Paging starts here  -->
			<?php include("paging/paging_row.inc.php") ?> 
			<!-- Paging ends starts here  -->		
<tr bgcolor="#FFFFFF">
											<!--  <td height="25%" align="right" valign="top"  >&nbsp;</td> -->
<td height="33" colspan="7" align="center" bgcolor="#3c7701">
<input name="add" type="submit" value="Add New Static Page"/>		</td>
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