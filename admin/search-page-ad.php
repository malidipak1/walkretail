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
$file_name			=	"view_teams.php"; // this is file name which is used during paging  , included at the bottom of the page
$paging_table_name	=	"team";
include("paging/paging_query.inc.php");

############################################ END PAGING WITH PER PAGE       ##############################################

/*if(isset($_REQUEST['category_id']) && $_REQUEST['category_id']!='')
{
	$query2="SELECT * FROM books WHERE book_category_id = '".$_REQUEST['category_id']."'";
	$rec=mysql_query($query2);
	$nume=mysql_num_rows($rec);
}*/
############################################ END PAGING WITH PER PAGE       ##############################################


if(!isset($_REQUEST['action']))		
{
	
	$sql=mysql_query("select * from team ORDER BY header_id LIMIT $eu, $limit");
	$result=mysql_num_rows($sql);
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{
	$sql	=	"DELETE FROM team where header_id ='".$_REQUEST['image_id']."' ";
	mysql_query($sql);
	
	if(file_exists("teams/".$_REQUEST['image_name']))
	{
		unlink("teams/".$_REQUEST['image_name']);
	}
	if(file_exists("teams/thumb1/".$_REQUEST['image_name']))
	{
		unlink("teams/thumb1/".$_REQUEST['image_name']);
	}
	if(file_exists("teams/thumb2/".$_REQUEST['image_name']))
	{
		unlink("teams/thumb2/".$_REQUEST['image_name']);
	}
	header("location:view_teams.php?message=Image deleted successfully&action=search_product");
	exit;
}
################################################### END DELETE ########################

############################################################## SEARCH ########################
if(isset($_REQUEST['action']) && $_REQUEST['action']=='search_product')		
{
	$sql=mysql_query("select * from team ORDER BY team_name");
	$result=mysql_num_rows($sql);
}
##############################################################END SEARCH ########################

if(isset($_REQUEST['action']) && $_REQUEST['action']=='view'){
$sql=mysql_query("select * from team ORDER BY team_name  ");
$result=mysql_num_rows($sql);
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
                                    
                                    <td width="182" align="left" valign="top" bgcolor="#4c9309" class="red" style="padding:0px; margin:0px;"><?php include('left_mnu.php');?></td>
                                    <td width="100%" align="left" valign="top" bgcolor="" class="red"><table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0"  bordercolor="#111111">
                                      <tr>
                                        <td height="57" colspan="2" align="left"  valign="middle" class="head_ing">Manage Search Page Advertise</td>
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
	  	<form name="search_product" method="post" action="view_images.php?action=search_product">
			<table width="95%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
			<?php if($result > 0) { ?>
			<tr align="right"  bgcolor="#5b6c0c">
            	<td height="" colspan="10" bgcolor="#FFFFFF" class="red">&nbsp;
                              <?php /*include("paging/no_of_records.inc.php");*/ ?>
				</td>
            </tr>
			<?php }?>
											 

										 <tr align="center"  bgcolor="#3c7701">									
											<?php if($result > 0) { ?>
                                                                                    
                                          <td width="22%" class="white">Image</td>
                                          <td width="16%" class="white">Display Image</td>
                                         <td width="16%" class="white">Image Alt</td>
                                         <td width="8%" class="white">Order</td>
                                           <!-- <td width="12%" bgcolor="#FFFFFF"><div align="center">
                        <div align="center">
                          <div align="center"><b>Detail</b></div>
                        </div>
                      </div></td> -->
                                              <!--  <td width="62%" align="left" bgcolor="#FFFFFF"><b>Newsletter 
                        Detail </b></td> -->
                                              <!--  <TD width="43%"><div align="center"><B>Description</B></div></TD> -->
                                         <td width="8%" class="white">Edit</td>
                                            <td width="11%" class="white">Delete</td>
                      </tr>
                                          <!----------------------Start your loop------------------------------->
                                          <?php
			  while($row_product=mysql_fetch_array($sql))
                 {
					 $image_name=$row_product['team_name'];
												
											$image_folder	=	"teams/thumb1/";
											$product_image	=	$row_product['team_name'];
											$image_path		=	$image_folder.$product_image;
									
											if(!file_exists($image_path)){
												$book_image	="image_not_found.jpg";
												$image_path		=	$image_folder.$book_image;
											}
				?>
                                           <tr align="center">	
                                            
                                            <td width="22%" height="57" bgcolor="#FFFFFF">
											<img src="<?php echo $image_path;?>" style="border: solid 0px #98a754;"  alt="<?php echo $row_product['team_name']?>" >
											</td>
                               <td width="16%"  bgcolor="#FFFFFF"><?php echo $row_product['header_heading'];?></td>
                                            <td width="16%"  bgcolor="#FFFFFF">
                                                <?php echo $row_product['header_description'];?>                                            </td>
                                            <td width="8%"  bgcolor="#FFFFFF">1</td>
                                            <td width="8%"  bgcolor="#FFFFFF"><a href="add_new_search_page_ad.php?action=edit&image_id=<?php echo $row_product['header_id']?>&image_name=<?php echo $row_product['team_name']?>"> <img src="images/Edit.gif" width="12" height="12" alt="Edit"   border="0" /></a></td>
                                            <td width="11%"   bgcolor="#FFFFFF"><a href="main-slider.php?action=delete&image_id=<?php echo $row_product['header_id']?>&image_name=<?php echo $row_product['team_name']?>"  onClick=" javascript: return confirm('Are you sure You want to delete the image ');"><img src="images/del.gif" width="12" height="10" border="0" /></a> </td>
                                          </tr>
                                          <?php }
											}else{
											?>
                                          <tr>
                                            <td  height="29" colspan="10" align="center" bgcolor="#ffffff" class="head_ing">No Header Image Exists !</td>
                                          </tr>
                                          <?php }										  
										   ################################?>
                                          
                                          
                                          
                                          
                                          
                                          <!-- this code will show paging in the . When record s are more -->
									<?php if($nume >$limit){ ?>
									
										<?php }?>   
									<!-- End Paging Code -->	
									
									<!-- Paging starts here  -->
									<?php include("paging/paging_row.inc.php") ?> 
									<!-- Paging ends starts here  -->	
                                          
                                          
                                          
                                          
                                          
                                          <tr>
                                            <td  height="33" colspan="10" align="center" bgcolor="#3c7701"><input name="add" type="button" value="Add new Record"  onClick="navigate('add_new_team.php');" /></td>
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
<script language="JavaScript" type="text/JavaScript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function navigate(file_name){
window.location	= file_name;	
//alert(file_name);
}

function paging_function(file_name,start){
document.search_product.action=file_name+"?action=search_product&start="+start;
document.search_product.submit();
}

function set_page_limit(records){
document.search_product.action="<?php echo $file_name?>?action=search_product&per_page="+records;
document.search_product.submit();
}
function paging_function(file_name,start){
document.search_product.action=file_name+"?action=search_product&start="+start;
document.search_product.submit();
}
</script>