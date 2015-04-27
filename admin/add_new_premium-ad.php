<?php 
include_once 'access_check.php';
include_once '../DBUtil.php';
$arrAds = array();
$dbObj = new DBUtil();
$image = "";
if(!empty($_POST)) {
	if(!empty($_FILES['image'])) {
		$image = Util::uploadImage ( "image" , true);
	} else {
		$image = $_POST['hidden_image'];
	}
	if(!empty($image)) {
		$dbObj->addEditAds($image, $_POST['image_alt'], $_POST['image_link'], $_POST['ads_type'],$_POST['seq'], $_POST['id']);
	
		header("Location: premium-ad.php?ads_type=".$_POST['ads_type']);
	}
}

if(!empty($_REQUEST['id'])) {
	
	$arrAds = $dbObj->getPremiumAdsById($_REQUEST['id']);
	$arrAds = $arrAds[0];
}

?>
<html>
<head>
<title>:::(Admin Panel) :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">

<script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<?php include("common_tinymce.php");?>
<script type="text/javascript">
 function change (val) {
	if(val != '')
	 	window.location = "add_new_premium-ad.php?ads_type=" + val;
 }

 </script>
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
                                    <td width="100%" align="center" valign="top" bgcolor="" class="red"><table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0"  bordercolor="#000000">
                                      <tr>
                                        <td valign="middle" height="20"  align="left"><table width="767" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              
                      <td width="399" height="57" class="head_ing"> 
                       
                        Add New Premium Ad</td>
                                              <td width="368"  align="right">&nbsp;</td>
                                            </tr>
                                        </table></td>
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
                                      
                                      
                                      <tr>
                                        <td bordercolor="#FFFFFF"  valign="top" align="center">
                                     <?php if(!empty($_REQUEST['ads_type'])) {?>   
                                        <table width="100%" border="0" cellspacing="4" cellpadding="0">
                                              <tr>
                                                <td  align="center" class="red">
                                              </tr>
                                              <tr>	<td align="center" valign="top" >
		<form action="" enctype="multipart/form-data"  onsubmit ="return check_form();" method="post" name="header" id="header">
 <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">

 <tr align="center" bgcolor="#7D4B00" >
   <td height="25" colspan="2" align="center" bgcolor="#3c7701">
     <div class="white">Add Image</div></td>
 </tr>
    <tr align="center" bgcolor="#FFFFFF">
      <td width="18%" height="33" align="left" valign="middle">Image</td>
      <td width="82%"  align="left">
        <?php if(isset($arrAds['image_name'])){?>
        <img height="300px" width="500px" src="/imgProd/<?php echo $arrAds['image_name'];?>"> 
        <?php }?>
        <input type="file" name="image" style="width:200px" >
        <input type="hidden" name="hidden_image" value="<?php echo $arrAds['image_name']?>">
        <input type="hidden" name="ads_type" value="<?php echo $_REQUEST['ads_type']?>">
        </td>
    </tr>
   
    <tr align="center" bgcolor="#FFFFFF" valign="top">
      <td height="33" align="left">Image Alt</td>
      <td  align="left">
      	<input type="text" name="image_alt" value="<?php echo $arrAds['image_alt']?>" />
      </td>
      </tr>
    <tr align="center" bgcolor="#FFFFFF" valign="top">
      <td height="33" align="left" valign="top">Image Url</td>
      <td  align="left"><input type="text" name="image_link" id="image_link" value="<?php echo $arrAds['image_link']?>" />
        </td>
    </tr>
    <tr align="center" bgcolor="#FFFFFF" valign="top">
      <td height="33" align="left" valign="top">Sequence</td>
      <td  align="left"><input type="text" name="seq" id="seq" value="<?php echo $arrAds['seq']?>" />
        </td>
    </tr>
    <tr bgcolor="#7D4B00">
    	<td height="33" colspan="5" align="center" bgcolor="#3c7701">
    		<input name="submit" type="submit" value="Upload"/>
    		<input type="hidden" name="ads_type" value="<?php echo $_REQUEST['ads_type']?>">
    	  	<input type="hidden" name="id" value="<?php echo $arrAds['id']?>">
    	  </td>
    </tr>
    </table>
    </form></td>
    </tr>
    </table>
    <?php }?>
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
<script language="JavaScript">
function check_form() {
	var flag = isNaN(document.header.seq.value);
	if( flag ) {
		alert("Sequence: Only Number allowed");
		document.header.seq.value= "";
		document.header.seq.focus();
		return false;
	} else {
		return true;
	}
	
}

</script>