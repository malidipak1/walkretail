<?php
include_once 'access_check.php';
   include_once '../DBUtil.php';
    
   $dbObj = new DBUtil();
   
   if($_REQUEST['action'] == 'delete' && !empty($_REQUEST['prod_id'])) {
   		$dbObj->deleteProducts($_REQUEST['prod_id']);
   		header("Location: product-list.php");
   		exit;
   }
  
   $arrParam = array();
   $search = "";
   if(!empty($_REQUEST['search'])) {
   		$search = $_REQUEST['search'];
   }

   $orderByKey = PRODTBL_DEFAULT_ORDER_KEY;
   $order = PRODTBL_DEFAULT_ORDER;
   if(!empty($_REQUEST['orderByKey'])) {
   		$orderByKey = $_REQUEST['orderByKey'];
   }
   if(!empty($_REQUEST['order'])) {
   		$order = $_REQUEST['order'];
   }
   
   $dbObj->isPaging = true;
   $arrProduct = $dbObj->getProductList($search, $arrParam, $orderByKey, $order);
   $page = $dbObj->page;
   $totalRecords = $dbObj->totalRecords;
   $lastPage = $dbObj->lastPage;

   ?>
<html>
<head>
<title>:::(Admin Panel) :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function deleteCat(val) {
	if(confirm ("Are you sure to Delete?")) {
		window.location = 'product-list.php?prod_id=' + val+ '&action=delete';
	}
}
function search(form) {
	if(form.search.value == '') {
		alert('Please enter Product/Supplier Name to search');
		return false;
	}
	return true;
}

function loadPage(field) {
	
	var url = 'http://' + '<?php echo $_SERVER['HTTP_HOST']?>';
	var urlOrderByKey = '<?php echo Util::getUrl('orderByKey')?>';
	var urlOrder = '<?php echo Util::getUrl('order')?>';

	if(field.name == 'orderByKey')
		url = url + '<?php echo Util::getUrl('orderByKey')?>' + field.name + '=' + field.value;
	else 
		url = url + '<?php echo Util::getUrl('order')?>' + field.name + '=' + field.value;

	window.location = url;	
}


function defaultSelect (obj, defaultVal) {
	var len = obj.length;
	for(var i=0; i<len; i++) {
		if(defaultVal == obj.options[i].value) {
			obj.selectedIndex = i;
		}
	}
}

</script>
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
                                        <td height="57" colspan="2" align="left"  valign="middle" class="head_ing">Product List</td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" align="left"  valign="top" class="red">                                            </td>
                                      </tr>
                                      
	      	<td colspan="2" align="center" valign="top">
	  	<table width="95%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
						
										 <tr align="center" style="color:#060; background:#FFF;">
										   <td colspan="7">
										   
								<form name="search_product" method="get" onSubmit="return search(this);">
										   
										   <table width="60%" border="0" align="center" cellpadding="0" cellspacing="10" style="background:#ebfadd; border:solid 1px #060;">
										     <tr>
										        <td height="30" align="center" valign="middle" class="btn-search">Search&nbsp;&nbsp;&nbsp; </td>
										       <!--<td height="30" align="center" valign="middle"><label for="select2"></label>
										         <select name="searchBy" id="searchBy" class="sell5">
										           <option>Supplier</option>
										           <option>Product</option>
							                   </select></td> -->
										       <td height="30" align="center" valign="middle" ><label for="textfield"></label>
									           <input type="text" name="search" id="search" class="search" value="<?php echo $search?>" placeholder="Enter product/supplier name" ></td>
										       <td height="30" align="center" valign="middle">
										       <input name="button" type="submit" class="search-btn" id="button" value="." ></td>
									         </tr>
									       </table>
								</form>
									       </td>
									       <td>
									       		<input type="hidden" id="orderByKeyDefault" value="<?php echo $_REQUEST['orderByKey']?>">
									       		<select name="orderByKey" id="orderByKey" onchange="javascript:loadPage(this);">
									       			<option value="update_date">Updated Date</option>
									       			<option value="prod_id">Product Id</option>
									       		</select>
									       </td>
									       <td>
									       		<input type="hidden" id="orderDefault" value="<?php echo $_REQUEST['order']?>">
									       		<select name="order" id="order" onchange="javascript:loadPage(this);">
									       			<option value="DESC">Descending</option>
									       			<option value="ASC">Ascending</option>
									       		</select>
									       </td>
				      </tr>
										 <tr align="center"  bgcolor="#3c7701">									
										<td>Product Image</td>
										 <td width="11%" class="white">Client Name</td>
                                          <td width="16%" class="white">Sub - Category</td>
                                         <td width="16%" class="white">Product Name</td>
                                         <td width="8%" class="white">Product ID</td>
                                         <td width="8%" class="white">Product Status</td>
                                         <td width="11%" class="white">Updated On</td>
                                         <td width="8%" class="white">Edit</td>
                                         <td width="8%" class="white">Delete</td>
                                         
                   					    </tr>
                                          <!----------------------Start your loop------------------------------->
                                          <?php foreach ($arrProduct as $prod) {?>
                                           <tr align="center">	
                                            <td width="16%"  bgcolor="#FFFFFF">&nbsp;<img width="50px"  alt="<?php echo $prod['prod_name']?>" src="<?php echo Util::getImage($prod['image'])?>" /></td>
                                            <td width="11%" height="40" bgcolor="#FFFFFF">&nbsp;<?php echo $prod['name']?></td>
                               				<td width="16%"  bgcolor="#FFFFFF">&nbsp;<?php echo $prod['catname']?></td>
                                            <td width="16%"  bgcolor="#FFFFFF">&nbsp;<?php echo $prod['prod_name']?></td>
                                            <td width="8%"  bgcolor="#FFFFFF">&nbsp;<?php echo $prod['prod_id']?></td>
                                            <td width="8%"  bgcolor="#FFFFFF">&nbsp;<?php echo $prod['prod_status']?></td>
                                            <td width="11%"  bgcolor="#FFFFFF"><?php echo $prod['update_date']?></td>
                                            <td width="8%"  bgcolor="#FFFFFF">
                                            <a href="edit-product.php?prod_id=<?php echo $prod['prod_id']?>&supplier_id=<?php echo $prod['supplier_id']?>"> 
                                            	<img width="12" height="12" border="0" alt="Edit" src="images/Edit.gif">
                                            </a>
                                            </td>
                                            <td width="8%"  bgcolor="#FFFFFF">
                                            <a href="javascript:void(0);" onClick="deleteCat('<?php echo $prod['prod_id']?>');"> 
                                            	<img width="12" height="12" border="0" alt="Edit" src="images/b_drop.gif">
                                            </a>
                                            </td>
                                          	
                                          </tr>
                                          <?php }?>
                                		<tr><td colspan="9" bgcolor="#FFFFFF">
									<!-- Paging starts here  -->
										<div class="clear">&nbsp;</div>
										<div id="container">
											<div class="pagination"><?=Util::getPagination($page, $lastPage)?></div>
										</div>
									<!-- Paging ends starts here  -->	
                                       </td>  </tr>
                                          <!-----------------------End your loop here---------------------------->
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
<script language="JavaScript" type="text/JavaScript">
defaultSelect(document.getElementById('orderByKey'),document.getElementById('orderByKeyDefault').value);
defaultSelect(document.getElementById('order'),document.getElementById('orderDefault').value);

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
</body>
</html>
