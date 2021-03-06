<?php 
include_once 'DBUtil.php';
include_once 'Util.php';

$dbObj = new DBUtil();

$mainAds = $dbObj->getPremiumAds();
$subAds = $dbObj->getPremiumAds('SUB_ADS');
$sideAds = $dbObj->getPremiumAds('SIDE_ADS');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <title>Walk Retail</title>
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script src="lean-slider.js"></script>
    <link rel="stylesheet" href="lean-slider.css" type="text/css" />
    <link rel="stylesheet" href="sample-styles.css" type="text/css" />
    
    
    <!-- CATEGORY MENU START-->
    <link href="css/dcverticalmegamenu.css" rel="stylesheet" type="text/css" />

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
    
    
 <!--Floating Menu-->   
 
 
 
 <!--Floating Menu End-->
    
    
</head>
<body>
<!--FB Page-->
<div id="fb-root"></div>
<script>
function loadPage(u) {
	window.location = u;
}

(function(d, s, id) {
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
   <div><?php include("side-categories.php");?></div>
    <!-- left panel end -->
    
    <div class="middle-panel">
       <?php include("search-product.php");?>
      
      <!-- end search form-->
      
      <!-- start header-->
      
     <div class="slider-wrapper">
        <div id="slider">
        	<?php $cnt=0; foreach ($mainAds as $eachAd) {?>
            <div  style="cursor: pointer;" class="slide<?php echo $cnt++;?>">
                 <a style="cursor: pointer;" href="<?php echo $eachAd['image_link']?>" >
                 	<img style="cursor:pointer;" height="300px;" width="400px" src="<?php echo Util::getAdsImage($eachAd['image_name'])?>" alt="<?php echo $eachAd['image_alt']?>" /> 
                 </a>
            </div>
            <?php }?>
        </div> 
        <div id="slider-direction-nav"></div>
        <!--<div id="slider-control-nav"></div>-->
    </div>
    
    <script type="text/javascript">
    $(document).ready(function() {
        var slider = $('#slider').leanSlider({
            directionNav: '#slider-direction-nav',
            controlNav: '#slider-control-nav'
        });
    });
    </script>
<!-- end of header-->
      <span style="float:left;"><a href="<?php echo $subAds[0]['image_link']?>" target="_blank"><img src="<?php echo Util::getAdsImage($subAds[0]['image_name'])?>" border="0" width="338" height="157" alt="" /></a></span>
      <span style="float:right;"><a href="<?php echo $subAds[1]['image_link']?>"  target="_blank"><img src="<?php echo Util::getAdsImage($subAds[1]['image_name'])?>" border="0" width="338" height="157" alt="" /></a></span>
    </div>
    
     <!-- middle panel end -->
     
    <div class="right-panel">
    <?php foreach ($sideAds as $eachSideAd) {?>
      <span><a href="<?php echo $eachSideAd['image_link']?>" target="_blank"><img src="<?php echo Util::getAdsImage($eachSideAd['image_name'])?>" width="250" height="163" alt="" border="0" /></a></span>
      <?php }?>
 <!--      <span><a href="suggetion.php" target="_blank" ><img src="images/offer.jpg" width="250" height="145" alt="" border="0" /></a></span>
    <a href="http://walkretail.com/request-quote.php" target="_blank"><img src="images/side-img.jpg" border="0" width="248" height="167" alt="" /></a> </div>
  -->   
     <!-- right panel end -->
     
  </div>
</div></div>
 <!-- middle panel end -->
 
 <div id="light-gray-bg">
   <div class="middle">
      <div class="middle-inner">
      <div id="white-bg">
          <div class="ad-box" style="text-align:center; color:#E84019; font-size:15px; padding:10px 0; line-height:22px; margin-bottom:">
             <strong>IMP NOTE :</strong> For order of single product the Maximum Price will be charged and for order of Bulk Quantity  Minimum amount will be charged.  (For ex. If Price Range is 100-200 and Order Range is 1-50, then for 1 piece you will be charged Rs 200 per piece and For 50 pieces you will be charged Rs 100 per piece ).
          </div>
          
        </div>
        <br /><br /><br /><br /><br />
        <div id="white-bg">
          <div class="ad-box">
             <?php include("ad-home.php");?>

          </div>
        </div>
      </div>
   </div>
 </div>
 </div>

 
 
 <!-- light gray bg end -->
 
 <?php include("footer.php");?>
 
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
