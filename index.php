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
   <div><?php include("side-categories.php");?></div>

    
    <!-- left panel end -->
    
    <div class="middle-panel">
    
    
    
       <?php include("search-product.php");?>
      
      <!-- end search form-->
      
      <!-- start header-->
      
     <div class="slider-wrapper">
        <div id="slider">
            <div class="slide1">
                 
                 <img src="slider/1.jpg" alt="" /> 
            </div>
            <div class="slide2">
              <img src="slider/2.jpg" alt="" />
            </div>
            <div class="slide3">
              <img src="slider/3.jpg" alt="" />
            </div>
            <!--<div class="slide4">
                <img src="slider/5.jpg" alt="" />
            </div>-->
        </div>
        <div id="slider-direction-nav"></div>
        <div id="slider-control-nav"></div>
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
      <span style="float:left;"><img src="images/watch-ad.jpg" width="336" height="154" alt="" /></span>
      <span style="float:right;"><a href="http://walkretail.com/product-discription.php?prod_id=17"><img src="images/yolo-ad.jpg" border="0" width="338" height="157" alt="" /></a></span>
    </div>
    
     <!-- middle panel end -->
     
    <div class="right-panel">
      <span><a href="request-quote.php"><a href="request-quote.php" target="_blank"><img src="images/quote.jpg" width="250" height="163" alt="" border="0" /></a></span>
      <span><a href="suggetion.php" target="_blank" ><img src="images/offer.jpg" width="250" height="145" alt="" border="0" /></a></span>
 
    <img src="images/side-img.jpg" width="248" height="167" border="0" alt="" /> </div>
    
     <!-- right panel end -->
     
  </div>
</div>
 <!-- middle panel end -->
 
 <div id="light-gray-bg">
   <div class="middle">
      <div class="middle-inner">
        <div id="white-bg">
          <div class="ad-box">
             <?php include("ad-home.php");?>

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
