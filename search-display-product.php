<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Walk Retail</title>
<link href="style.css" rel="stylesheet" type="text/css" />
 <!-- CATEGORY MENU START-->
    <link href="css/dcverticalmegamenu.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type='text/javascript' src='js/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='js/jquery.dcverticalmegamenu.1.3.js'></script>
<script type="text/javascript">
$(document).ready(function($){

	$('#mega-1').dcVerticalMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'show',
		direction: 'right'
	});
	$('#mega-2').dcVerticalMegaMenu({
		rowItems: '3',
		speed: 'slow',
		effect: 'fade',
		direction: 'left'
	});
	$('#mega-3').dcVerticalMegaMenu({
		rowItems: '4',
		speed: 'slow',
		effect: 'slide',
		direction: 'right'
	});
	$('#mega-4').dcVerticalMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'slide',
		direction: 'left'
	});

});
</script>
<!--CATEGORY MENU END-->
</head>

<body>
<div id="tgray-bg">
  <div class="middle">
     <div class="middle-inner">
        <?php include("menu.php");?>
     </div>
  </div>
</div>
<?php include("header.php");?>


<!-- end green bg -->

<div class="middle">
  <div class="middle-inner">
       <?php include("side-categories.php");?>

    
    <!-- left panel end -->
    
    <div class="middle-panel">
    
        <?php include("search-product.php");?>
      
      <!-- end search form-->
      
      <!-- producct start here-->
      <div class="spro">
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr valign="middle"  align="center">
           <td width="33%">
             <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr valign="top" align="center">
                <td><img src="images/monarch-kitchen-no.17.jpg" width="101" height="151" alt="" /></td>
              </tr>
             <tr valign="top" align="center">
                <td height="40" valign="middle" class="pro-head">1080 P Car Video Recorder</td>
              </tr>
              <tr valign="top" align="center">
                <td height="26" valign="middle" class="price1">Price : Rs100 - Rs 300</td>
              </tr>
             <tr valign="top" align="center">
                 <td valign="middle" class="g-text">Order Range : 1-100 Pieces</td>
              </tr>
            </table>

           </td>
           <td width="33%">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr valign="top" align="center">
                <td><img src="images/monarch-kitchen-no.17.jpg" width="101" height="151" alt="" /></td>
              </tr>
             <tr valign="top" align="center">
                <td height="40" valign="middle" class="pro-head">1080 P Car Video Recorder</td>
              </tr>
              <tr valign="top" align="center">
                <td height="26" valign="middle" class="price1">Price : Rs100 - Rs 300</td>
              </tr>
             <tr valign="top" align="center">
                 <td valign="middle" class="g-text">Order Range : 1-100 Pieces</td>
              </tr>
            </table>
           </td>
            <td width="33%">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr valign="top" align="center">
                <td><img src="images/monarch-kitchen-no.17.jpg" width="101" height="151" alt="" /></td>
              </tr>
             <tr valign="top" align="center">
                <td height="40" valign="middle" class="pro-head">1080 P Car Video Recorder</td>
              </tr>
              <tr valign="top" align="center">
                <td height="26" valign="middle" class="price1">Price : Rs100 - Rs 300</td>
              </tr>
             <tr valign="top" align="center">
                 <td valign="middle" class="g-text">Order Range : 1-100 Pieces</td>
              </tr>
            </table>
            </td>
          </tr>
          
         </table><br /><br />
        
         
         

       
      </div>
      <!-- product end here-->
      
      </div>
    
     <!-- middle panel end -->
     
    <?php include("right-ad.php");?>
    
     <!-- right panel end -->
     
     
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
