<?php 
session_start();
if(!isset($_SESSION['login']))
{
	header('Location: index.php');
	exit;
}

include_once '../DBUtil.php';
include_once '../Util.php';

$dbObj = new DBUtil();
if(!empty($_POST)) {
	$uploadOk = -1;
	
	$check = getimagesize($_FILES["image"]["tmp_name"]);
	if($check !== false) {
		//echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		//echo "File is not an image.";
		$uploadOk = 0;
	}
	
	$target_dir = UPLOAD_IMAGE_DIR;
	$image = date('Ymd_Hms') . "_" . basename($_FILES["image"]["name"]);
	$target_file = $target_dir . $image;
	
	if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
		//echo "File is valid, and was successfully uploaded.\n";
	} else {
// 		/echo "Possible file upload attack!\n";
	}
	
	
	if($uploadOk == 1) {
		$id = $dbObj->addEditProduct($_POST['prod_name'], $_POST['category'], $_POST['desc'], $_POST['TOS'], $_POST['min_price'],$_POST['max_price'], $_POST['min_quantity'], 
				$_POST['max_quantity'],$_POST['stock_availability'], $_POST['supplier_id'], $image ,
				$_POST['order_range'], $_POST['supply_ability'], $_POST['home_delivery'],$_POST['quntity_type'],$_POST['prod_id']);
		
		$uri = "manage-product.php?supplier_id=" . $_POST['supplier_id'] . "&category=" . $_POST['category'];
		header("Location: $uri");
	} else {
		//image could not be uploaded
	}
}

if(!empty($_REQUEST['prod_id'])) {
	$arrParam = array('prod_id' => $_REQUEST['prod_id']);
	$arrProduct = $dbObj->getProducts($arrParam);
	$arrProduct = $arrProduct[0];
}
$arrParent = Util::getCategoryList();
//print_r($arrProduct);
?>
<html>
<head>
<title>:::(Admin Panel) :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
<script src="../js/jquery-1.6.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="js/admin.js"></script>
<script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

<script language="JavaScript">
	function valid(form) {
		if(form.prod_name.value == '') {
			alert("Please enter Product Name");
			return false;
		}
		if(form.min_price.value == '') {
			alert("Please enter Min. Product Price");
			return false;
		}
		if(form.max_price.value == '') {
			alert("Please enter Max. Product Price");
			return false;
		}
		if(form.min_quantity.value == '') {
			alert("Please enter Product Order Min Quantity");
			return false;
		}
		if(form.max_quantity.value == '') {
			alert("Please enter Product Order Max Quantity");
			return false;
		}	

		if(form.desc.value == '') {
			alert("Please enter Product Description");
			return false;
		}
		
		if(form.category.value == 0) {
			alert("Please select product category");
			return false;
		}
		return true;
	}

</script>
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
                       
                        Add / Edit Product</td>
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
		<form action="" enctype="multipart/form-data"  onsubmit ="return valid(this);" method="post" name="header" id="header">
 <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<?php if(isset($_REQUEST['message'])){?>
 <tr align="center" bgcolor="#2F87E8" >
   <td height="25" colspan="2" align="center" bgcolor="#7D4B00" class="white"><?php echo $_REQUEST['message'];?></td>
 </tr>
<?php }?>
 <tr align="center" bgcolor="#7D4B00" >
   <td height="25" colspan="2" align="center" bgcolor="#3c7701">
     <div class="white">Add / Edit Product</div></td>
 </tr>
    <tr align="center" bgcolor="#FFFFFF">
      <td>
         <div class="supp-left1">
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">&nbsp;</div>
             <div class="supplier-panel-right1"> 
        <input type="file" name="image" style="width:200px" >
        </div>
          </div>
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Product Name</div>
             <div class="supplier-panel-right1"><input name="prod_name" type="text" class="field" value="<?php echo $arrProduct['prod_name']?>" />
             	<input type="hidden" name="prod_id" value="<?php echo $arrProduct['prod_id']?>">
				<input type="hidden" name="supplier_id" value="<?php echo $_REQUEST['supplier_id']?>">
             	</div>
          </div>
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Min. Price</div>
             <div class="supplier-panel-right1"><input name="min_price" type="text" class="field" value="<?php echo $arrProduct['min_price']?>" /></div>
          </div>
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Max. Price</div>
             <div class="supplier-panel-right1"><input name="max_price" type="text" class="field" value="<?php echo $arrProduct['max_price']?>" /></div>
          </div>
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Min Quantity</div>
             <div class="supplier-panel-right1"><input name="min_quantity" type="text" class="field" value="<?php echo $arrProduct['min_quantity']?>" /></div>
          </div>
          
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Max Quantity</div>
             <div class="supplier-panel-right1"><input name="max_quantity" type="text" class="field" value="<?php echo $arrProduct['max_quantity']?>" /></div>
          </div>
          
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Quantity Type</div>
             <div class="supplier-panel-right1">
             
             	<select name="quntity_type">
             		<option>Peice</option>
             		<option>Peices</option>
             		<option>Pack</option>
             		<option>Packs</option>
             		<option>Dosen</option>
             	</select>
             </div>
          </div>
          
          
         <!--  <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Upload Related Product</div>
            <div class="supplier-panel-right1"><input type="file" name="image" style="width:200px" >
        </div> -->
        
          <!-- <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Order Range</div>
             <div class="supplier-panel-right1"><input name="order_range" type="text" class="field" value="<?php echo $arrProduct['order_range']?>" /></div>
          </div> -->
  
          <!-- <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Supply Ability</div>
             <div class="supplier-panel-right1"><input name="supply_ability" type="text" class="field" value="<?php echo $arrProduct['supply_ability']?>" /></div>
          </div> -->
  
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Home Delivery</div>
             <div class="supplier-panel-right1"><input name="home_delivery" type="text" class="field" value="<?php echo $arrProduct['home_delivery']?>" /></div>
          </div>
  
           
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Description</div>
             <div class="supplier-panel-right1"><textarea name="desc" id="case_study" cols="80" rows="10" style="width:750px;"><?php echo $arrProduct['desc']?></textarea></div>
          </div>
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Terms</div>
             <div class="supplier-panel-right1"><textarea name="TOS" cols="42" rows="" style="width:750px; height:100px;"><?php echo $arrProduct['TOS']?></textarea></div>
          </div>
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Category</div>
             <div class="supplier-panel-right1">
	             <select id="category" name="category">
	             	<option value="0">-SELECT-</option>
	                   	<?php foreach ($arrParent as $parent => $arrSubCat) { ?>
	             	<optgroup label="<?php echo $parent?>">
	             	<?php foreach ($arrSubCat as $id => $name) {  
	             		$selected = "";
	             		if($arrProduct['category'] == $id) { $selected = "selected='selected'"; }?>
	             	
	             		<option <?php echo $selected?> value="<?php echo $id?>"><?php echo $name?></option>
	             	<?php } ?>
	             	</optgroup>
	             	<?php }	?>
	             	</select>
             		
             </div>
             </div>
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Stock Availibility</div>
             <div class="supplier-panel-right1"><select name="stock_availability">
             	<option>Yes</option>
             	<option>No</option>
             </select>
             
             </div>
          </div>
          </div>
         <br/><br/>
        </div>
      </td>
    </tr>
    <tr bgcolor="#7D4B00">
                                                        <!--  <td height="25%" align="right" valign="top"  >&nbsp;</td> -->
    	<td height="33" colspan="5" align="center" bgcolor="#3c7701"><input name="submit" type="submit" value="Submit"/>
    	  
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
