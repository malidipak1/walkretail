<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Walk Retail</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<!-- slider js and css-->

<link href="css/sample-styles.css" rel="stylesheet" type="text/css" />
<link href="css/lean-slider.css" rel="stylesheet" type="text/css" />

<script src="lean-slider.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

<!-- slider js and css-->

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
    <div class="left-panel">
      <div id="cat-bg">Categories</div>
      <div class="list">
        <ul>
            <li><a href="#">Apparel, Textiles & Accessories</a></li>
            <li><a href="#">Auto & Transportation</a></li>
            <li><a href="#">Electronics</a></li>
            <li><a href="#">Machinery, Industrial Parts & Tools</a></li>
            <li><a href="#">Gifts, Sports & Toys</a></li>
            <li><a href="#">Home, Lights & Construction</a></li>
            <li><a href="#">Health & Beauty</a></li>
            <li><a href="#">Bags, Shoes & Accessories</a></li>
            <li><a href="#">Electrical Equipment, Components & Telecom</a></li>
            <li><a href="#">Agriculture & Food</a></li>
            <li><a href="#">Packaging, Advertising & Office</a></li>
            <li><a href="#">Metallurgy, Chemicals, Plastics</a></li>
            <li><a href="#">All Categories</a></li>
        </ul>
      </div>
    </div>
    
    <!-- left panel end -->
    
    <div class="middle-panel">
    
      <form action="" method="post" style="padding:0 0 10px 0; float:left;">
          <span><img src="images/product-btn.jpg" width="114" height="46" alt=""  class="float"/></span>
          <span><input name="Search" type="text" value="search" class="search" /></span>
          <span><input type="image" src="images/search.jpg" align="right" /></span>
      </form>
      
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
            <div class="slide4">
                <img src="slider/5.jpg" alt="" />
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
      <span style="float:left;"><img src="images/watch-ad.jpg" width="336" height="154" alt="" /></span>
      <span style="float:right;"><img src="images/watch-ad.jpg" width="336" height="154" alt="" /></span>
    </div>
    
     <!-- middle panel end -->
     
    <div class="right-panel">
      <span><img src="images/quote.jpg" width="250" height="163" alt="" /></span>
      <span><img src="images/free-ad.jpg" width="250" height="145" alt="" /></span>
      <span><img src="images/facebook.jpg" width="248" height="167" alt="" /></span>
    </div>
    
     <!-- right panel end -->
     
  </div>
