<?php 
include_once 'access_check.php';
include("database.inc.php");    		// database.inc.php is databse connection file which will be included 

$form_action	=	"insert"; 			
$button_value	=	"INSERT"; 
$form_title		=	"Add New Category";

$category_name	=	"";
$category_show	=	"";
$category_city	=	"";
$category_location	=	"";

#################################   INSERT    #########################################
// when admin clicks on insert this area of php code will execute 
if(isset($_REQUEST['action']) && $_REQUEST['action']=='insert')
{

$sql=mysql_query("select * FROM category WHERE category_name='".$_REQUEST['category_name']."' ");
$result=mysql_num_rows($sql);
if($result > 0)     
{
	header('location:add_new_category.php?message=Category name already exists');
}
else{
	addslashes(ucfirst($_REQUEST['category_name']));
	$sq2=mysql_query("INSERT INTO category VALUES('','".addslashes(ucfirst($_REQUEST['category_name']))."','".$_REQUEST['category_show']."','".$_REQUEST['city']."','".$_REQUEST['location']."') ");
	header('location:category.php?message=Category added sucessfully');
	exit();
}
}
#################################      END INSERT    #########################################

#################################      EDIT         #########################################
// when admin clicks on EDIT on city pager this area of php code will execute 

if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit')
{
$form_action	=	"update";       
$button_value	=	"Update";		
$form_title		=	"Update Category";

$sql			=	mysql_query("select * from category where category_id='".$_REQUEST['category_id']."' ");

$result			=	mysql_num_rows($sql);
$row 			=	mysql_fetch_array($sql);

$category_id	=	$_REQUEST['category_id'];
$category_name	=	$row['category_name'];
//$category_detail=	$row['category_detail'];
$category_show	=	$row['category_show'];
$category_city	=	$row['city'];
$category_location	=	$row['location'];
}
#################################  	END	  #########################################

#################################   UPDATE    #########################################
// when admin clicks on UPDATE this area of php code will execute 

if(isset($_REQUEST['action']) && $_REQUEST['action']=='update')
{
$form_action="update";
$button_value="Update";

$sql=mysql_query("UPDATE category SET category_name='".addslashes(ucfirst($_REQUEST['category_name']))."', category_show='".$_REQUEST['category_show']."', city='".$_REQUEST['city']."', location='".$_REQUEST['location']."' WHERE category_id='".$_REQUEST['category_id']."' ");
header("location:category.php?action=edit&category_id=".$_REQUEST['category_id']."&message=Category updated sucessfully");
}	

#################################  END update    #########################################
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
       <td width="182" align="left" valign="top" bgcolor="#D6E7F6" class="red" style="padding:0px; margin:0px;"><?php include('left_mnu.php');?></td>
                       <td width="100%" align="center" valign="top" bgcolor="" class="red"><table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0"  bordercolor="#000000">
                                      <tr>
                                        <td valign="middle" height="20"  align="left"><table width="767" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              
                      <td width="399" height="57" class="head_ing"> 
                       
                        Manage Menus</td>
                                              <td width="368"  align="right">&nbsp;</td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td bordercolor="#FFFFFF"  valign="top" align="center"><table width="99%" border="0" cellspacing="4" cellpadding="0">
                                              <tr>
                                              <td  align="center" class="red">                                              </tr>
                                              <tr>
                                                <td align="center" valign="top" ><form action="add_new_category.php?action=<?php echo $form_action; ?>" onsubmit ="return form_check();"method="post" name="category" id="category">
 <div align="center"></div>
 <table width="62%" border="0" align="center" cellpadding="3" cellspacing="1"  bgcolor="#CCCCCC">
 <?php if(isset($_REQUEST['message']) && $_REQUEST['message']!=''){ ?>
 <tr align="center" >
   <td height="25" colspan="2" align="center" class="red"><?php echo $_REQUEST['message'];?></td></tr><?php }?>
 <tr align="center" >
 <td height="25" colspan="2" align="left" bgcolor="#3270B4">
 <div class="white">
   <div align="center">Category</div>
 </div> <div class="white"></div></td>

    <tr align="left" bgcolor="#f5f5f5">
      <td width="33%" height="33" bgcolor="#FFFFFF"><span class="black ">Category Name </span></td>
      <td width="67%"   bgcolor="#FFFFFF">        <input name="category_name" type="text" id="category_name" value="<?php echo $category_name; ?>" style="width:200px;">
        <input type="hidden" name="category_id" id="category_id" value="<?php echo $_REQUEST['category_id']; ?>"></td>
    </tr>
    <tr  valign="top" bgcolor="#f5f5f5" align="left">
      <td height="33" bgcolor="#FFFFFF">City</td>
      <td  align="left" bgcolor="#FFFFFF">
      <select name="city" class="input1" id="city" onchange="getlocation(this.value)" >
                                                                               <option value="">--- Select ---</option>
                                                                               <?php
