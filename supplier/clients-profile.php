<?php
session_start();
if(!isset($_SESSION['login']))
   {
     header('Location: index.php');
	 exit;
   }
   include_once '../DBUtil.php';
    
   $dbObj = new DBUtil();
   
   if(!empty($_REQUEST['supplier_id'])) {
	   	$arrResult = $dbObj->getSupplierProd($_REQUEST['supplier_id']);
   }
   ?>
<html>
<head>
<title>:::(Admin Panel) :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/tabbed-style.css">
<script src="js/tabbed.js" type="text/javascript"></script>
<script src="js/tabbed-index.js" type="text/javascript"></script>
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
                                      
                                      <tr>
									   <?php if(isset($_REQUEST['message'])){ ?>
									   
										<?php }?>	
      	<td colspan="2" align="left" valign="top">
       <div class="wrapper">
    <ul class="tabs">
        <li><a href="javascript:void(0); return false;" rel="#tabcontent1" class="tab active">Services</a></li>
        <li><a href="javascript:void(0); return false;" rel="#tabcontent2" class="tab">Profile</a></li>
        <li><a href="view-clients.php" class="tab"><span>Back To Client List</span></a></li>
         <!--<li><a href="javascript:void(0); return false;" rel="#tabcontent3" class="tab"><span>Back To Client List</span></a></li>
        <li><a href="javascript:void(0); return false;" rel="#tabcontent4" class="tab">TAB 4</a></li>
        <li><a href="javascript:void(0); return false;" rel="#tabcontent5" class="tab">TAB 5</a></li>-->
    </ul>

    <div class="tab_content_container">
        <div class="tab_content tab_content_active" id="tabcontent1">
           <table border="0" cellpadding="0" cellspacing="0" width="950"><tr><td><h3>Services</h3></td><td align="right"><h3><a href="edit-product.php?supplier_id=<?php echo $_REQUEST['supplier_id']?>">Add Product</a></h3></td></tr></table>
           
           <table width="97%" border="0" cellspacing="0" cellpadding="10" style="border:1px solid #CCC">
              <tr bgcolor="#3c7701" height="35px;">
                <!--  <td class="white">Category Name</td> -->
                 <td class="white">Subcategory</td>
                 <td class="white" align="center">Product</td>
                 <td class="white" align="center">View</td>
              </tr>
              <?php foreach ($arrResult as $result) {?>
              <tr>
               <!--  <td class="t-border">Electronic</td> -->
                <td class="t-border"><?php echo $result['catname']?></td>
                <td class="t-border" align="center"><?php echo $result['count']?></td>
                <td class="t-border" align="center"><a href="manage-product.php?supplier_id=<?php echo $_REQUEST['supplier_id']?>&category=<?php echo $result['category']?>"><img src="images/Edit.gif" width="12" height="12" alt="Edit" border="0" /></a></td>
              </tr>
             <?php }?>
              </tr>
            </table>

 
        </div>

        <div class="tab_content" id="tabcontent2">
            <h3>Profile</h3>
            <p style="width:950px; text-align:justify;"><img src="images/images1.jpg" width="146" height="173" alt="" style="float:left;">It is a long established fact that a reader will be distracted by the readable content of a page when 
               looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution 
               of letters, as opposed to using 'Content here, content here', making it look like readable English. Many 
               desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, 
               and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, 
               sometimes by accident, sometimes on purpose (injected humour and the like).  like readable English. Many 
               desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, 
               and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, 
               sometimes by accident, sometimes on purpose (injected humour and the like).</p>

            
        </div>

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