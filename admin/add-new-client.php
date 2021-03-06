<?php 
include_once 'access_check.php';
include_once '../DBUtil.php';
include_once '../Util.php';

$dbObj = new DBUtil();

$message = "";

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
	
		$id = $dbObj->addEditSupplier($_POST['supplier_id'], $_POST['name'], $_POST['user_name'], $_POST['password'], $_POST['status'], $_POST['mobile'], $_POST['email'], $_POST['company'], 
			$_POST['address'], $_POST['city'], $_POST['state'], $_POST['zipcode'], $_POST['company_pan'], $gumasta_lic, $registration_lic, $is_partner, $_POST['website'], 
				$_POST['company_type'], $_POST['is_registration'], $logo);

		header("Location: view-clients.php");
	} else {
		$message = "Supplier is Already Exist. Contact us for more details.";
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
?>
<html>
<head>
<title>:::(Admin Panel) :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">

<script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<?php include("common_tinymce.php");?>
</head>
<body>
<table width="100%" height="100%" align="center" cellpadding="0" cellspacing="0"  bordercolor="#5181BF">
  <tr>
    <td height="92"><?php include('head.php');?></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"  valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
                                    
                                    <td width="182" align="left" valign="top" bgcolor="#D6E7F6" class="red" style="padding:0px; margin:0px;"><?php include('left_mnu.php');?></td>
                                    <td width="100%" align="center" valign="top" bgcolor="" class="red">
                                    <form action="" method="post" enctype="multipart/form-data"  >
                                    <table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0"  bordercolor="#000000">
                                      <tr>
                                        <td valign="middle" height="20"  align="left"><table width="767" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              
                      <td width="399" height="57" class="head_ing">  Add New Client</td>
                                              <td width="368" align="right">&nbsp;
                                              <?php 
									           $fileLic = UPLOAD_IMAGE_DIR . $arrSupplier['logo'];
									             if (file_exists($fileLic) && !empty( $arrSupplier['logo'])) { ?>
									             	<img width="200px" height="200px" src="<?php echo DOWNLOAD_IMAGE_DIR.$arrSupplier['logo'];?>" alt="<?php echo $arrSupplier['name']?>" />
									             <?php }?>
                                              </td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                      <tr>
                                      <td class="error"><?php echo $message?></td>
                                      </tr>
                                      
                                      <tr>
                                        <td bordercolor="#FFFFFF"  valign="top" align="center">
                                         <table width="100%" border="0" cellspacing="4" cellpadding="0">
                                              
                                              <tr>	
                                              <td valign="top" >
                                              
                                             <div class="supp-con1">
        <div class="supp-left">
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Name</div>
             <div class="supplier-panel-right"><input name="name" type="text" class="field" id="name" value="<?php echo $arrSupplier['name']?>" />
             	<input type="hidden" name="supplier_id" value="<?php echo $arrSupplier['id']?>">
             </div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company Name</div>
             <div class="supplier-panel-right"><input name="company" type="text" class="field" id="company" value="<?php echo $arrSupplier['company']?>" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Email Id</div>
             <div class="supplier-panel-right"><input name="email" type="text" class="field" id="email" value="<?php echo $arrSupplier['email']?>" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Website (If any)</div>
             <div class="supplier-panel-right"><input name="website" type="text" class="field" value="<?php echo $arrSupplier['website']?>" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Mobile</div>
            <div class="supplier-panel-right"><input name="mobile" type="text" maxlength="10" class="field" id="mobile" value="<?php echo $arrSupplier['mobile']?>" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company Address</div>
             <div class="supplier-panel-right"><input name="address" type="text" class="field" id="address" value="<?php echo $arrSupplier['address']?>" /></div>
          </div>
         <!-- <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Category</div>
             <div class="supplier-panel-right"><input name="category" type="text" class="field" /></div>
          </div>-->
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">User Name</div>
             <div class="supplier-panel-right"><input name="user_name" <?php echo $userNameReadOnly?> type="text" class="field" id="user_name" value="<?php echo $arrSupplier['user_name']?>" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Password</div>
             <div class="supplier-panel-right"><input name="password" type="text" class="field" value="<?php echo $arrSupplier['password']?>" /></div>
          </div>
         
        </div>
        <div class="supp-right">
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">City</div>
             <div class="supplier-panel-right"><input name="city" type="text" class="field" value="<?php echo $arrSupplier['city']?>" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Zip Code</div>
             <div class="supplier-panel-right"><input name="zipcode" type="text" class="field" maxlength="6" id="zipcode" value="<?php echo $arrSupplier['zipcode']?>" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">State</div>
             <div class="supplier-panel-right"><input name="state" type="text" class="field" value="<?php echo $arrSupplier['state']?>" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company PanCard</div>
             <div class="supplier-panel-right"><input name="company_pan" type="text" maxlength="10" class="field" id="company_pan" value="<?php echo $arrSupplier['company_pan']?>" /></div>
          </div>
          
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Status</div>
             <div class="supplier-panel-right">
             	<select name="status">
             		<?php $y = ""; $n = "";
             		if($arrSupplier['status'] == 1) $y = "selected='selected'";
             		else $n = "selected='selected'";?>
             		<option <?php echo $y?> value="1">Yes</option>
             		<option <?php echo $n?> value="0">No</option>
             	</select>
             </div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Gumasta Licence
             <?php 
             $fileLic = UPLOAD_DOCS_DIR . $arrSupplier['gumasta_lic'];
             if (file_exists($fileLic) && !empty($arrSupplier['gumasta_lic']))  { ?>
             	<a href="/download.php?fileName=<?php echo $arrSupplier['gumasta_lic'];?>">Download</a>
             <?php }?>
             </div>
            <div class="supplier-panel-right"><input name="licence" type="file"  id="licence" /></div>
          </div>
          
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company is Registered</div>
             <div class="supplier-panel-right">
             <select name="is_registration" id="is_registration">
               <option>YES</option>
               <option>NO</option>
             </select></div>
              <script type="text/javascript">
				var defaultVal = '<?php echo $arrSupplier['is_registration']?>';
				var obj = document.getElementById("is_registration");
				var len = obj.length;

				for(var i=0; i<len; i++) {
					if(defaultVal == obj.options[i].value) {
						obj.selectedIndex = i;
					}
				}
             </script>
          </div>
          
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Registeration Document
              <?php 
             $fileLic = UPLOAD_DOCS_DIR . $arrSupplier['registration_lic'];
             if (file_exists($fileLic) && !empty( $arrSupplier['registration_lic'])) { ?>
             	<a href="/download.php?fileName=<?php echo $arrSupplier['registration_lic'];?>">Download</a>
             <?php }?>
             </div>
             <div class="supplier-panel-right"><input name="registration" type="file"  id="registration" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company is in Partnership<br />or Propertier</div>
             <div class="supplier-panel-right">
               <label for="select"></label>
               <select name="company_type" id="company_type">
                 <option value="Partnership">Partnership</option>
                 <option value="Propertier">Propertier</option>
               </select>
             </div>
              <script type="text/javascript">
				var defaultVal = '<?php echo $arrSupplier['company_type']?>';
				var obj = document.getElementById("company_type");
				var len = obj.length;

				for(var i=0; i<len; i++) {
					if(defaultVal == obj.options[i].value) {
						obj.selectedIndex = i;
					}
				}
             </script>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company Documents
              <?php 
             $fileLic = UPLOAD_DOCS_DIR . $arrSupplier['is_partner'];
             if (file_exists($fileLic) && !empty($arrSupplier['is_partner'])) { ?>
             	<a href="/download.php?fileName=<?php echo $arrSupplier['is_partner'];?>">Download</a>
             <?php }?>
             </div>
             <div class="supplier-panel-right"><input name="partner" type="file"  id="partner" /></div>
          </div>
           <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Logo
              <?php 
             $fileLic = UPLOAD_IMAGE_DIR . $arrSupplier['logo'];
             if (file_exists($fileLic) && !empty( $arrSupplier['logo'])) { ?>
             	<a href="/download.php?fileName=<?php echo $arrSupplier['logo'];?>">Download</a>
             <?php }?>
             </div>
             <div class="supplier-panel-right"><input name="logo" type="file"  id="logo" /></div>
          </div>
         <!-- <div class="supplier-panel-bg">
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
             </div>
          </div>-->
          
        </div>
      </div>
        </td>
    </tr>
    </table></td>
    </tr>
    <tr>
      <td align="center">
         <input name="Add Client" type="submit" value="Add Client">
      </td>
    </tr>
    </table>
                                    </form></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"  valign="top" height="20"><?php include("footer.inc.php"); ?></td>
  </tr>
</table>
</body>


</html>
<script language="JavaScript">
function check_form()
{	
	
}

</script>