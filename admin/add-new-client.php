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
                                    <td width="100%" align="center" valign="top" bgcolor="" class="red"><form action="" method="get">
                                    <table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0"  bordercolor="#000000">
                                      <tr>
                                        <td valign="middle" height="20"  align="left"><table width="767" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              
                      <td width="399" height="57" class="head_ing"> 
                       
                        Add New Client</td>
                                              <td width="368"  align="right">&nbsp;</td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td bordercolor="#FFFFFF"  valign="top" align="center"><table width="100%" border="0" cellspacing="4" cellpadding="0">
                                              
                                              <tr>	
                                              <td valign="top" >
                                              
                                             <div class="supp-con1">
        <div class="supp-left">
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Name</div>
             <div class="supplier-panel-right"><input name="name" type="text" class="field" id="name" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company Name</div>
             <div class="supplier-panel-right"><input name="company" type="text" class="field" id="company" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Email Id</div>
             <div class="supplier-panel-right"><input name="email" type="text" class="field" id="email" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Website (If any)</div>
             <div class="supplier-panel-right"><input name="website" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Mobile</div>
            <div class="supplier-panel-right"><input name="mobile" type="text" class="field" id="mobile" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company Address</div>
             <div class="supplier-panel-right"><input name="address" type="text" class="field" id="address" /></div>
          </div>
         <!-- <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Category</div>
             <div class="supplier-panel-right"><input name="category" type="text" class="field" /></div>
          </div>-->
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">User Name</div>
             <div class="supplier-panel-right"><input name="user_name" type="text" class="field" id="user_name" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Password</div>
             <div class="supplier-panel-right"><input name="passward" type="text" class="field" /></div>
          </div>
         
        </div>
        <div class="supp-right">
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">City</div>
             <div class="supplier-panel-right"><input name="city" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Zip Code</div>
             <div class="supplier-panel-right"><input name="zipcode" type="text" class="field" id="zipcode" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">State</div>
             <div class="supplier-panel-right"><input name="state" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company PanCard</div>
             <div class="supplier-panel-right"><input name="pancard" type="text" class="field" id="pancard" /></div>
          </div>
          <!--<div class="supplier-panel-bg">
             <div class="supplier-panel-left">Gumasta Licence</div>
            <div class="supplier-panel-right"><input name="Attachment[]" type="file"  id="Attachment[]" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company if Registered</div>
             <div class="supplier-panel-right"><input name="Attachment[]" type="file"  id="Attachment[]" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company is in Partnership<br />
             or Propertier</div>
             <div class="supplier-panel-right"><input name="Attachment[]" type="file"  id="Attachment[]" /></div>
          </div>-->
         <!-- <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Make Payment Online</div>
             <div class="supplier-panel-right"><input name="make-payment-online" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Choose Currency</div>
             <div class="supplier-panel-right">
                <span>
                         <select name="Property_Category" class="sell4">                   
                         <option class="boldclass" >All Residential</option>
						 <option class="" value="Residential_Apartment">Residential Apartment</option>
						 <option class="" value="Independent_House_Villa">Independent House/Villa</option>
						 <option class="" value="Residential_Land">Residential Land</option>
						 <option class="" value="Independent_Builder_Floor">Independent/Builder Floor</option>
						 <option class="" value="Farm_House">Farm House</option>
						 <option class="" value="Studio_Apartment">Studio Apartment</option>
						 <option class="" value="Serviced_Apartments">Serviced Apartments</option>
						 <option class="" value="RNew_Projects">New Projects</option>
						 <option class="" value="ROther">Other</option>
						 <option class="boldclass">All Commercial</option>
						 <option class="" value="Commercial_Shops">Commercial Shops</option>
						 <option class="" value="Commercial_Showrooms">Commercial Showrooms</option>
						 <option class="" value="Commercial_Office_Space">Commercial Office/Space</option>
						 <option class="" value="Commercial_Land_Inst_Land">Commercial Land/Inst. Land</option>
						 <option class="" value="Hotel_Resorts">Hotel/Resorts</option>
						 <option class="" value="Guest-House_Banquet-Halls">Guest-House/Banquet-Halls</option>
						 <option class="" value="Time_Share">Time Share</option>
						 <option class="" value="Space_in_Retail_Mall">Space in Retail Mall</option>
						 <option class="" value="Office_in_Business_Park">Office in Business Park</option>
						 <option class="" value="Office_in_IT_Park">Office in IT Park</option>
						 <option class="" value="Ware_House">Ware House</option>
						 <option class="" value="Cold_Storage">Cold Storage</option>
						 <option class="" value="Factory">Factory</option>
						 <option class="" value="Manufacturing">Manufacturing</option>
						 <option class="" value="Business_center">Business center</option>
						 <option class="" value="CNew_Projects">New Projects</option>
						 <option class="" value="COther">Other</option>
						 <optgroup label='Land'  class='boldclass' ></optgroup>
						 <option class="" value="Residential_Land">Residential Land</option>
						 <option class="" value="Agricultural_Farm_Land">Agricultural/Farm Land</option>
						 <option class="" value="Commercial_Land_Inst_Land">Commercial Land/Inst. Land</option>
						 <option class="" value="Industrial Lands_Plots">Industrial Lands/Plots</option>
					</select>
                         </span>
             </div>
          </div>-->
          
        </div>
      </div>
		
        
        </td>
    </tr>
    </table></td>
    </tr>
    <tr>
      <td align="center">
         <input name="Add Client" type="button" value="Add Client">
      </td>
    </tr>
    </table>
                                    </form></td>
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