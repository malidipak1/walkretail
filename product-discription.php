<?php 
include_once 'DBUtil.php';
include_once 'Util.php';
$dbObj = new DBUtil();
if(!empty($_REQUEST['prod_id'])) {
	$arrParam = array('prod_id' => $_REQUEST['prod_id']);
	$arrResult = $dbObj->getProducts($arrParam);
	$arrResult = $arrResult[0];
}
//print_r($arrResult);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Walk Retail</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/tabbed-style.css">

<br />

<!-- product display js start -->
<script src="js/jquery-1.6.js" type="text/javascript"></script>
<script src="js/jquery.jqzoom-core.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/jquery.jqzoom.css" type="text/css">
<script type="text/javascript">

$(document).ready(function() {
	$('.jqzoom').jqzoom({
            zoomType: 'standard',
            lens:true,
            preloadImages: false,
            alwaysOn:false
        });
	});
</script>
<!-- product display js end -->

 <!-- product scrolling js start -->
  <script src="js/jsCarousel-2.0.0.js" type="text/javascript"></script>
    <link href="css/jsCarousel-2.0.0.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        $(document).ready(function() {
            $('#carouselv').jsCarousel({ onthumbnailclick: function(src) { alert(src); }, autoscroll: true, masked: false, itemstodisplay: 3, orientation: 'v' });
            $('#carouselh').jsCarousel({ onthumbnailclick: function(src) { alert(src); }, autoscroll: false, circular: true, masked: false, itemstodisplay: 5, orientation: 'h' });
            $('#carouselhAuto').jsCarousel({ onthumbnailclick: function(src) { alert(src); }, autoscroll: true, masked: true, itemstodisplay: 5, orientation: 'h' });

        });       
        
    </script>
    
    <!-- product scrolling js end -->
    
</head>

<body>
<!--tabbedpanel-js-->

<!--tabbedpanel-js-->
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
    <div class="left-2-panel">
        <?php include("search-product.php");?>
      <div class="bg1">
        <div class="prod1" align="center">
          
          <div style="float:left;">
    <div class="clearfix">
        <a href="imgProd/triumph_big1.jpg" class="jqzoom" rel='gal1'  title="triumph" >
            <img src="imgProd/triumph_small1.jpg"  title="triumph" >
    </a></div>
	<br/>
 <div class="clearfix" >
	<ul id="thumblist" class="clearfix" >
		<li><a class="zoomThumbActive" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: './imgProd/triumph_small1.jpg',largeimage: './imgProd/triumph_big1.jpg'}"><img src='imgProd/thumbs/triumph_thumb1.jpg'></a></li>
		<li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: './imgProd/triumph_small2.jpg',largeimage: './imgProd/triumph_big2.jpg'}"><img src='imgProd/thumbs/triumph_thumb2.jpg'></a></li>
		<li><a  href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: './imgProd/triumph_small3.jpg',largeimage: './imgProd/triumph_big3.jpg'}"><img src='imgProd/thumbs/triumph_thumb3.jpg'></a></li>
       <li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: './imgProd/triumph_small2.jpg',largeimage: './imgProd/triumph_big2.jpg'}"><img src='imgProd/thumbs/triumph_thumb2.jpg'></a></li>
		<li><a  href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: './imgProd/triumph_small3.jpg',largeimage: './imgProd/triumph_big3.jpg'}"><img src='imgProd/thumbs/triumph_thumb3.jpg'></a></li>
	</ul>
	</div>
