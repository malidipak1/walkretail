<?php
session_start();
if(!isset($_SESSION['login']))
   {
     header('Location: index.php');
	 exit;
   }

   include_once '../DBUtil.php';
    
   $dbObj = new DBUtil();
    
   $arrSupplier = $dbObj->getSupplier();
   
   //print_r($arrSupplier );
    
   
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
                                        <td height="57" colspan="2" align="left"  valign="middle" class="head_ing">Clients List</td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" align="left"  valign="top" class="red">                                            </td>
                                      </tr>
                                      
	      	<td colspan="2" align="center" valign="top">
	  	<form name="search_product" method="post" action="">
			<table width="95%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
						
										 <tr align="center"  bgcolor="#3c7701">									

										 <td width="22%" class="white">Name</td>
                                          <td width="16%" class="white">Email Id</td>
                                         <td width="16%" class="white">Contact No.</td>
                                         <td width="8%" class="white">Product</td>
                                         <td width="8%" class="white">View</td>
                                         
                      					</tr>
                                          <!----------------------Start your loop------------------------------->
                                          <?php foreach ($arrSupplier as $supplier) {?>
                                           <tr align="center">	
                                            
                                            <td width="22%" height="40" bgcolor="#FFFFFF">
											<?php echo $supplier['name']?>
											</td>
                               <td width="16%"  bgcolor="#FFFFFF"><?php echo $supplier['email']?></td>
                                            <td width="16%"  bgcolor="#FFFFFF">
                                                <?php echo $supplier['mobile']?>                        </td>
                                            <td width="8%"  bgcolor="#FFFFFF">count</td>
                                            <td width="8%"  bgcolor="#FFFFFF"><a href="clients-profile.php?supplier_id=<?php echo $supplier['id']?>"> <img src="images/Edit.gif" width="12" height="12" alt="Edit" border="0" /></a></td>
                                          
                                          </tr>
                                          <?php }?>
                                	
									<!-- Paging starts here  -->
									<?php include("paging/paging_row.inc.php") ?> 
									<!-- Paging ends starts here  -->	
                                          
                                          
                                          
                                          
                                          
                                          <tr>
                                            <td  height="33" colspan="10" align="center" bgcolor="#3c7701"><input name="add" type="button" value="Add new Record"  onClick="navigate('add_new_team.php');" /></td>
                                          </tr>
                                          <!-----------------------End your loop here---------------------------->
                                        </table>
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