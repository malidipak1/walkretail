<?php 
include_once 'DBUtil.php';
include_once 'Util.php';
$dbObj = new DBUtil();

if(!empty($_REQUEST['prod_id'])) {
	$arrParam = array('prod_id' => $_REQUEST['prod_id']);
	$arrResult = $dbObj->getProducts($arrParam);
	$arrResult = $arrResult[0];
}
$message = "";
if(!empty($_POST)) {
	Util::enquiryMail("buynow", $_POST);
	$message = "Thank you for your enquiry. We will get back to you soon.";
}

$image = Util::getImage($arrResult['image']);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Walk Retail</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	function setPrice(quantity) {
		if(quantity < 1) {
			document.getElementById("price").value = '';
			return;
		}
		var price = '<?php echo  $arrResult['price']?>';
		var totalPrice = quantity * price;

		document.getElementById("price").value = totalPrice;
	}

	function validate(form) {
		if(form.emailid.value == '') {
			alert("Email can not be empty");
			return false;
		}
		if(form.phone.value == '') {
			alert("Phone can not be empty");
			return false;
		}
		if(form.quantity.value == '') {
			alert("Please select Quantity");
			return false;
		}
		if(form.name.value == '') {
			alert("Name can not be empty");
			return false;
		}	
		return true;
}
	
</script>
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
  	<div align="center" style="color: red"><?php echo $message?></div>
  
    <div class="form-con1">
     <form name="buynow" method="post" onsubmit="return validate(this);">
      <div class="form-pad1">
      <div class="property-panel-bg" align="center"> 
          <img src="<?php echo $image?>" width="227" height="128" alt="<?php echo $arrResult['prod_name']?>" /> </div>   
  
<div class="property-panel-bg">
			<span class="property-panel-left">Email Id</span> <span class="poperty-panel-right">
                  <input name="emailid" type="text" class="sell2" />
                  <input name="prod_id" type="hidden" value="<?php echo $arrResult['prod_id']?>" />
                  <input name="prod_name" type="hidden" value="<?php echo $arrResult['prod_name']?>" />
                  <input name="image" type="hidden" value="<?php echo $arrResult['image']?>" />
                  
                </span> </div>
                <div class="property-panel-bg"> <span class="property-panel-left">Phone No.</span> <span class="poperty-panel-right">
                  <input name="phone" type="text" class="sell2" />
        </span> </div>
                <div class="property-panel-bg"> <span class="property-panel-left">Name</span> <span class="poperty-panel-right">
                  <input name="name" type="text" class="sell2" />
                </span> </div>
                <div class="property-panel-bg"> <span class="property-panel-left">Address</span> <span class="poperty-panel-right">
                  <input name="address" type="text" class="sell2" />
                </span> </div>
                <div class="property-panel-bg"> <span class="property-panel-left">Pincode</span> <span class="poperty-panel-right">
                  <input name="pincode" type="text" class="sell2" />
                </span> </div>
                <div class="property-panel-bg"> <span class="property-panel-left">Quantity</span> <span class="poperty-panel-right">
                  <select name="quantity" onchange="javascript:setPrice(this.value)">
                  	<option value="0">-SELECT-</option>
                  	<option value="1">1</option>
                  	<option value="2">2</option>
                  	<option value="3">3</option>
                  </select>
                </span> </div>
        <div class="property-panel-bg"> 
                  <span class="property-panel-left">Price</span> 
                     <span class="poperty-panel-right">
                    <input id="price" name="price" type="text" class="sell2" readonly="readonly" />
                     </span> 
          </div>
                   <div class="property-panel-bg"> 
                  <span class="property-panel-left">Comments</span> 
                     <span class="poperty-panel-right">
                     <textarea name="message" rows="4" class="sell3"></textarea>
                     </span> 
          </div>     
                <br /><br /><br />
        <div class="property-panel-bg"> 
                  <span class="property-panel-left">&nbsp;</span> 
<div class="poperty-panel-right">
    <table width="50%" border="0" cellspacing="10" cellpadding="0">
    <tr>
        <td><input name="buy-now" type="submit" class="buy-now-btn" value="." src="images/buy-now.png" /></td>
        <td> <a href="product-discription.php?prod_id=<?php echo $arrResult['prod_id']?>"><img src="images/back.png" width="184" height="36" alt="" /></a></td>
    </tr>
    </table>
</div> 
          </div>
                
                
</div>
</form> 
            </div>
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
