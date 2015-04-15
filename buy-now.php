<?php 
include_once 'DBUtil.php';
include_once 'Util.php';
$dbObj = new DBUtil();

if(!empty($_REQUEST['prod_id'])) {
	$arrParam = array('prod_id' => $_REQUEST['prod_id']);
	$arrResult = $dbObj->getProducts($arrParam);
	$arrResult = $arrResult[0];
}

if($arrResult['min_quantity'] > MIN_BUYNOW) {
	header("Location: /get-quote.php?prod_id=".$_REQUEST['prod_id']);
	exit();
}

$message = "";
if(!empty($_POST)) {
	Util::enquiryMail("buynow", $_POST);
	$message = "Thank you for your enquiry. We will get back to you soon.";
	header("Location: /thank-you.php?ref=buynow");
	exit();
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
		var price = '<?php echo $arrResult['max_price']?>';
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
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
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
  <div class="buy-get-heading">Buy Now and Get Free Home Delivery</div>
    <div class="form-con1">
     <form name="buynow" method="post" onsubmit="MM_validateForm('emailid','','RisEmail','phone','','RisNum','name','','R','address','','R','pincode','','RisNum','message','','R');return document.MM_returnValue">
      <div class="form-pad1">
      <div class="property-panel-bg" align="center" style="padding:0 0 0 28px;"><table width="550" border="0" align="left" cellpadding="0" cellspacing="10">
  <tr>
    <td width="200" rowspan="4"><img src="<?php echo $image?>" width="227" alt="<?php echo $arrResult['prod_name']?>" /></td>
    <td><span class="head"><?php echo $arrResult['prod_name']?></span></td>
  </tr>
  <tr>
    <td><span>Min Rs. <?php echo $arrResult['min_price']?>/- Max Rs. <?php echo $arrResult['max_price']?></span></td>
  </tr>
  <tr>
    <td><span>Min <?php echo $arrResult['min_quantity']?>&nbsp; &ndash; Max <?php echo $arrResult['max_quantity']?>&nbsp; <?php echo $arrResult['quntity_type']?></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>   
  
<div class="property-panel-bg">
			<span class="property-panel-left">Email Id</span> <span class="poperty-panel-right">
                  <input name="emailid" type="text" class="sell2" id="emailid" />
                  <input name="prod_id" type="hidden" value="<?php echo $arrResult['prod_id']?>" />
                  <input name="prod_name" type="hidden" value="<?php echo $arrResult['prod_name']?>" />
                  <input name="image" type="hidden" value="<?php echo $arrResult['image']?>" />
                  
                </span> </div>
                <div class="property-panel-bg"> <span class="property-panel-left">Phone No.</span> <span class="poperty-panel-right">
                  <input name="phone" type="text" class="sell2" id="phone" />
        </span> </div>
                <div class="property-panel-bg"> <span class="property-panel-left">Name</span> <span class="poperty-panel-right">
                  <input name="name" type="text" class="sell2" id="name" />
                </span> </div>
                <div class="property-panel-bg"> <span class="property-panel-left">Address</span> <span class="poperty-panel-right">
                  <input name="address" type="text" class="sell2" id="address" />
                </span> </div>
                <div class="property-panel-bg"> <span class="property-panel-left">Pincode</span> <span class="poperty-panel-right">
                  <input name="pincode" type="text" class="sell2" id="pincode" />
                </span> </div>
                <div class="property-panel-bg"> <span class="property-panel-left">Quantity</span> <span class="poperty-panel-right">
                  <select name="quantity" onchange="javascript:setPrice(this.value)">
                  	<option value="0">-SELECT-</option>
                  	<?php for($i =1; $i <= MIN_BUYNOW; $i++) {?>
                  	<option value="<?php echo $i?>"><?php echo $i?></option>
                  	<?php }?>
                  </select>
                </span> </div>
                
                
                
        <div class="property-panel-bg"> 
                  <span class="property-panel-left">Price</span> 
                     <span class="poperty-panel-right">
                    <input id="price" name="price" type="text" class="sell2" readonly="readonly" />
                     </span> 
          </div>
          
          <div class="property-panel-bg"> 
          <span class="property-panel-left-full">Payment Mode : Cash on Delivery (COD)</span></div>
          <div class="property-panel-bg"> 
                  <span class="property-panel-left">Suggestions</span> 
                     <span class="poperty-panel-right">
                     <textarea name="message" rows="4" class="sell3" id="message"></textarea>
                     </span> 
          </div>     
                <br /><br /><br />
        <div class="property-panel-bg"> 
                  <span class="property-panel-left">&nbsp;</span> 
<div class="poperty-panel-right">
    <table width="50%" border="0" cellspacing="10" cellpadding="0">
    <tr>
        <td><input name="buy-now" type="submit" class="buy-now-btn-inn" value="." src="images/buy-now.png" /></td>
        <td> <a href="product-discription.php?prod_id=<?php echo $arrResult['prod_id']?>"><img src="images/back.png" alt="" /></a></td>
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
