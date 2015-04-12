<?php
include("database.inc.php"); //database.inc.php is databse connection file which will be included
session_start();  
error_reporting(~E_ALL);
// this condition will check whether the admin has logged in or not 
// if he has not logged in or session has expired it will take you at the login page(index.php)
if(!isset($_SESSION['login']))   
   {							
     header('Location: index.php');
	 exit;
   }
###########################################  PAGING WITH PER PAGE            #####################################
$file_name			=	"category.php"; // this is file name which is used during paging  , included at the bottom of the page
$paging_table_name	=	"category";

include("paging/paging_query.inc.php");

############################################ END PAGING WITH PER PAGE       ##############################################

$sql=mysql_query("select * from category ORDER BY category_name LIMIT $eu, $limit");
$result=mysql_num_rows($sql);

#################################   DELETE    #########################################
// when we click on delete this area of php code will be executed
if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{

$_REQUEST['category_id'];

	$sql=mysql_query("delete from category where category_id = '".$_REQUEST['category_id']."' ");
	$sq2l=mysql_query("delete from books where book_category_id = '".$_REQUEST['category_id']."' ");
	header("location:category.php?message=Category deleted sucessfully");
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='display')
{
		if($_REQUEST['val']=="yes")
		{
			$sql=mysql_query("UPDATE category SET category_show='no' WHERE category_id='".$_REQUEST['category_id']."' ");
		}
		else
		{
			$sql=mysql_query("UPDATE category SET category_show='yes' WHERE category_id='".$_REQUEST['category_id']."' ");
		}
	$url="location:category.php?message=Updated sucessfully";
	header($url);
}
#################################  END DELETE    #########################################

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
	<td width="100%" align="center" valign="top" bgcolor="" class="red">
		<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0"  bordercolor="#000000">
	   		<tr>
				<td valign="middle" height="20"  align="left">
				 	<table width="998" border="0" cellspacing="0" cellpadding="0">
        	        	<tr>
							<td width="399" height="57" class="head_ing">Manage Menus</td>
                            <td width="592"  align="right" class="red">&nbsp;<?php include("paging/no_of_records.inc.php"); ?></td>
                        </tr>
                     </table>
				 </td>
             </tr>
			 <tr>
			 	<td bordercolor="#FFFFFF"  valign="top" align="center">
					<table width="100%" border="0" cellspacing="4" cellpadding="0">
			 			<tr>
							<td  align="center" class="red"></td>
						</tr>
						<?php if(isset($_REQUEST['message']) && $_REQUEST['message']!=''){ ?>
						<tr>
							<td  align="center" class="red"><?php echo $_REQUEST['message'];?></td>
						</tr>
						 <?php }?>		
						<tr>
							<td align="center" valign="top" >
							<form action="add_new_category.php" method="post" name="form1" id="form1">
								 <table width="60%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
									 
									 <?php if($result>0){?>
		 
									 <tr align="center" bgcolor="#3c7701" >
										 <td width="39%" class="white">
										  Category name
									  </td>
								       <td width="12%" class="white">Show</td>		
										<td width="12%" class="white">
										  Edit
							         </td>														
									    <td width="14%" class="white">
									      <b>Delete</b>
								       </td>
									 </tr>
									 	<?php 
										while($row =mysql_fetch_array($sql))
											{ ?>
							        
						          <tr align="center" bgcolor="#f5f5f5">
								    	<td height="33" align="left" bgcolor="#FFFFFF">
																		    	 
								    	<?php echo ucfirst($row['category_name'])?>					    	          </td>
								    	<td width="12%" align="center" bgcolor="#FFFFFF">
                                        <a href="category.php?action=display&category_id=<?php echo $row['category_id']?>&val=<?php echo $row['category_show']?>"  ><?php echo ucfirst($row['category_show'])?></a></td>
										<td width="12%"  align="center" bgcolor="#FFFFFF">
											<a href="add_new_category.php?action=edit&category_id=<?php echo $row['category_id'];?>">
								      <img src="images/Edit.gif" border="0" /></a> </td>
								        <td width="14%"  align="center" bgcolor="#FFFFFF">
											<a href="category.php?action=delete&category_id=<?php echo $row['category_id']?>"  onclick=" javascript:
											 return confirm('Are you sure! You want to delete this category ');">
									  <img src="images/del.gif" border="0" /></a></td>
								    </tr>
  		<?php  ###############################   end of city coding  ##############################
										}
									}else {?>
                                    
                                    
                                    <tr align="center" bgcolor="#f5f5f5">
								          <td height="33" colspan="4" align="center" bgcolor="#FFFFFF" class="head_ing">No category exist</td>
						           </tr>
                                    <?php } ?>
									<!-- this code will show paging in the . When record s are more -->
									<?php if($nume >$limit){ ?>
									
										<?php }?>   
									<!-- End Paging Code -->	
									
									<!-- Paging starts here  -->
									<?php include("paging/paging_row.inc.php") ?> 
									<!-- Paging ends starts here  -->	
									<tr bgcolor="#FFFFFF">
										<!--  <td height="25%" align="right" valign="top"  >&nbsp;</td> -->
								    	<td height="33" colspan="7" align="center" bgcolor="#3c7701"><input name="add" type="submit" value="Add Category"/>
							    	    </td>
								    </tr>
						    </table>
					    </form>
					</td>
			    </tr>
		    </table>
		</td>
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
