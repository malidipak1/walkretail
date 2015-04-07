<?php 
include_once 'DBUtil.php';
include_once 'Util.php';
$dbObj = new DBUtil();

$message = "";
if(!empty($_POST)) {
	Util::enquiryMail("quote", $_POST);
	$message = "Thank you for your quotation request. We will get back to you soon.";
}

if(!empty($_REQUEST['prod_id'])) {
	$arrParam = array('prod_id' => $_REQUEST['prod_id']);
	$arrResult = $dbObj->getProducts($arrParam);
	$arrResult = $arrResult[0];
}
$image = Util::getImage($arrResult['image']);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Walk Retail</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">

	function validate(form) {
		if(form.name.value == '') {
			alert("Name can not be empty");
			return false;
		}	
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
		if(form.category.value == 0 || form.category.value = '') {
			alert("Please select Category");
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
       <form name="qoute" method="post" onsubmit="javascript: return validate(this);">
      <div class="form-pad1">
           
           
      <div class="property-panel-bg" align="center"> 
          <img src="<?php echo $image?>" width="227" height="128" alt="<?php echo $arrResult['prod_name']?>" /> </div>   
 
<div class="property-panel-bg"> <span class="property-panel-left">Name</span> <span class="poperty-panel-right">
                  <input name="name" type="text" class="sell2" />
                   <input name="prod_id" type="hidden" value="<?php echo $arrResult['prod_id']?>" />
                  <input name="prod_name" type="hidden" value="<?php echo $arrResult['prod_name']?>" />
                  <input name="image" type="hidden" value="<?php echo $arrResult['image']?>" />
                </span> </div>
                <div class="property-panel-bg"> <span class="property-panel-left">Email-Id</span> <span class="poperty-panel-right">
                  <input name="emailid" type="text" class="sell2" />
        </span> </div>
                <div class="property-panel-bg"> <span class="property-panel-left">Phone No.</span> <span class="poperty-panel-right">
                  <input name="phone" type="text" class="sell2" />
                </span> </div>
                <div class="property-panel-bg"> 
                  <span class="property-panel-left">Address</span> 
                     <span class="poperty-panel-right">
                     <textarea name="address" rows="4" class="sell3"></textarea>
                     </span> 
          </div>
                <div class="property-panel-bg"> <span class="property-panel-left">Category</span> <span class="poperty-panel-right">
                  <select id="category" name="category">
	             	<option value="0">-SELECT-</option>
	                   	<?php 
	                   	$arrParent = Util::getCategoryList();
	                   	foreach ($arrParent as $parent => $arrSubCat) { ?>
	             	<optgroup label="<?php echo $parent?>">
	             	<?php foreach ($arrSubCat as $id => $name) {  
	             		$selected = "";
	             		if($arrProduct['category'] == $id) { $selected = "selected='selected'"; }?>
	             	
	             		<option <?php echo $selected?> value="<?php echo $name?>"><?php echo $name?></option>
	             	<?php } ?>
	             	</optgroup>
	             	<?php }	?>
	             	</select>
                </span> </div>
               
        
          <div class="property-panel-bg"> 
                  <span class="property-panel-left">Message</span> 
                     <span class="poperty-panel-right">
                     <textarea name="message" rows="4" class="sell3"></textarea>
                     </span> 
          </div>
                <div class="property-panel-bg"> <span class="property-panel-left">Quantity</span> <span class="poperty-panel-right">
                  <input name="quantity" type="text" class="sell2" />
                </span> </div>
                      <div class="property-panel-bg"> 
                  <!-- <span class="property-panel-left">Comment</span> 
                     <span class="poperty-panel-right">
                     <textarea name=description rows="4" class="sell3"></textarea>
                     </span>  -->
          </div>         
                <br /><br /><br />
        <div class="property-panel-bg"> 
                  <span class="property-panel-left">&nbsp;</span> 
                    <div class="poperty-panel-right">
    <table width="50%" border="0" cellspacing="10" cellpadding="0">
    <tr>
        <td><input name="submit" type="submit" class="get-quote-btn"  style="text-align:center" value="." src="images/get-quotation.png"/></td>
        <td><a href="product-discription.php?prod_id=<?php echo $arrResult['prod_id']?>"><img src="images/back.png" width="184" height="36" alt="" /></a></td>
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
