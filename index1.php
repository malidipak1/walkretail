<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Walk Retail</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<!-- slider js and css-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script src="lean-slider.js"></script>
    <link rel="stylesheet" href="lean-slider.css" type="text/css" />
    <link rel="stylesheet" href="sample-styles.css" type="text/css" />

<!-- slider js and css-->

</head>

<body>

<!-- end green bg -->

<div class="middle">
  <div class="middle-inner"><!-- left panel end -->
    
    <div class="middle-panel"><!-- end search form-->
      
      <!-- start header-->
      
     <div class="slider-wrapper">
        <div id="slider">
            <div class="slide1">
                <img src="images/1.jpg" alt="" />
            </div>
            <div class="slide2">
                <img src="images/2.jpg" alt="" />
            </div>
            <div class="slide3">
                <img src="images/3.jpg" alt="" />
            </div>
            <div class="slide4">
                <img src="images/4.jpg" alt="" />
            </div>
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
     
    </div>
    
     <!-- middle panel end --><!-- right panel end -->
     
  </div>
</div>
 <!-- middle panel end --><!-- light gray bg end --><!-- end footer green-->
 
 <div id="footer-gray"></div>
 
</body>
</html>
