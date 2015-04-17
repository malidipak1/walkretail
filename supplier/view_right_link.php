<?php
session_start();
include("database.inc.php");
error_reporting(~E_ALL);
if(!isset($_SESSION['login']))
{
	 header('Location: index.php');
	 exit;
}
###########################################  PAGING WITH PER PAGE            #####################################
$file_name			=	"view_right_link.php"; // this is file name which is used during paging  , included at the bottom of the page
$paging_table_name	=	"notice";
include("paging/paging_query.inc.php");

############################################ END PAGING WITH PER PAGE       ##############################################
$sql_product		= 	"SELECT * FROM rightlink LIMIT $eu, $limit ";
$result_product		=	mysql_query($sql_product);
$num_rows_product	=	mysql_num_rows($result_product);
############################################ END PAGING WITH PER PAGE
if(!isset($_REQUEST['action']))		
{
	$sql=mysql_query("select * from rightlink ORDER BY rightlink_id");
	$result=mysql_num_rows($sql);
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{
	$sql	=	"DELETE FROM rightlink where rightlink_id ='".$_REQUEST['rightlink_id']."' ";
	mysql_query($sql);
	header("location:view_right_link.php?action=view&message=Deleted successfully&action=view");
	exit;
}
################################################### END DELETE ########################

############################################################## SEARCH ########################
##############################################################END SEARCH ########################

if(isset($_REQUEST['action']) && $_REQUEST['action']=='view')
{
	$enroll_id 		=	$_REQUEST['rightlink_id'];
	$sql			=	mysql_query("select * from rightlink");
	$result			=	mysql_num_rows($sql);
}

############################################## DELELE ########################
 ?>
<html>
<head>
<title>:::(Admin Panel) :::</title>
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
                                    
                                    <td width="182" align="left" valign="top" bgcolor="#E9E9E9" class="red" style="padding:0px; margin:0px;"><?php include('left_mnu.php');?></td>
                                    <td width="100%" align="left" valign="top" bgcolor="" class="red"><table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0"  bordercolor="#111111">
                                      <tr>
                                        <td height="57" colspan="2" align="left"  valign="middle" class="head_ing">Manage Contact Us</td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" align="left"  valign="top" class="red">                                            </td>
                                      </tr>
                                      
                                      <tr>
									   <?php if(isset($_REQUEST['message'])){ ?>
									   <tr align="right"  bgcolor="#ffffff">
                                            <td colspan="10" height="" class="red"><div align="center">
                                              <?php echo $_REQUEST['message'];?>
                                            </div>                                            </td>
                                            </tr>
										<?php }?>	
      	<td colspan="2" align="center" valign="top">
	  	<form name="search_product" method="post" action="view_right_link.php?action=search_product">
			<table width="95%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
			<?php if($num_rows_product > 0) { ?>
			<tr align="right"  bgcolor="#5b6c0c">
            	<td height="" colspan="15" bgcolor="#FFFFFF" class="red">&nbsp;
                              <?php include("paging/no_of_records.inc.php"); ?>
				</td>
            </tr>
			<?php }?>
											 
<?php /*if(isset($_REQUEST['action']) && ($_REQUEST['action']=='search_product' || $_REQUEST['action']=='view') )
									{*/?>
										 <tr align="center"  bgcolor="#3270B4">									
											<?php if($num_rows_product > 0) { ?>
                                                                                    
                                          <td width="14%" bgcolor="#3c7701" class="white">Page</td>
                                          <td width="48%" bgcolor="#3c7701" class="white">Details</td>
                                          
                                          <!-- <td width="12%" bgcolor="#FFFFFF"><div align="center">
                        <div align="center">
                          <div align="center"><b>Detail</b></div>
                        </div>
                      </div></td> -->
                                              <!--  <td width="62%" align="left" bgcolor="#FFFFFF"><b>Newsletter 
                        Detail </b></td> -->
                                              <!--  <TD width="43%"><div align="center"><B>Description</B></div></TD> -->
                                          <td width="5%" bgcolor="#3c7701" class="white">Edit</td>
                                            <td width="8%" bgcolor="#3c7701" class="white">Delete</td>
                      </tr>
                                          <!----------------------Start your loop------------------------------->
                                          <?php
			  while($row_product=mysql_fetch_array($result_product))
                 {
				?>
                                           <tr align="center">	
                                            
                                            <td width="14%" height="57" align="left" bgcolor="#FFFFFF">
                                                <?php echo $row_product['rightlink_heading'];?>                                            </td>
                                            <td width="48%"  bgcolor="#FFFFFF"><?php echo $row_product['rightlink_details'];?></td>
                                            <td width="5%"  bgcolor="#FFFFFF"><a href="add_new_right_link.php?action=edit&rightlink_id=<?php echo $row_product['rightlink_id']?>"><img src="images/Edit.gif" width="12" height="12" alt="Edit" border="0" /></a></td>
                                            <td width="8%"   bgcolor="#FFFFFF"><a href="view_right_link.php?action=delete&rightlink_id=<?php echo $row_product['rightlink_id']?>"  onClick=" javascript: return confirm('Are you sure You want to delete ?');"><img src="images/del.gif" width="12" height="10" border="0" /></a> </td>
                                          </tr>
                                          <?php }
											}else{
											?>
                                          <tr>
                                            <td  height="29" colspan="15" align="center" bgcolor="#ffffff" class="head_ing">No Record Exists</td>
                                          </tr>
                                          <?php }										  
										  //} ################################?>
                                          
                                          
                                          
                                          
                                          
                                          <!-- this code will show paging in the . When record s are more -->
									<?php if($nume >$limit){ ?>
									
										<?php }?>   
									<!-- End Paging Code -->	
									
									<!-- Paging starts here  -->
									<?php include("paging/paging_row.inc.php") ?> 
									<!-- Paging ends starts here  -->	
                                          
                                          <tr>
                                            <td  height="33" colspan="15" align="center" bgcolor="#3c7701"><input name="add" type="button" value="Add New Record"  onClick="window.location='add_new_right_link.php';" /></td>
                                          </tr>
                                          <!-----------------------End your loop here---------------------------->
                                        </table>
                </form></td>
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