</div>
 <!-- middle panel end -->
 
 <div id="light-gray-bg">
   <div class="middle">
      <div class="middle-inner">
        <div id="white-bg">
          <div class="ad-box">
            <ul>
              <li>
                 <div>
                    <span><img src="images/ad-img.jpg" width="196" height="114" alt="" /></span>
                    <span class="pro-head">1080 P Car Video Recorder</span>
                    <span class="price">Price : Rs100 - Rs 300</span>
                    <span class="g-text">Order Range : 1-100 Pieces</span>
                 </div>
                 <div>
                    <span><img src="images/ad-img.jpg" width="196" height="114" alt="" /></span>
                    <span class="pro-head">1080 P Car Video Recorder</span>
                    <span class="price">US $27.00 <p class="g-text">/ Piece</p></span>
                    <span class="g-text">MOQ : 19 Pieces</span>
                 </div>
                  <div>
                    <span><img src="images/ad-img.jpg" width="196" height="114" alt="" /></span>
                    <span class="pro-head">1080 P Car Video Recorder</span>
                    <span class="price">US $27.00 <p class="g-text">/ Piece</p></span>
                    <span class="g-text">MOQ : 19 Pieces</span>
                 </div>
                 
              </li>
              <li>
                  <div>
                    <span><img src="images/ad-img.jpg" width="196" height="114" alt="" /></span>
                    <span class="pro-head">1080 P Car Video Recorder</span>
                    <span class="price">US $27.00 <p class="g-text">/ Piece</p></span>
                    <span class="g-text">MOQ : 19 Pieces</span>
                 </div>
                  <div>
                    <span><img src="images/ad-img.jpg" width="196" height="114" alt="" /></span>
                    <span class="pro-head">1080 P Car Video Recorder</span>
                    <span class="price">US $27.00 <p class="g-text">/ Piece</p></span>
                    <span class="g-text">MOQ : 19 Pieces</span>
                 </div>
                  <div>
                    <span><img src="images/ad-img.jpg" width="196" height="114" alt="" /></span>
                    <span class="pro-head">1080 P Car Video Recorder</span>
                    <span class="price">US $27.00 <p class="g-text">/ Piece</p></span>
                    <span class="g-text">MOQ : 19 Pieces</span>
                 </div>
                 
              </li>
              <li>
                 <div>
                    <span><img src="images/ad-img.jpg" width="196" height="114" alt="" /></span>
                    <span class="pro-head">1080 P Car Video Recorder</span>
                    <span class="price">US $27.00 <p class="g-text">/ Piece</p></span>
                    <span class="g-text">MOQ : 19 Pieces</span>
                 </div>
                  <div>
                    <span><img src="images/ad-img.jpg" width="196" height="114" alt="" /></span>
                    <span class="pro-head">1080 P Car Video Recorder</span>
                    <span class="price">US $27.00 <p class="g-text">/ Piece</p></span>
                    <span class="g-text">MOQ : 19 Pieces</span>
                 </div>
                  <div>
                    <span><img src="images/ad-img.jpg" width="196" height="114" alt="" /></span>
                    <span class="pro-head">1080 P Car Video Recorder</span>
                    <span class="price">US $27.00 <p class="g-text">/ Piece</p></span>
                    <span class="g-text">MOQ : 19 Pieces</span>
                 </div>
                 
              </li>
              <li>
                  <div>
                    <span><img src="images/ad-img.jpg" width="196" height="114" alt="" /></span>
                    <span class="pro-head">1080 P Car Video Recorder</span>
                    <span class="price">US $27.00 <p class="g-text">/ Piece</p></span>
                    <span class="g-text">MOQ : 19 Pieces</span>
                 </div>
                  <div>
                    <span><img src="images/ad-img.jpg" width="196" height="114" alt="" /></span>
                    <span class="pro-head">1080 P Car Video Recorder</span>
                    <span class="price">US $27.00 <p class="g-text">/ Piece</p></span>
                    <span class="g-text">MOQ : 19 Pieces</span>
                 </div>
                 <div>
                    <span><img src="images/ad-img.jpg" width="196" height="114" alt="" /></span>
                    <span class="pro-head">1080 P Car Video Recorder</span>
                    <span class="price">US $27.00 <p class="g-text">/ Piece</p></span>
                    <span class="g-text">MOQ : 19 Pieces</span>
                 </div>
                 
              </li>
             <li>
                  <div>
                    <span><img src="images/ad-img.jpg" width="196" height="114" alt="" /></span>
                    <span class="pro-head">1080 P Car Video Recorder</span>
                    <span class="price">US $27.00 <p class="g-text">/ Piece</p></span>
                    <span class="g-text">MOQ : 19 Pieces</span>
                 </div>
                 <div>
                    <span><img src="images/ad-img.jpg" width="196" height="114" alt="" /></span>
                    <span class="pro-head">1080 P Car Video Recorder</span>
                    <span class="price">US $27.00 <p class="g-text">/ Piece</p></span>
                    <span class="g-text">MOQ : 19 Pieces</span>
                 </div>
                  <div>
                    <span><img src="images/ad-img.jpg" width="196" height="114" alt="" /></span>
                    <span class="pro-head">1080 P Car Video Recorder</span>
                    <span class="price">US $27.00 <p class="g-text">/ Piece</p></span>
                    <span class="g-text">MOQ : 19 Pieces</span>
                 </div>
                 
              </li>
            </ul>
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
