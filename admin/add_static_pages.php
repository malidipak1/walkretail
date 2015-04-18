<?php 
include_once 'access_check.php';
include("database.inc.php");
include("thumb.php");

$sql      =  mysql_query("select * from categories where parent_id='0'");
$result   =  mysql_num_rows($sql);
$button_value		=	"INSERT";
$form_action		=	"insert";

$image_id				= "";
$image_detail			= ""; 
$image_name				= "";
$image_heading			= "";
$featured				= "";

#################################   INSERT    #########################################
if(isset($_REQUEST['action']) && $_REQUEST['action']=='insert')
{
  echo $image_name	=	$_FILES['image']['name'];exit;
  $dir			=	"header_images/";
  $image1		=	$dir.$image_name;
  
  $sql="SELECT * from header_image WHERE header_image_name ='".$image_name."' ";
  $result=mysql_query($sql);
  $row=mysql_num_rows($result);
  
		 if(file_exists($image1))
		 {
			 header('location:add_static_pages.php?message=Image Already Exists');
			 exit;
		 }
		move_uploaded_file($_FILES['image']['tmp_name'], $image1);
  		
		$thumb_image_name='header_images/'.$image_name;
        $th11='header_images/thumb1/'.$image_name;
        $th22='header_images/thumb2/'.$image_name;

    	createthumb11($thumb_image_name, $th11,320,414);
		createthumb11($thumb_image_name, $th22,1000,250);
		############################################################	 
		
		$sq2="INSERT INTO header_image VALUES('','".addslashes(ucfirst($_REQUEST['header_heading']))."','".addslashes($image_name)."','".addslashes(ucfirst($_REQUEST['image_detail']))."','".$_SERVER['REMOTE_ADDR']."','".$_REQUEST['featured']."')";
		mysql_query($sq2);
		header("location:view_header_images.php?action=search_product&message=Image added sucessfully");
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
$sql_edit				=	mysql_query("select  * from header_image where header_id='".$_REQUEST['image_id']."' ");
$result_edit			=	mysql_num_rows($sql_edit);
$row_edit 				=	mysql_fetch_array($sql_edit);
$image_id				=  $row_edit['header_id'];
$image_heading			=  $row_edit['header_heading'];
$image_detail			=  $row_edit['header_description'];
$header_image_name		=  $row_edit['header_image_name'];
$featured				=  $row_edit['featured'];

##########################################################################
}

#################################  	END	  #########################################


