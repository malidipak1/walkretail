<?php 
include("database.inc.php");
include("thumb.php");
session_start();
if(!isset($_SESSION['login']))
{
	header('Location: index.php');
	exit;
}

$form_action="insert";
$button_value="INSERT";

$image_id				= "";
$image_detail			= ""; 
$image_name				= "";
$image_heading			= "";

#################################   INSERT    #########################################
if(isset($_REQUEST['action']) && $_REQUEST['action']=='insert')
{
  $image_name	=	$_FILES['image']['name'];
  $dir			=	"teams/";
  $image1		=	$dir.$image_name;
  
  $sql="SELECT * from team WHERE team_name ='".$image_name."' ";
  $result=mysql_query($sql);
  $row=mysql_num_rows($result);
  
		 if(file_exists($image1))
		 {
			 header('location:add_new_team.php?message=Image Already Exists');
			 exit;
		 }
		move_uploaded_file($_FILES['image']['tmp_name'], $image1);
  		
		$thumb_image_name='teams/'.$image_name;
        $th11='teams/thumb1/'.$image_name;
        $th22='teams/thumb2/'.$image_name;

    	createthumb11($thumb_image_name, $th11,100,100);
		createthumb11($thumb_image_name, $th22,454,266);
		############################################################	 
		
		$sq2="INSERT INTO team VALUES('','".addslashes(ucfirst($_REQUEST['header_heading']))."','".addslashes($image_name)."','".addslashes(ucfirst($_REQUEST['image_detail']))."','".$_SERVER['REMOTE_ADDR']."')";
		mysql_query($sq2);
		header("location:view_teams.php?action=search_product&message=Image added sucessfully");
		exit();	
}
#################################      END INSERT    #########################################

#################################      EDIT         #########################################
if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit')
{
	if(isset($_REQUEST['image_name']) && $_REQUEST['image_name']!=''){
		$image_name=$_REQUEST['image_name'];
		$form_action="update&old_image_name=$image_name";
	}else{
		$form_action="update";
	}

$button_value="Update";
$sql_edit				=	mysql_query("select  * from team where header_id='".$_REQUEST['image_id']."' ");
$result_edit			=	mysql_num_rows($sql_edit);
$row_edit 				=	mysql_fetch_array($sql_edit);
$image_id				=  $row_edit['header_id'];
$image_heading			=  $row_edit['header_heading'];
$image_detail			=  $row_edit['header_description'];
$team_name		=  $row_edit['team_name'];

##########################################################################
}

#################################  	END	  #########################################


#################################   UPDATE    #########################################
if(isset($_REQUEST['action']) && $_REQUEST['action']=='update')
{
$form_action		=	"update";
$button_value		=	"Update";

$old_image_name		=	$_REQUEST['old_image_name'];
$dir				=	"teams/";
$old_image			=	$dir.$old_image_name;

$image_name			=	$_FILES['image']['name'];

if($image_name=='')
{
$dir				=	"teams/";
$image1				=	$dir.$image_name;

$image_name			=	$_REQUEST['hidden_image'];
}else{

unlink("teams/".$_REQUEST['hidden_image']);
unlink("teams/thumb1/".$_REQUEST['hidden_image']);
unlink("teams/thumb2/".$_REQUEST['hidden_image']);

$dir			=	"teams/";
$image1			=	$dir.$image_name;

if(file_exists($image1)){
}else{
	move_uploaded_file($_FILES['image']['tmp_name'], $image1);
	$thumb_image_name='teams/'.$image_name;
	$th11='teams/thumb1/'.$image_name;
	$th22='teams/thumb2/'.$image_name;	
	createthumb11($thumb_image_name, $th11,100,100);
	createthumb11($thumb_image_name, $th22,454,266);
	}
				
}
###################################################################	 
$sql	=	"UPDATE team SET header_heading='".$_REQUEST['header_heading']."' , header_description='".$_REQUEST['image_detail']."',team_name='$image_name',ip_address='".$_SERVER['REMOTE_ADDR']."' where header_id='".$_REQUEST['image_id']."'";
mysql_query($sql);
header("location:view_teams.php?message=Image updated successfully");
exit();
}

#################################  END update    #########################################
/*echo "<pre>";
echo count($result);
var_dump($result);*/
//echo $result['country_id'];
?>
<html>
<head>
<title>:::(Admin Panel) :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">

<script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<?php include("common_tinymce.php");?>
</head>
<body>
<table width="100%" height="100%" align="center" cellpadding="0" cellspacing="0"  bordercolor="#5181BF">
  <tr>
    <td height="92"><?php include('head.php');?></td>
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
                       
                        Add New Product Discription Advertise</td>
                                              <td width="368"  align="right">&nbsp;</td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td bordercolor="#FFFFFF"  valign="top" align="center"><table width="100%" border="0" cellspacing="4" cellpadding="0">
                                              <tr>
                                                <td  align="center" class="red">
                                              </tr>
                                              <tr>	<td align="center" valign="top" >
		<form action="add_new_slider.php?action=<?php echo $form_action; ?>" enctype="multipart/form-data"  onsubmit ="return check_form();" method="post" name="header" id="header">
 <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<?php if(isset($_REQUEST['message'])){?>
 <tr align="center" bgcolor="#2F87E8" >
   <td height="25" colspan="2" align="center" bgcolor="#7D4B00" class="white"><?php echo $_REQUEST['message'];?></td>
 </tr>
<?php }?>
 <tr align="center" bgcolor="#7D4B00" >
   <td height="25" colspan="2" align="center" bgcolor="#3c7701">
     <div class="white">Add Image</div></td>
 </tr>
    <tr align="center" bgcolor="#FFFFFF">
      <td width="18%" height="33" align="left" valign="middle">Image</td>
      <td width="82%"  align="left">
        <?php if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit'){?>
        <img src="teams/thumb1/<?php echo $team_name;?>"> 
        <?php }?>
        <input type="file" name="image" style="width:200px" >
        <input type="hidden" name="hidden_image" value="<?php echo $team_name;?>"></td>
    </tr>
    <tr align="center" bgcolor="#FFFFFF" valign="top">
      <td height="33" align="left" valign="top">Image Heading</td>
      <td  align="left"><input type="text" name="header_heading" id="header_heading" value="<?php echo $image_heading;?>"></td>
    </tr>
   
   
    <tr align="center" bgcolor="#FFFFFF" valign="top">
      <td height="33" align="left" valign="top">Price</td>
      <td  align="left"><input name="Price" type="text" value="Price"></td>
    </tr>
    
     <tr align="center" bgcolor="#FFFFFF" valign="top">
      <td height="33" align="left" valign="top">Url</td>
      <td  align="left"><input name="url" type="text" value="url"></td>
    </tr>
     <tr align="center" bgcolor="#FFFFFF" valign="top">
      <td height="33" align="left" valign="top">Order Range</td>
      <td  align="left"><input name="order-range" type="text" value="Order Range"></td>
    </tr>
     <tr align="center" bgcolor="#FFFFFF" valign="top">
      <td height="33" align="left" valign="top">Order</td>
      <td  align="left"><input name="Order" type="text" value="Order"></td>
    </tr>
    <tr bgcolor="#7D4B00">
                                                        <!--  <td height="25%" align="right" valign="top"  >&nbsp;</td> -->
    	<td height="33" colspan="5" align="center" bgcolor="#3c7701"><input name="submit" type="submit" value="<?php echo $button_value;?>"/>
    	  <input type="hidden" name="image_id" value="<?php echo $image_id?>">
    	  </td>
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
	
}

</script>