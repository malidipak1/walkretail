<?php
session_start();
error_reporting(~E_ALL);
if(!isset($_SESSION['login']))
   {
     header('Location: index.php');
	 exit;
   }
   include_once '../DBUtil.php';
   include_once '../Util.php';
   
   $dbObj = new DBUtil();
   $arrParam = array();
   if(!empty($_REQUEST['supplier_id'])) {
	   	$arrParam['supplier_id'] = $_REQUEST['supplier_id'];
	   	if(!empty($_REQUEST['category']))
	   		$arrParam['category'] = $_REQUEST['category'];
	   	$arrProduct = $dbObj->getProducts($arrParam );
   } 
   $arrParent = Util::getCategoryList();
//print_r($arrProduct );
 ?>
<html>
<head>
<title>:::(Admin Panel) :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/tabbed-style.css">
<script src="js/tabbed.js" type="text/javascript"></script>
<script src="js/tabbed-index.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="JavaScript">
	function myPopup(url)
	{
	    mywindow = window.open(url, "ProductDesc", "location=1,status=1,scrollbars=1,  width=600,height=700");
	    mywindow.moveTo(0, 0);
	}
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
    <td height="100"><?php include('head.php');?></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"  valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
                                    
                                    <td width="182" align="left" valign="top" bgcolor="#4c9309" class="red" style="padding:0px; margin:0px;"><?php include('left_mnu.php');?></td>
                                    <td width="100%" align="left" valign="top" bgcolor="" class="red"><table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0"  bordercolor="#111111">
                                      <tr>
                                        <td height="57" colspan="2" align="left"  valign="middle" class="head_ing">&nbsp;&nbsp;Manage Product</td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" align="left"  valign="top" class="red">                                            </td>
                                      </tr>
                                      
                                      <tr>
									   <?php if(isset($_REQUEST['message'])){ ?>
									   
										<?php }?>	
      	<td colspan="2" align="left" valign="top">
       <div class="wrapper">
    <ul class="tabs">
        <li><a href="javascript:void(0); return false;" rel="#tabcontent1" class="tab active">Products</a></li>
        <li><a href="javascript:void(0); return false;" rel="#tabcontent2" class="tab">Add New Products</a></li>
        <li><a href="clients-profile.php?supplier_id=<?php echo $_REQUEST['supplier_id']?>" class="tab">Back to Services and Profile</a></li>
        <!--<li><a href="javascript:void(0); return false;" rel="#tabcontent3" class="tab">Back to Services and Profile</a></li>
        <li><a href="javascript:void(0); return false;" rel="#tabcontent4" class="tab">TAB 4</a></li>
        <li><a href="javascript:void(0); return false;" rel="#tabcontent5" class="tab">TAB 5</a></li>-->
    </ul>

    <div class="tab_content_container">
        <div class="tab_content tab_content_active" id="tabcontent1">
            <h3>Products</h3>
           
          <table width="97%" border="0" cellspacing="10" cellpadding="5">
  <tr valign="middle" align="center">
   
    
    <?php 
    $count =1;
    foreach ($arrProduct as $product) {?>
     <td height="200" width="220" class="t-border">
    <table width="100%" border="0" height="200px" cellspacing="0" cellpadding="0">
      <tr>
        <th colspan="2" scope="row"><img src="<?php echo Util::getImage($product['image']);?>" width="180" height="120" alt=""></th>
        </tr>
      <tr>
        <td align="center" valign="middle" class="border-bg"><a onclick="javascript:myPopup('/product-discription.php?prod_id=<?php echo $product['prod_id']?>')" href="#">View</a></td>
        <td align="center" valign="middle" class="border-bg"><a href="edit-product.php?prod_id=<?php echo $product['prod_id']?>&supplier_id=<?php echo $product['supplier_id']?>">Edit</a></td>
        </tr>
    </table>
    </td>
           <?php 
            if($count%3 == 0) {?>
            	 </tr><tr valign="middle"  align="center">
            <?php }
             $count++; 
      } ?>
    </tr>
</table>
 
        </div>
<form action="edit-product.php"  enctype="multipart/form-data"  onsubmit ="return valid(this);" method="post" name="header" id="header">
        <div class="tab_content" id="tabcontent2">
            <h3>Add New Products</h3>
            
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
             	<select name="quntity_type" id="quntity_type">
             		<option value="Peice">Peice</option>
             		<option value="Peices">Peices</option>
             		<option value="Pack">Pack</option>
             		<option value="Packs">Packs</option>
             		<option value="Dosen">Dosen</option>
             	</select>
             </div>
             	 <script type="text/javascript">
				var defaultVal = '<?php echo $arrProduct['quntity_type']?>';
				var obj = document.getElementById("quntity_type");
				var len = obj.length;

				for(var i=0; i<len; i++) {
					if(defaultVal == obj.options[i].value) {
						obj.selectedIndex = i;
					}
				}

             </script>
          </div>
          
          
                   <!--  <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Upload Related Product</div>
            <div class="supplier-panel-right1"><input type="file" name="image" style="width:200px" >
        </div> -->
        
      <!--     <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Order Range</div>
             <div class="supplier-panel-right1"><input name="order_range" type="text" class="field" value="<?php echo $arrProduct['order_range']?>" /></div>
          </div>
  
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Supply Ability</div>
             <div class="supplier-panel-right1"><input name="supply_ability" type="text" class="field" value="<?php echo $arrProduct['supply_ability']?>" /></div>
          </div>
   -->
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Home Delivery</div>
             <div class="supplier-panel-right1"><input name="home_delivery" type="text" class="field" value="<?php echo $arrProduct['home_delivery']?>" /></div>
          </div>
  
           
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Description</div>
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
	             	<option value="0">-SELECT-</option>
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
          <div class="supplier-panel-bg1">
             <div class="supplier-panel-left1">Stock Availibility</div>
             <div class="supplier-panel-right1"><select name="stock_availability">
             	<option>Yes</option>
             	<option>No</option>
             </select>
             
             </div>
          </div>
          </div>
        
        <div align="center"><input name="Submit" type="submit" value="Submit"></div>
        </div>
</form>
        <div class="tab_content" id="tabcontent3">
            <h3>Where does it come from ?</h3>
            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
            <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
        </div>

        <div class="tab_content" id="tabcontent4">
            <h3>Where can I get some ?</h3>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
        </div>

        <div class="tab_content" id="tabcontent5">
            <h3>What Is Loren Ipsum ?</h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
    </div>
</div>
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