#################################   UPDATE    #########################################
if(isset($_REQUEST['action']) && $_REQUEST['action']=='update')
{
$form_action		=	"update";
$button_value		=	"Update";

$old_image_name		=	$_REQUEST['old_image_name'];
$dir				=	"header_images/";
$old_image			=	$dir.$old_image_name;

$image_name			=	$_FILES['image']['name'];

if($image_name=='')
{
$dir				=	"header_images/";
$image1				=	$dir.$image_name;

$image_name			=	$_REQUEST['hidden_image'];
}else{

unlink("header_images/".$_REQUEST['hidden_image']);
unlink("header_images/thumb1/".$_REQUEST['hidden_image']);
unlink("header_images/thumb2/".$_REQUEST['hidden_image']);

$dir			=	"header_images/";
$image1			=	$dir.$image_name;

if(file_exists($image1)){
}else{
	move_uploaded_file($_FILES['image']['tmp_name'], $image1);
	$thumb_image_name='header_images/'.$image_name;
	$th11='header_images/thumb1/'.$image_name;
	$th22='header_images/thumb2/'.$image_name;	
	createthumb11($thumb_image_name, $th11,320,414);
	createthumb11($thumb_image_name, $th22,1000,250);
	}
}
###################################################################	 
$sql	=	"UPDATE header_image SET header_heading='".$_REQUEST['header_heading']."' , header_description='".$_REQUEST['image_detail']."',header_image_name='$image_name',ip_address='".$_SERVER['REMOTE_ADDR']."', featured='".$_REQUEST['featured']."' where header_id='".$_REQUEST['image_id']."'";
mysql_query($sql);

header("location:view_header_images.php?message=Image updated successfully");
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
<script language="javascript" src="ajax_js.js"></script>
<script language="javascript">
function validate()
{
	var doc=document.form1;
	if(doc.txtcat.value=="")
	{
			alert("Please enter Sub category name.");
			doc.txtcat.focus();
			return false;
	}
}
</script>
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
                       
                        Manage Lookbook</td>
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
		<form action="add_static_page.php?action=<?php echo $form_action; ?>" enctype="multipart/form-data"  onsubmit ="return check_form();" method="post" name="header" id="header">
 <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<?php if(isset($_REQUEST['message'])){?>
 <tr align="center" bgcolor="#2F87E8" >
   <td height="25" colspan="2" align="center" bgcolor="#7D4B00" class="white"><?php echo $_REQUEST['message'];?></td>
 </tr>
<?php }?>
 <tr align="center" bgcolor="#7D4B00" >
   <td height="25" colspan="2" align="center" bgcolor="#3270B4">
     <div class="white">Add Image</div></td>
 </tr>
 
 <?php if($result>0)
{
$flag=1;
?>
                  <tr bgcolor="#FFFFFF">
              <td height="40" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Category</strong><strong> :</strong>
                        <?php $i=1; ?></td>
                    <td width="64%" colspan="-2" align="left" nowrap="nowrap"><?php if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit'){ echo "<b>".$_REQUEST['path']."</br>"; }else { ?><select id="<?php echo 'cat'.$i;?>" name="<?php echo 'cat'.$i;?>" onChange="chk_str(this.value,1);">
                        <option value="">--Select Category--</option>
     <?php 
     while($row =mysql_fetch_array($sql))
                    {?>
                        <option value="<?php echo $row['catid'];?>"> <?php echo ucfirst($row['catname']);?></option>
                        <?php } ?>
                      </select>
                        <input name="categ" type="hidden" id="categ" /><?php } ?></td>
                  </tr>
                <?php if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit'){}else { ?>  
                  <tr align="center" bgcolor="#FFFFFF" >
                    <td height="25" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Sub Category : </strong></td>
                    <td height="30" colspan="-2" align="left" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF" ><div id="subcate" style="vertical-align:middle">
                        <div id="txtHint1" class="red">Select categories to get its sub categories <br>
                        </div>
                    </div></td>
                  </tr>
                                  <?php }} ?>
    <tr align="center" bgcolor="#FFFFFF">
      <td width="18%" height="33" align="left" valign="middle">Image</td>
      <td width="82%"  align="left">
        <?php if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit'){?>
        <img src="header_images/thumb1/<?php echo $header_image_name;?>"> 
        <?php }?>
        <input type="file" name="image" style="width:200px" >
        <input type="hidden" name="hidden_image" value="<?php echo $header_image_name;?>"></td>
    </tr>
    <tr align="center" bgcolor="#FFFFFF" valign="top">
      <td height="33" align="left" valign="top">Alt</td>
      <td  align="left"><input type="text" name="header_heading" id="header_heading" value="<?php echo $image_heading;?>"></td>
    </tr>
    <tr align="center" bgcolor="#FFFFFF" valign="top">
      <td height="33" align="left" valign="top">Show</td>
      <td  align="left"><input name="featured" type="radio" id="radio" value="yes" checked <?php if($featured=='yes'){ echo "checked"; } ?>>
        Yes 
          <input type="radio" name="featured" id="radio2" value="no" <?php if($featured=='no'){ echo "checked"; } ?>>
          No</td>
    </tr>
    <tr align="center" bgcolor="#FFFFFF" valign="top">
      <td height="33" align="left" valign="top">Title</td>
      <td  align="left"><input name="image_detail" type="text" id="image_detail" value="<?php echo $image_detail;?>"></td>
    </tr>
    <tr bgcolor="#7D4B00">
                                                        <!--  <td height="25%" align="right" valign="top"  >&nbsp;</td> -->
    	<td height="33" colspan="5" align="center" bgcolor="#3270B4"><input name="submit" type="submit" value="<?php echo $button_value;?>"/>
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
<script language="JavaScript" type="text/JavaScript">
function set_page_limit(records)
{
	document.search_product.action="<?php echo $file_name?>?action=search_product&per_page="+records;
	document.search_product.submit();
}
</script>