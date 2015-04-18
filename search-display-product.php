<?php 
//print_r($_SERVER);
//exit;
$arrResult = array();
include_once 'DBUtil.php';
include_once 'Util.php';
$dbObj = new DBUtil();
$dbObj->isPaging = false;
$dbObj->pagingPerPage = PRODUCT_PER_PAGE;

if(!empty($_REQUEST['category'])) {
	$arrParam = array('category' => $_REQUEST['category']);
	$arrResult = $dbObj->getActiveProducts($arrParam);
}
if(!empty($_REQUEST['search']) ){
	
	$min = empty($_REQUEST['min']) ? 0 : $_REQUEST['min'];
	$max = empty($_REQUEST['max']) ? 0 : $_REQUEST['max'];
	
	$arrResult = $dbObj->searchProductByName($_REQUEST['search'], $min, $max);
}

$page = $dbObj->page;
$totalRecords = $dbObj->totalRecords;
$lastPage = $dbObj->lastPage;
//print_r($arrResult);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
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
<!--FB Page-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!--FB Page-->
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
      <div style="height:10px;"></div>
      <?php if(count($arrResult) <= 0) {
      if(!empty($_REQUEST['search'])) { 
          	echo "Products are coming soon!"; 
          } else if(!empty($_REQUEST['category'])) {
          	echo "No Products found!";
          }
       } else {?>
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
          <td style="padding:0 0 10px 60px; font-size:16px; color:#4c9209; font-family:'Century Gothic';"><?php if(!empty($_REQUEST['search'])) { 
          	echo $_REQUEST['search']; 
          } else if(!empty($_REQUEST['category'])) {
          	echo Util::getCategoryName($_REQUEST['category']);
          }
          ?></td>
          </tr>
          <tr valign="middle"  align="center">
          
             <?php 
             $count=1;
             foreach ($arrResult as $result) {?>
              <td width="33%" class="border">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" class="prod-border" >
              <tr valign="top" align="center">
                <td><p>&nbsp;</p>
                <p><a href="product-discription.php?prod_id=<?php echo $result['prod_id']?>">  <img src="<?php echo Util::getImage($result['image']);?>" width="170"  alt="" /></a></p></td>
              </tr>
             <tr valign="top" align="center">
                <td height="40" valign="middle" class="pro-head" align="center"><p style="width:130px; text-align:center; margin:0 auto;"><?php echo $result['prod_name']?></p></td>
              </tr>
              <tr valign="top" align="center">
                <td height="26" valign="middle" class="price1">Price : &#8377; <?php echo $result['min_price']?> - &#8377; <?php echo $result['max_price']?></td>
              </tr>
             <tr valign="top" align="center">
                 <td valign="middle" class="g-text">Order Range : <?php echo $result['min_quantity']?> - <?php echo $result['max_quantity']?></td>
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
         
           <br /><br />
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
          <td style="font-size:16px; color:#4c9209; font-family:'Century Gothic';">
	        <div id="container">
				<div class="pagination"><?=Util::getPagination($page, $lastPage)?></div>
			</div>
       </td></tr></table>  
         <?php }?>
         
       <br /><br />
         

       
      </div>
      <!-- product end here-->
      
      </div>
    
     <!-- middle panel end -->
    
    <?php include("ad-right.php");?>
    
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
