<?php
include_once 'DBUtil.php';
$dbObj = new DBUtil();

$arrPage = array('ABOUT_US' => 'About Us', 'CONTACT_US' => 'Contact Us','TERMS' => 'Terms & Condition',
				'PRIVACY_POLICY' => 'Privacy Policy','FAQS' => 'FAQs','COD' => 'Cash on Delivery','HOW_WORKS' => 'How It Works');
if(array_key_exists($_REQUEST['page'], $arrPage) && true){
	$arrDetails = $dbObj->getStaticPageByPage($_REQUEST['page']);
	$arrDetails = $arrDetails[0];
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Walk Retail</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="tgray-bg">
  <div class="middle">
     <div class="middle-inner">
        <?php include("menu.php");?>
     </div>
  </div>
</div>
<div id="tgreen-bg">
  <div class="middle">
     <div class="middle-inner">
       <span class="logo"><a href="/index.php"><img src="/images/logo.jpg" alt="" /></a></span>
     <!-- <span class="supplier"><a href="supplier-registration.php"><img src="images/supplier.jpg" width="173" height="87" alt="" /></a></span>-->
     </div>
  </div>
</div>

<!-- end green bg -->

<div class="middle">
  <div class="middle-inner">
  
    <h3><?php echo $arrDetails['page_title']?></h3>
   
   <?php echo $arrDetails['page_description']?>
   <p>&nbsp;&nbsp;</p>
   <p>&nbsp;&nbsp;</p>
  </div>
</div>
 <!-- middle panel end -->
 
 <!-- light gray bg end -->
 
 <div id="footer-bg">
   <div class="middle">
     <div class="middle-inner">
        <?php include("footer.php");?>
     </div>
   </div>
 </div>
 
 <!-- end footer green-->
 
 <div id="footer-gray">
   <div class="middle">
     <div class="middle-inner">
        <?php include("copy.php");?>
     </div>
   </div>
 </div>
 

 

</body>
</html>
