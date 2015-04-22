<?php 
include_once 'DBUtil.php';
include_once 'Util.php';
$dbObj = new DBUtil();
$message = "";
$arrSupplier = array();
if(!empty($_POST)) {
	
	$arrParam = array('email' =>  $_POST['email']);
	$arrRecords = $dbObj->getSupplier($arrParam);
	
	if(count($arrRecords) <= 0 || !empty($_POST['supplier_id'])) {
		
		$logo = Util::uploadImage("logo");
		$gumasta_lic = Util::uploadDocument("licence");
		$is_partner = Util::uploadDocument("partner");
		$registration_lic = Util::uploadDocument("registration");
		
		$logo = (empty($gumasta_lic)) ? $arrRecords['logo'] : $logo;
		$gumasta_lic = (empty($gumasta_lic)) ? $arrRecords['gumasta_lic'] : $gumasta_lic;
		$registration_lic = (empty($registration_lic)) ? $arrRecords['registration_lic'] : $registration_lic;
		$is_partner = (empty($is_partner)) ? $arrRecords['is_partner'] : $is_partner;
		
		$id = $dbObj->addEditSupplier($_POST['supplier_id'], $_POST['name'], $_POST['user_name'], $_POST['password'], 0, $_POST['mobile'], $_POST['email'], $_POST['company'], 
				$_POST['address'], $_POST['city'], $_POST['state'], $_POST['zipcode'], $_POST['pancard'], $gumasta_lic, $registration_lic, $is_partner, $_POST['website'], $logo);

		header("Location: /registration-form-successful.php");
	} else {
		$message = "Supplier is Already Exist. Contact us more details.";
	}
}
$userNameReadOnly = "";
if(!empty($_REQUEST['id'])) {
	$arrParam = array('id' => $_REQUEST['id']);
	$arrSupplier = $dbObj->getSupplier($arrParam);
	$arrSupplier = $arrSupplier[0];
	$userNameReadOnly = "readonly='readonly'";
}
//print_r($arrSupplier);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Walk Retail</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
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
  	<div class="error"><?php echo $message?></div>
    <div class="left-2-panel">
     <form action="" enctype="multipart/form-data"  method="POST" onsubmit="MM_validateForm('name','','R','company','','R','email','','RisEmail','mobile','','RisNum','address','','R','user_name','','R','password','','R','city','','R','zipcode','','RisNum','state','','R','pancard','','R');return document.MM_returnValue">
     <div class="supp-con1">
        <div class="supp-left">
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Name</div>
             <div class="supplier-panel-right">
               <input name="name" type="text" class="field" id="name" value="<?php echo $arrSupplier['name']?>" />
               <input type="hidden" name="supplier_id" value="<?php echo $arrSupplier['id']?>">
             </div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company Name</div>
             <div class="supplier-panel-right"><input name="company" value="<?php echo $arrSupplier['company']?>" type="text" class="field" id="company" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Email Id</div>
             <div class="supplier-panel-right"><input name="email" <?php echo $userNameReadOnly?> type="text" class="field" id="email" value="<?php echo $arrSupplier['email']?>" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Website (If any)</div>
             <div class="supplier-panel-right"><input name="website" value="<?php echo $arrSupplier['website']?>" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Mobile No.</div>
            <div class="supplier-panel-right"><input name="mobile" type="text" class="field" value="<?php echo $arrSupplier['mobile']?>" id="mobile" maxlength="10" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company Address</div>
             <div class="supplier-panel-right"><input name="address" value="<?php echo $arrSupplier['address']?>" type="text" class="field" id="address" /></div>
          </div>
          <!--<div class="supplier-panel-bg">
             <div class="supplier-panel-left">Category</div>
             <div class="supplier-panel-right"><input name="category" type="text" class="field" /></div>
          </div>-->
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">User Name</div>
             <div class="supplier-panel-right"><input value="<?php echo $arrSupplier['user_name']?>" name="user_name" <?php echo $userNameReadOnly?> type="text" class="field" id="user_name" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Password</div>
             <div class="supplier-panel-right"><input name="password" value="<?php echo $arrSupplier['password']?>" type="text" class="field" id="password" /></div>
          </div>
         
        </div>
        <div class="supp-right">
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">City</div>
             <div class="supplier-panel-right"><input value="<?php echo $arrSupplier['city']?>" name="city" type="text" class="field" id="city" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Zip Code</div>
             <div class="supplier-panel-right"><input name="zipcode" value="<?php echo $arrSupplier['zipcode']?>" type="text" class="field" id="zipcode" maxlength="6" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">State</div>
             <div class="supplier-panel-right"><input name="state" value="<?php echo $arrSupplier['state']?>" type="text" class="field" id="state" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company PanCard</div>
             <div class="supplier-panel-right"><input name="pancard" value="<?php echo $arrSupplier['company_pan']?>" type="text" class="field" id="pancard" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Gumasta Licence
              <?php 
             $fileLic = UPLOAD_DOCS_DIR . $arrSupplier['gumasta_lic'];
             if (file_exists($fileLic) && !empty($arrSupplier['gumasta_lic'])) { ?>
             	<a href="/download.php?fileName=<?php echo $arrSupplier['gumasta_lic'];?>">Download</a>
             <?php }?>
             </div>
            <div class="supplier-panel-right"><input name="licence"  type="file"  id="licence" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company if Registered
              <?php 
             $fileLic = UPLOAD_DOCS_DIR . $arrSupplier['registration_lic'];
             if (file_exists($fileLic) && !empty($arrSupplier['registration_lic'])) { ?>
             	<a href="/download.php?fileName=<?php echo $arrSupplier['registration_lic'];?>">Download</a>
             <?php }?>
             </div>
             <div class="supplier-panel-right"><input name="registration" type="file"  id="registration" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company is in Partnership<br />
             or Propertier
              <?php 
             $fileLic = UPLOAD_DOCS_DIR . $arrSupplier['is_partner'];
             if (file_exists($fileLic) && !empty($arrSupplier['is_partner'])) { ?>
             	<a href="/download.php?fileName=<?php echo $arrSupplier['is_partner'];?>">Download</a>
             <?php }?></div>
             <div class="supplier-panel-right"><input name="partner" type="file"  id="partner" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Logo
              <?php 
             $fileLic = UPLOAD_DOCS_DIR . $arrSupplier['logo'];
             if (file_exists($fileLic) && !empty($arrSupplier['logo'])) { ?>
             	<a href="/download.php?fileName=<?php echo $arrSupplier['logo'];?>">Download</a>
             <?php }?>
             </div>
             <div class="supplier-panel-right"><input name="logo" type="file"  /></div>
          </div>
           <div class="supplier-panel-bg">
             <div class="supplier-panel-left"><br />
             </div>
             <div class="supplier-panel-right"><input type="submit" value="Register Now" /></div>
          </div>
          <!--<div class="supplier-panel-bg">
             <div class="supplier-panel-left">Make Payment Online</div>
             <div class="supplier-panel-right"><input name="make-payment-online" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Choose Currency</div>
             <div class="supplier-panel-right">
                <span>
                         <select name="Property_Category" class="sell4">                   
                         <option class="boldclass" >All Residential</option>
						 <option class="" value="Residential_Apartment">Residential Apartment</option>
						 <option class="" value="Independent_House_Villa">Independent House/Villa</option>
						 <option class="" value="Residential_Land">Residential Land</option>
						 <option class="" value="Independent_Builder_Floor">Independent/Builder Floor</option>
						 <option class="" value="Farm_House">Farm House</option>
						 <option class="" value="Studio_Apartment">Studio Apartment</option>
						 <option class="" value="Serviced_Apartments">Serviced Apartments</option>
						 <option class="" value="RNew_Projects">New Projects</option>
						 <option class="" value="ROther">Other</option>
						 <option class="boldclass">All Commercial</option>
						 <option class="" value="Commercial_Shops">Commercial Shops</option>
						 <option class="" value="Commercial_Showrooms">Commercial Showrooms</option>
						 <option class="" value="Commercial_Office_Space">Commercial Office/Space</option>
						 <option class="" value="Commercial_Land_Inst_Land">Commercial Land/Inst. Land</option>
						 <option class="" value="Hotel_Resorts">Hotel/Resorts</option>
						 <option class="" value="Guest-House_Banquet-Halls">Guest-House/Banquet-Halls</option>
						 <option class="" value="Time_Share">Time Share</option>
						 <option class="" value="Space_in_Retail_Mall">Space in Retail Mall</option>
						 <option class="" value="Office_in_Business_Park">Office in Business Park</option>
						 <option class="" value="Office_in_IT_Park">Office in IT Park</option>
						 <option class="" value="Ware_House">Ware House</option>
						 <option class="" value="Cold_Storage">Cold Storage</option>
						 <option class="" value="Factory">Factory</option>
						 <option class="" value="Manufacturing">Manufacturing</option>
						 <option class="" value="Business_center">Business center</option>
						 <option class="" value="CNew_Projects">New Projects</option>
						 <option class="" value="COther">Other</option>
						 <optgroup label='Land'  class='boldclass' ></optgroup>
						 <option class="" value="Residential_Land">Residential Land</option>
						 <option class="" value="Agricultural_Farm_Land">Agricultural/Farm Land</option>
						 <option class="" value="Commercial_Land_Inst_Land">Commercial Land/Inst. Land</option>
						 <option class="" value="Industrial Lands_Plots">Industrial Lands/Plots</option>
					</select>
                         </span>
             </div>-->
          </div>
          
        </div>
     </form>
    </div>
      
  </div>
    
    <!-- left panel end -->
    
    
    

    
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
