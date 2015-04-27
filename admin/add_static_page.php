<?php
include_once 'access_check.php';
include_once '../DBUtil.php';
include_once '../Util.php';
$message = "";
	$dbObj = new DBUtil();
	
	if(!empty($_POST['page_id'])) {
		
		$dbObj->addStaticPage($_POST['page_id'], $_POST['page_title'], $_POST['page_description'], $_POST['page_code']);
		$message = "Page Content Modified Sucessfully!";
	}
	
	
	$arrPage = array('ABOUT_US' => 'About Us', 'CONTACT_US' => 'Contact Us','TERMS' => 'Terms & Condition',
						'PRIVACY_POLICY' => 'Privacy Policy','FAQS' => 'FAQs','COD' => 'Cash on Delivery',
						'HOW_WORKS' => 'How It Works', 'RETURN_POLICY' => 'Return Policy');
	if(!empty($_REQUEST['page_code'])) {
		$arrDetails = $dbObj->getStaticPageByPage($_REQUEST['page_code']);
		$arrDetails = $arrDetails[0];
	}
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<?php include("common_tinymce.php");?>
<script language="javascript" src="ajax_js.js"></script>
<script language="javascript" type="text/javascript">
function validate()
{
	var doc=document.form1;
	if(doc.txtcat.value=="")
	{
			alert("Please enter Sub category name.");
			doc.txtcat.focus();
			return false;
	}
}
function loadPage(val) {
	if(val != '') {
		window.location = 'add_static_page.php?page_code=' + val;
	}
}
</script>
</head>
<body >
<table width="100%" height="100%" align="center" cellpadding="0" cellspacing="0"  bordercolor="#5181BF">
  <tr>
    <td height="41"><?php include('head.php');?></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"  valign="top" ><table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>                                
    <td width="17" align="left" valign="top" bgcolor="#b5f971" class="red" style="padding:0px; margin:0px;"><?php include('left_mnu.php');?></td>
                                    
          <td width="1392" align="center" valign="top" bgcolor="" class="red">
                  <form method="post"  name="form1" id="form1" enctype="multipart/form-data" onSubmit="return validate()">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="40"><span class="head_ing">&nbsp;&nbsp;<strong>&nbsp;Add Static Pages</strong></span></td>
              </tr>
                <tr bgcolor="#FFFFFF">
                <td align="center" valign="top">
                 <select name="page_code" onchange="avascript:loadPage(this.value)"><option value="">- Select Page -</option>  			
                <?php foreach ($arrPage as $key => $val) { 
                $selected = "";
			    if($key == $_REQUEST['page_code']) {$selected = "selected=selected";}	
     			?>
     			<option <?php echo $selected?> value="<?php echo $key?>"><?php echo $val?></option>            	
                <?php }?></select>
                </td>
                </tr>
              <tr>
                <td height="40" class="message">&nbsp;<?php echo $message?>&nbsp;</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td align="center" valign="top">
                <table width="50%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                  <tr>
                    <td height="27" colspan="2" bgcolor="#33c7701"><strong class="white">&nbsp;Add Details </strong></td>
                  </tr>
                <!--   <tr bgcolor="#FFFFFF">
                    <td height="40" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Image</strong> :</td>
                    <td colspan="-2" align="left" nowrap="nowrap">
                    <input type="file" name="image" style="width:200px" >
        	      </tr>
                  <tr bgcolor="#FFFFFF">
                    <td height="40" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Image Tagline </strong>:</td>
                    <td colspan="-2" align="left" nowrap="nowrap"><label for="img_tagline"></label>
                      <input name="img_tagline" type="text" id="img_tagline" value="<?php echo $img_tagline; ?>"></td>
                  </tr> -->
           
                      <tr align="center" bgcolor="#FFFFFF" >
                                    <td height="30" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Page Title :</strong></td>
                                    <td colspan="-2" align="left" nowrap="nowrap" ><label for="page_title"></label>
                        <input name="page_title" type="text" id="page_title" value="<?php echo $arrDetails['page_title']?>"> 
                        <input type="hidden" name="page_id" value="<?php echo $arrDetails['page_id']?>" >
                      </tr> 
                      <tr align="center" bgcolor="#FFFFFF" >
                    <td height="30" align="left" nowrap="nowrap" bgcolor="#FFFFFF">Page Description</strong></td>
                    <td colspan="-2" align="left" nowrap="nowrap" ><textarea name="page_description" id="page_description" cols="140" rows="25" ><?php echo $arrDetails['page_description']?></textarea></td>
                  </tr>
                    
                  </tr>
                     <!-- <tr align="center" bgcolor="#FFFFFF" >
                        <td height="30" align="center" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF">Sidebar :</td>
                        <td height="30" align="left" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF"><input type="radio" name="chk_sidebar" id="radio" value="yes" <?php // if($sidebar=='yes') { echo "checked"; } ?>>                          
                        Yes 
                        <input type="radio" name="chk_sidebar" id="radio2" value="no" > 
                        No</td>
                      </tr>-->
                      <tr align="center" bgcolor="#FFFFFF" >
                    <td height="30" colspan="2" align="center" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF"><em>
                        <input name="submit" type="submit"  value="Submit" />
                        &nbsp;
                        <INPUT name="button" TYPE="button" onClick="window.location='add_static_page.php'" value="Reset">
                    </em></td>
                    </tr>
                  <tr align="center" bgcolor="#3c7701" >
                    <td height="27" colspan="2" align="left" nowrap="nowrap" bgcolor="#3c7701">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
            </table>
                  </form>
                  </td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"  valign="top" height="20">
      <?php include("footer.inc.php"); ?>
    </td>
  </tr>
</table>
<script language="JavaScript" type="text/JavaScript">
function set_page_limit(records){
document.search_product.action="<?php echo $file_name?>?action=search_product&per_page="+records;
document.search_product.submit();
}
</script>

</body>
</html>