</div>
          
        </div>
        <div class="prod2">
             <div class="head"><?php echo $arrResult['prod_name']?></div>
          <div class="prod2-left">
            <span>Product Price :</span>
            <span>Min.Order Quantity : </span>
            <span>Supply Ability : </span>
            <span>Stock Availability : </span>
            <span>Home Delivery : </span>
          </div>
             <div class="prod2-middle">
                <span>Rs. <?php echo $arrResult['price']?>/-</span>
                <span><?php echo $arrResult['order_range']?>&nbsp;</span>
                <span><?php echo $arrResult['supply_ability']?>&nbsp;</span>
                <span><?php $stock = ($arrResult['supply_ability'] == 'Yes') ? "In Stock" : "Out of Stock"; echo $stock;?>&nbsp; </span>
                <span><?php echo $arrResult['home_delivery']?>&nbsp;</span>
             </div>
             <div class="prod2-right" align="center">
                <span><img src="images/trusted.png" width="86" height="88" alt="" /></span>
               
             </div>
             <div class="buy-now">
               <p>
                 <span><a href="buy-now.php"><img src="images/buy-now.png" width="95" height="35" alt="" /></a></span>
                 <span>( For up to 3 Products )</span>
               </p>
              <p>
                 <span><a href="get-quote.php"><img src="images/get-quotation.png" width="105" height="36" alt="" /></a></span>
                 <span>( For Bulk Quantity )</span>
              </p>
             </div>
             
        </div>
         <div>
           <span><strong>Supplier</strong>  : <?php echo Util::getSupplierName($arrResult['supplier_id']);?></span><br /><br />
          
        </div>
       
       
      </div>
      
       <div id="ad-bg">
         <div class="wrapper">
    <ul class="tabs">
        <li><a href="javascript:void(0); return false;" rel="#tabcontent1" class="tab active">TAB 1</a></li>
        <li><a href="javascript:void(0); return false;" rel="#tabcontent2" class="tab">TAB 2</a></li>
        <!--<li><a href="javascript:void(0); return false;" rel="#tabcontent4" class="tab">TAB 4</a></li>
        <li><a href="javascript:void(0); return false;" rel="#tabcontent5" class="tab">TAB 5</a></li>-->
    </ul>

    <div class="tab_content_container">
        <div class="tab_content tab_content_active" id="tabcontent1">
			<?php echo $arrResult['desc']?>
        </div>

        <div class="tab_content" id="tabcontent2">
   			<?php echo $arrResult['TOS']?>
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

  <script src="js/tabbed-index.js"></script>
       </div>
       
       
       <!-- image scrolling start -->
       
       <div id="carouselh" style="display: none;">
                            <div style="float:left;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="v-height-scroll">
                    <tr valign="middle">
                        <td align="center"><img alt="" src="pro-img/img_1.jpg" /></td>
                    </tr>
                    </table>
                                <br />
                                <span class="thumbnail-text">1080 P Car Video Recorder</span>
                                <span class="thumbnail-text-red">Price : Rs100 - Rs 300</span>
                                <span class="thumbnail-text">Order Range : 1-100 Pieces</span>
                            </div>
                            
                           <div style="float:left;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="v-height-scroll">
                    <tr valign="middle">
                        <td align="center"><img alt="" src="pro-img/img_1.jpg" /></td>
                    </tr>
                    </table>
                                <br />
                                <span class="thumbnail-text">1080 P Car Video Recorder</span>
                                <span class="thumbnail-text-red">Price : Rs100 - Rs 300</span>
                                <span class="thumbnail-text">Order Range : 1-100 Pieces</span>
                            </div>
                           
                           <div style="float:left;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="v-height-scroll">
                    <tr valign="middle">
                        <td align="center"><img alt="" src="pro-img/img_1.jpg" /></td>
                    </tr>
                    </table>
                                <br />
                                <span class="thumbnail-text">1080 P Car Video Recorder</span>
                                <span class="thumbnail-text-red">Price : Rs100 - Rs 300</span>
                                <span class="thumbnail-text">Order Range : 1-100 Pieces</span>
                            </div>
                            
                            <div style="float:left;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="v-height-scroll">
                    <tr valign="middle">
                        <td align="center"><img alt="" src="pro-img/img_1.jpg" /></td>
                    </tr>
                    </table>
                                <br />
                                <span class="thumbnail-text">1080 P Car Video Recorder</span>
                                <span class="thumbnail-text-red">Price : Rs100 - Rs 300</span>
                                <span class="thumbnail-text">Order Range : 1-100 Pieces</span>
                            </div>
                             
                           <div style="float:left;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="v-height-scroll">
                    <tr valign="middle">
                        <td align="center"><img alt="" src="pro-img/img_1.jpg" /></td>
                    </tr>
                    </table>
                                <br />
                                <span class="thumbnail-text">1080 P Car Video Recorder</span>
                                <span class="thumbnail-text-red">Price : Rs100 - Rs 300</span>
                                <span class="thumbnail-text">Order Range : 1-100 Pieces</span>
                            </div>
                           
                            <div style="float:left;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="v-height-scroll">
                    <tr valign="middle">
                        <td align="center"><img alt="" src="pro-img/img_1.jpg" /></td>
                    </tr>
                    </table>
                                <br />
                                <span class="thumbnail-text">1080 P Car Video Recorder</span>
                                <span class="thumbnail-text-red">Price : Rs100 - Rs 300</span>
                                <span class="thumbnail-text">Order Range : 1-100 Pieces</span>
                            </div>
                            
                           <div style="float:left;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="v-height-scroll">
                    <tr valign="middle">
                        <td align="center"><img alt="" src="pro-img/img_1.jpg" /></td>
                    </tr>
                    </table>
                                <br />
                                <span class="thumbnail-text">1080 P Car Video Recorder</span>
                                <span class="thumbnail-text-red">Price : Rs100 - Rs 300</span>
                                <span class="thumbnail-text">Order Range : 1-100 Pieces</span>
                            </div>
                            
                            <div style="float:left;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="v-height-scroll">
                    <tr valign="middle">
                        <td align="center"><img alt="" src="pro-img/img_1.jpg" /></td>
                    </tr>
                    </table>
                                <br />
                                <span class="thumbnail-text">1080 P Car Video Recorder</span>
                                <span class="thumbnail-text-red">Price : Rs100 - Rs 300</span>
                                <span class="thumbnail-text">Order Range : 1-100 Pieces</span>
                            </div>
                            
                            <div style="float:left;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="v-height-scroll">
                    <tr valign="middle">
                        <td align="center"><img alt="" src="pro-img/img_1.jpg" /></td>
                    </tr>
                    </table>
                                <br />
                                <span class="thumbnail-text">1080 P Car Video Recorder</span>
                                <span class="thumbnail-text-red">Price : Rs100 - Rs 300</span>
                                <span class="thumbnail-text">Order Range : 1-100 Pieces</span>
                            </div>
                            
                           <div style="float:left;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="v-height-scroll">
                    <tr valign="middle">
                        <td align="center"><img alt="" src="pro-img/img_1.jpg" /></td>
                    </tr>
                    </table>
                                <br />
                                <span class="thumbnail-text">1080 P Car Video Recorder</span>
                                <span class="thumbnail-text-red">Price : Rs100 - Rs 300</span>
                                <span class="thumbnail-text">Order Range : 1-100 Pieces</span>
                            </div>
                             
                            <div style="float:left;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="v-height-scroll">
                    <tr valign="middle">
                        <td align="center"><img alt="" src="pro-img/img_1.jpg" /></td>
                    </tr>

                    </table>
                                <br />
                                <span class="thumbnail-text">1080 P Car Video Recorder</span>
                                <span class="thumbnail-text-red">Price : Rs100 - Rs 300</span>
                                <span class="thumbnail-text">Order Range : 1-100 Pieces</span>
                            </div>
                            
                           <div style="float:left;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="v-height-scroll">
                    <tr valign="middle">
                        <td align="center"><img alt="" src="pro-img/img_1.jpg" /></td>
                    </tr>
                    </table>
                                <br />
                                <span class="thumbnail-text">1080 P Car Video Recorder</span>
                                <span class="thumbnail-text-red">Price : Rs100 - Rs 300</span>
                                <span class="thumbnail-text">Order Range : 1-100 Pieces</span>
                            </div>
                           
                           <div style="float:left;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="v-height-scroll">
                    <tr valign="middle">
                        <td align="center"><img alt="" src="pro-img/img_1.jpg" /></td>
                    </tr>
                    </table>
                                <br />
                                <span class="thumbnail-text">1080 P Car Video Recorder</span>
                                <span class="thumbnail-text-red">Price : Rs100 - Rs 300</span>
                                <span class="thumbnail-text">Order Range : 1-100 Pieces</span>
                            </div>
                           
                            <div style="float:left;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="v-height-scroll">
                    <tr valign="middle">
                        <td align="center"><img alt="" src="pro-img/img_1.jpg" /></td>
                    </tr>
                    </table>
                                <br />
                                <span class="thumbnail-text">1080 P Car Video Recorder</span>
                                <span class="thumbnail-text-red">Price : Rs100 - Rs 300</span>
                                <span class="thumbnail-text">Order Range : 1-100 Pieces</span>
                            </div>
                            
                           <div style="float:left;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="v-height-scroll">
                    <tr valign="middle">
                        <td align="center"><img alt="" src="pro-img/img_1.jpg" /></td>
                    </tr>
                    </table>
                                <br />
                                <span class="thumbnail-text">1080 P Car Video Recorder</span>
                                <span class="thumbnail-text-red">Price : Rs100 - Rs 300</span>
                                <span class="thumbnail-text">Order Range : 1-100 Pieces</span>
                            </div>
                            
                        </div>
       
       <!-- image scrolling end -->
       
       
    </div>
    
    <!-- left panel end -->
    
    
    
     
     
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
