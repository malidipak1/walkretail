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
	
	$id = $dbObj->addEditProduct($_POST['prod_name'], $_POST['category'], $_POST['desc'], $_POST['TOS'], $_POST['price'], $_POST['quantity'], $_POST['stock_availability'], $_POST['supplier_id'], $_POST['image'], $_POST['prod_id']);
	Util::redirect("", true);
}

if(!empty($_REQUEST['prod_id'])) {
	$arrParam = array('prod_id' => $_REQUEST['prod_id']);
	$arrProduct = $dbObj->getProducts();
	$arrProduct = $arrProduct[0];
}
$arrParent = Util::getCategoryList();
//print_r($arrParent);
?>
<html>
<head>
<title>:::(Admin Panel) :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
<script src="../js/jquery-1.6.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="js/admin.js"></script>
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
                       
                        Edit Product</td>
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
		<form action="" enctype="multipart/form-data"  onsubmit ="return check_form();" method="post" name="header" id="header">
 <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<?php if(isset($_REQUEST['message'])){?>
 <tr align="center" bgcolor="#2F87E8" >
   <td height="25" colspan="2" align="center" bgcolor="#7D4B00" class="white"><?php echo $_REQUEST['message'];?></td>
 </tr>
<?php }?>
 <tr align="center" bgcolor="#7D4B00" >
   <td height="25" colspan="2" align="center" bgcolor="#3c7701">
     <div class="white">Edit Product</div></td>
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
             </div>
          </div>
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Price</div>
             <div class="supplier-panel-right1"><input name="price" type="text" class="field" value="<?php echo $arrProduct['price']?>" /></div>
          </div>
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Quantity</div>
             <div class="supplier-panel-right1"><input name="quantity" type="text" class="field" value="<?php echo $arrProduct['quantity']?>" /></div>
          </div>
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Upload Related Product</div>
            <div class="supplier-panel-right1"><input type="file" name="image" style="width:200px" >
        </div>
          </div>
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Discription</div>
             <div class="supplier-panel-right1"><textarea name="desc" id="case_study" cols="80" rows="10" style="width:750px;"><?php echo $arrProduct['desc']?></textarea></div>
          </div>
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">TOS</div>
             <div class="supplier-panel-right1"><textarea name="TOS" cols="42" rows="" style="width:750px; height:100px;"><?php echo $arrProduct['TOS']?></textarea></div>
          </div>
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Category</div>
             <div class="supplier-panel-right1">
	             <select id="category" name="category">
	                   	<?php foreach ($arrParent as $parent => $arrSubCat) { ?>
	             	<optgroup label="<?php echo $parent?>">
	             	<?php foreach ($arrSubCat as $id => $name) {  ?>
	             		<option value="<?php echo $id?>"><?php echo $name?></option>
	             	<?php } ?>
	             	</optgroup>
	             	<?php }	?>
	             	</select>
             		
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
<script language="JavaScript">
function check_form()
{	
	
}

</script>