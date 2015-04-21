<?php
include_once 'access_check.php';
include_once '../DBUtil.php';
include_once '../Util.php';

$dbObj = new DBUtil();
if(!empty($_REQUEST['id']) && !empty($_REQUEST['action'] == 'delete')) {
	$dbObj->deletePremiumAds($_REQUEST['id']);
	header("Location: premium-ad.php?ads_type=" . $_REQUEST['ads_type']);
	
}

$arrAds = array();
if(!empty($_REQUEST['ads_type'])) {
	$arrAds = $dbObj->getPremiumAds($_REQUEST['ads_type']);
}
?>
<html>
<head>
<title>:::(Admin Panel) :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
 function change (val) {
	if(val != '')
	 	window.location = "premium-ad.php?ads_type=" + val;
 }

 </script>
</head>
<body>
<table width="100%" height="100%" align="center" cellpadding="0" cellspacing="0"  bordercolor="#5181BF">
  <tr>
    <td height="100"><?php include('head.php');?></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"  valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
                                    
                                    <td width="182" align="left" valign="top" bgcolor="#4c9309" class="red" style="padding:0px; margin:0px;"><?php include('left_mnu.php');?></td>
                                    <td width="100%" align="left" valign="top" bgcolor="" class="red"><table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0"  bordercolor="#111111">
                                      <tr>
                                        <td height="57" colspan="2" align="left"  valign="middle" class="head_ing">Manage Premium Advertise</td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" align="left"  valign="top" class="red">&nbsp; </td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" align="center"  valign="top" class="red">
                                        <select name="ads_type" onchange="change(this.value)">
                                        	<?php 
                                        	$select1 = ""; $select2 = "";
                                        		if($_REQUEST['ads_type'] == 'MAIN_ADS') {
                                        			$select1 = "selected=selected";
                                        		} else if($_REQUEST['ads_type'] == 'SUB_ADS') {
                                        			$select2 = "selected=selected";
                                        		}
                                        	?>
                                        	<option value="">- SELECT -</option>
                                        	<option <?php echo $select1?> value="MAIN_ADS">Main Ads</option>
                                        	<option <?php echo $select2?> value="SUB_ADS">Sub Ads</option>
                                        </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" align="left"  valign="top" class="red">&nbsp; </td>
                                      </tr>
                                      
                                      <tr>
									   <?php if(count($arrAds) <= 0){ ?>
									   <tr align="right"  bgcolor="#ffffff">
                                            <td colspan="10" height="" class="red">
	                                            <div align="center"> No Ads Yet! <br />
	                                            </div>
                                            </td>
	                                    </tr>
											<?php } else {?>	
								      	<td colspan="2" align="center" valign="top">
									  	<form name="search_product" method="post" action="view_images.php?action=search_product">
											<table width="95%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
										<tr align="center"  bgcolor="#3c7701">									
			                                                                        
                                          <td width="22%" class="white">Image</td>
                                          <td width="16%" class="white">Image Alt</td>
                                         <td width="16%" class="white">Image Link</td>
                                         <td width="8%" class="white">Edit</td>
                                            <td width="11%" class="white">Delete</td>
                     					 </tr>
                                          <!----------------------Start your loop------------------------------->
            
                                       <?php foreach ($arrAds as $eachAds) {?>
                                           <tr align="center">	
                                            
                                            <td width="22%" height="57" bgcolor="#FFFFFF">
											<img height="100px" width="100px" src="<?php echo Util::getAdsImage($eachAds['image_name']);?>" style="border: solid 0px #98a754;"  alt="<?php echo $eachAds['image_alt']?>" />
											</td>
                               <td width="16%"  bgcolor="#FFFFFF"><?php echo $eachAds['image_alt']?></td>
                                            <td width="16%"  bgcolor="#FFFFFF"><?php echo $eachAds['image_link'];?></td>
                                            <td width="8%"  bgcolor="#FFFFFF"><a href="add_new_premium-ad.php?ads_type=<?php echo $_REQUEST['ads_type']?>&id=<?php echo $eachAds['id']?>"> <img src="images/Edit.gif" width="12" height="12" alt="Edit"   border="0" /></a></td>
                                            <td width="11%"   bgcolor="#FFFFFF"><a href="premium-ad.php?action=delete&id=<?php echo $eachAds['id']?>" onClick="javascript: return confirm('Are you sure You want to delete the image ');"><img src="images/del.gif" width="12" height="10" border="0" /></a> </td>
                                          </tr>
                                          
                                      <?php }}?>    
                                          <tr>
                                          	<td colspan="6" ><a href="add_new_premium-ad.php?ads_type=<?php echo $_REQUEST['ads_type']?>">Click here</a> to add advs.</td>
                                          </tr>
                                         
                                          <!-----------------------End your loop here---------------------------->
                                        </table>
                </form></td>
                                      </tr>
                                    </table></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"  valign="top" height="20"><?php include("footer.inc.php"); ?></td>
  </tr>
</table>
</body>
</html>
<script language="JavaScript" type="text/JavaScript"></script>