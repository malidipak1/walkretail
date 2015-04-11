<?php
session_start();
if(!isset($_SESSION['login']))
   {
     header('Location: index.php');
	 exit;
   }

  $arrAdv = array('HOME_PAGE' => 'Home Page Ads',
  					'SEARCH_PAGE' => 'Search Page Ads',
  					'DESC_PAGE' => 'Prduct Desc Page Ads',
  					'THANKS_PAGE' => 'Thanks Page Ads'
  				);

  include_once '../DBUtil.php';
  include_once '../Util.php';
  $dbObj = new DBUtil();
  $arrResult = array();
  
  if( !empty($_POST)) {
  	$pageTitle = $_POST['adv_id'];
  	$cnt = 0;
  	$arrInsert = array();
  	
  	foreach ($_POST['prodid'] as $prId) {
  		$arrInsert[$prId] =  $_POST['sequence'][$cnt++];   		
  	}
  	$dbObj->addAdsProduct($arrInsert, $pageTitle);
  	//print_r($arrInsert);
  	
  } 
  
  
  
  
  if(!empty($_REQUEST['adv_id']))
  	$arrResult = $dbObj->getAdsProductByPage($_REQUEST['adv_id']);
  
//  /print_r($arrResult);
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
                                        <td height="57" colspan="2" align="left"  valign="middle" class="head_ing">Manage  Advertise</td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" align="left"  valign="top" class="red">                                            </td>
                                      </tr>
                                      
                                      <tr>
									   <tr align="right"  bgcolor="#ffffff">
                                            <td colspan="10" height="" class="red"><div align="center">
                                            
                                            </div>                                            </td>
                                            </tr>
      	<td colspan="2" align="center" valign="top">
	  	<form name="advs" method="post" action="">
<script language="javascript">function addRow(tableID){var table=document.getElementById(tableID);var rowCount=table.rows.length;var row=table.insertRow(rowCount);var colCount=table.rows[0].cells.length;for(var i=0;i<colCount;i++){var newcell=row.insertCell(i);newcell.innerHTML=table.rows[0].cells[i].innerHTML;switch(newcell.childNodes[0].type){case"text":newcell.childNodes[0].value="";break;case"checkbox":newcell.childNodes[0].checked=false;break;case"select-one":newcell.childNodes[0].selectedIndex=0;break;}}}
function deleteRow(tableID){try{var table=document.getElementById(tableID);var rowCount=table.rows.length;for(var i=0;i<rowCount;i++){var row=table.rows[i];var chkbox=row.cells[0].childNodes[0];if(null!=chkbox&&true==chkbox.checked){if(rowCount<=1){alert("Cannot delete all the rows.");break;}
table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}</script>
    <div style="float:right;"><input value="Add Row" onclick="addRow('dataTable')" type="button">
    <input value="Delete Row" onclick="deleteRow('dataTable')" type="button"></div>
    
    <div><select name="adv_id" >
      <option value="">Select Page</option>
     <?php foreach ($arrAdv as $key => $val) {
     		$selected = "";
     		if($key == $_REQUEST['adv_id']) {$selected = "selected=selected";}	
     	?>
      <option <?php echo $selected?> value="<?php echo $key?>"><?php echo $val?></option>
      <?php }?>
    </select></div>

    <div style="padding:0 0 0 0;"><span>Product ID</span><span style="padding:0 0 0 85px;">Sequence</span></div>
    <table id="dataTable" border="1" width="350px">
        <tbody>
        <?php if(count($arrResult) <= 0) {?>
        <tr>
            <td><input name="chk" type="checkbox"></td>
            <td><input name="prodid[]" type="text" value="" /></td>
            <td><input name="sequence[]" type="text" value="" /></td>
        </tr>
        <?php } else {
        	foreach ($arrResult as $result) {
        		
        ?>
        <tr>
            <td><input name="chk" type="checkbox"></td>
            <td><input name="prodid[]" type="text" value="<?php echo $result['prod_id']?>" /></td>
            <td><input name="sequence[]" type="text" value="<?php echo $result['sequence']?>" /></td>
        </tr>
        <?php }
        } ?>
        
        <tr>
            <td colspan="3"><input name="submit" type="submit"></td>
        </tr>
        
        
    </tbody></table>
        
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