$sql_product		= 	"SELECT * FROM qualification ";
$result_product		=	mysql_query($sql_product);
$num_rows_product	=	mysql_num_rows($result_product);
 if($num_rows_product > 0) {
	 while($row_product=mysql_fetch_array($result_product))
                 {
																			   ?>
<option <?php if($category_city==$row_product['rightlink_id']) { echo " selected ";  } ?>value="<?php echo $row_product['rightlink_id']; ?>"><?php echo $row_product['rightlink_heading']; ?></option>
                                                                               
                                                                               <?php } } ?>
                                                                              
                              </select></td>
    </tr>
    <tr  valign="top" bgcolor="#f5f5f5" align="left">
      <td height="33" bgcolor="#FFFFFF">Location</td>
      <td  align="left" bgcolor="#FFFFFF"><div id='txthint'><select name="location" class="input1" id="location" >
      <option value="">--- Select ---</option>
      <?php
	  if($category_city!="")
	  {
$sql_product		= 	"SELECT * FROM courses where qualification_id=$category_city";
$result_product		=	mysql_query($sql_product);
$num_rows_product	=	mysql_num_rows($result_product);
 if($num_rows_product > 0) {
	 while($row_product=mysql_fetch_array($result_product))
                 {
																			   ?>
<option <?php if($category_location==$row_product['rightlink_id']) { echo " selected ";  } ?>value="<?php echo $row_product['rightlink_id']; ?>"><?php echo $row_product['course_name']; ?></option>
                                                                               
                                                                               <?php } } }  ?>
                                                                               
                                                                              
                             </select></div></td>
    </tr>
    <tr  valign="top" bgcolor="#f5f5f5" align="left">
      <td height="33" bgcolor="#FFFFFF"><span class="black ">Category Show </span></td>
      <td  align="left" bgcolor="#FFFFFF"><label for="category_show"></label>
        <!-- <input type="text" name="category_show" id="category_show" value="<?php //echo $category_show ?>">-->
        <select name="category_show" id="category_show">
          <option>---Select---</option>
          <option value="yes" selected <?php if($category_show=="yes") {echo "selected";} ?>>yes</option>
          <option<?php if($category_show=="no") {echo "selected";} ?> value="no">no</option>
          </select></td>
    </tr>
    <tr bgcolor="#FFFFFF">
                                                        <!--  <td height="25%" align="right" valign="top"  >&nbsp;</td> -->
    	<td height="33" colspan="5" align="center" bgcolor="#3270B4"><input name="add" type="submit" value="<?php echo $button_value;?>"/></td>
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
// this is javascript portion which is used for validating the forms at the user end   
function form_check()
{
	if(document.category.category_name.value==''){
	alert('Please enter category name');
	document.category.category_name.focus();
	return false;
	}
	else{
	return true;
	}
	    
}

function getlocation(str)
{
if (str=="")
  {
  document.getElementById("txthint").innerHTML="";
  return;
  }
  document.getElementById("txthint").innerHTML="<img src='images/loading.gif' height='18' width='18' />";
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		//alert(xmlhttp.responseText);
    document.getElementById("txthint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","get_location.php?q="+str,true);
xmlhttp.send();
}
</script>