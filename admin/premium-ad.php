<?php
include_once 'access_check.php';
include_once '../DBUtil.php';
include_once '../Util.php';

$dbObj = new DBUtil();
if(!empty($_REQUEST['id']) && ($_REQUEST['action'] == 'delete')) {
	$dbObj->deletePremiumAds($_REQUEST['id']);
	header("Location: premium-ad.php?ads_type=" . $_REQUEST['ads_type']);
	exit;	
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
                                        <select id="ads_type" name="ads_type" onChange="change(this.value)">
                                        	<option value="">- SELECT -</option>
                                        	<option value="MAIN_ADS">Main Ads</option>
                                        	<option value="SUB_ADS">Sub Ads</option>
                                        	<option value="SIDE_ADS">Side Ads</option>
                                        </select>
                                  <script type="text/javascript">
										var defaultVal = '<?php echo $_REQUEST['ads_type']?>';
										var obj = document.getElementById("ads_type");
										var len = obj.length;
						
										for(var i=0; i<len; i++) {
											if(defaultVal == obj.options[i].value) {
												obj.selectedIndex = i;
											}
										}
						             </script>
						                    
                                        
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
									  	<table width="95%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
										<tr align="center"  bgcolor="#3c7701">									
			                                                                        
                                          <td width="22%" class="white">Image</td>
                                          <td width="16%" class="white">Image Alt</td>
                                         <td width="16%" class="white">Image Link</td>
                                          <td width="16%" class="white">Sequence</td>
                                            <td width="11%" class="white">Edit</td>
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
                                            <td width="16%"  bgcolor="#FFFFFF"><?php echo $eachAds['seq'];?></td>
                                            <td width="11%"   bgcolor="#FFFFFF"><a href="add_new_premium-ad.php?ads_type=<?php echo $_REQUEST['ads_type']?>&id=<?php echo $eachAds['id']?>"><img src="images/Edit.gif" width="12" height="10" border="0" /></a> </td>
                                            <td width="11%"   bgcolor="#FFFFFF"><a href="premium-ad.php?action=delete&id=<?php echo $eachAds['id']?>" onClick="javascript: return confirm('Are you sure You want to delete the image ');"><img src="images/del.gif" width="12" height="10" border="0" /></a> </td>
                                          </tr>
                                          
                                      <?php }}?>    
                                          <tr>
                                          	<td colspan="4" ><a href="add_new_premium-ad.php?ads_type=<?php echo $_REQUEST['ads_type']?>">Click here</a> to add advs.</td>
                                          </tr>
                                         
                                          <!-----------------------End your loop here---------------------------->
                                        </table>
                </td>
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