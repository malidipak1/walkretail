<?php
include_once 'access_check.php';
ob_start(); 
include("database.inc.php");
   $cat_id=$_REQUEST['catid'];
   
   $parent_catid=$_REQUEST['parent_catid'];
   $sql_prod = ("SELECT * FROM categories where catid= '".$_REQUEST['catid']."'");
   //$products_id=$_REQUEST['product_id'];
   $prod_results=mysql_query($sql_prod);
   $num=mysql_num_rows($prod_results);
   $catname="";
   $i=0;
    if($num>0)
          {
        $prod_row = mysql_fetch_row($prod_results);
        $parent_id=$prod_row[1];
        while($parent_id!=0)
        {
                $sql=mysql_query("select * from categories where catid='$parent_id'");
                $result=mysql_fetch_row($sql);
                $parent_id=$result[1];
                $catname[$i+1]=$result[0];
                $i++;
                
        }
        }
        $lcid=$catname[1];
        $catname=array_reverse($catname);
        $cat_path = implode(":", $catname);
 $cnt=count($catname);

if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit')
{
        $cats_id=$_REQUEST['cats_id'];
        $catname=$_REQUEST['catname'];
		$catlink=$_REQUEST['catlink'];
		//echo "yes UPDATE categories SET catname = '$catname', catlink = '$catlink' WHERE catid = '$cats_id'";exit;
        $sql      =  mysql_query("UPDATE categories SET catname = '$catname', cat_link = '$catlink' WHERE catid = '$cats_id'");
        $result   =  mysql_num_rows($sql);
        header('location:view_category.php?message=Updated Sucessfully');
exit();
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=='update')
{       
        $catid= $_REQUEST['cats_id'];
         $p_catid=$_REQUEST['categ'];
        $catname=$_REQUEST['catname'];
		$catlink=$_REQUEST['catlink'];
        mysql_query("UPDATE categories SET parent_id= '$p_catid', catname='$catname', cat_link='$catlink' WHERE catid='$catid'");
        header('location:view_sub_category.php?action=view_sub_cat&catid='.$_REQUEST['parent_catid'].'&message=Updated Sucessfully');
        exit();
}
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/css.css" rel="stylesheet" type="text/css">
<script language="javascript" src="ajax_js.js"></script>
<script language="javascript" src="ajax_js1.js"></script>
<script language="javascript">
function validate()
{
        var doc=document.form1;
        if(doc.catname.value=="")
        {
                alert("Please enter category name.");
                doc.catname.focus();
                return false;
        }
        if(doc.categ.value==doc.cats_id.value)
        {
                alert("A category cannot be saved under itself");
                return false;
        }
}
</script>

<style type="text/css">
<!--
.style2 {color: #FFFFFF}
-->
</style>
</head>
<body onLoad="view_sub_category1('<?php echo $cat_path;?>');">
<table width="100%" height="100%" align="center" cellpadding="0" cellspacing="0"  bordercolor="#5181BF">
  <tr>
    <td height="41"><?php include('head.php');?></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"  valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
                                    <td width="182" align="left" valign="top" bgcolor="#b5f971" class="red" style="padding:0px; margin:0px;"><?php include('left_mnu.php');?></td>
                                    
          <td width="100%" align="center" valign="top" bgcolor="" class="red">
                  
                  <form method="post"  name="form1" id="form1" ACTION="edit_sub_category.php?action=update" onSubmit="return validate()">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="40"><strong class="head_ing">Edit Menu</strong></td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="37%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                  <tr>
                    <td height="27" colspan="2" bgcolor="#3c7701"><p><span class="style2"><strong>Edit</strong><strong> Menu</strong></span></p></td>
                  </tr>
                  <?php if(isset($_REQUEST['message']) && $_REQUEST['message']!=''){?>
                  <tr>
                    <td height="28" colspan="5" align="center" bgcolor="#FFFFFF" class="red"><?php echo $_REQUEST['message'];?> </td>
                  </tr>
                  <?php }?>
                  <tr bgcolor="#FFFFFF">
                    <td align="left" nowrap="nowrap" >&nbsp;&nbsp;<strong>Menu
                      <?php $s=1; ?>
                    </strong></td>
                    <td align="left" nowrap="nowrap" > <input name="categ" type="hidden" id="categ" value="<?php echo $lcid ; ?>"/>
                                                                                                          
                                                      <select onChange="chk_str(this.value,1);" id="<?php echo 'cat'.$s;?>" name="<?php echo 'cat'.$s;?>" >
                                                        <option value="">--Select Category--</option>
                                                        <?php
          
$sql      =  mysql_query("select * from categories where parent_id='0'");
//echo "select * from categories where parent_id='1'";
$result   =  mysql_num_rows($sql);
if($result>0)
{
     while($row =mysql_fetch_array($sql))
                    {?>
 <option value="<?php echo $row['catid'];?>" <?php if($row['catid']==$catname[0]){?>selected="selected"<?php } ?>> <?php echo ucfirst($row['catname']);?></option>
                                                        <?php }}?>
                          </select>
                                                      <br>
                                                      <br>
                                                      <div id="subcate">
                                                <div id="txtHint1" class="red">
                                                </div>
                        </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td width="33%" align="left" nowrap="nowrap" >&nbsp;&nbsp;<strong>Menu Name  :</strong> </td>
                    <?php 
                                        
        $result = mysql_query("SELECT * FROM categories WHERE catid='$cat_id'");
        $row = mysql_fetch_row($result);
        
?>
                    <td width="67%" align="left" nowrap="nowrap" ><input name="catname" type="text" id="catname" size="35" value="<?php echo $row[2]; ?>">
                        <input name="cats_id" type="hidden" id="cats_id" value="<?php echo $cat_id ;?>">
                        <input name="parent_catid" type="hidden" id="parent_catid" value="<?php echo $parent_catid ;?>">
                        
                        </td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td align="left" nowrap="nowrap" ><strong> &nbsp;&nbsp;Menu Link: (if linked to other site)</strong></td>
                    <td height="29" align="left" nowrap="nowrap" >
                      <input type="text" name="catlink" id="catlink" value="<?php echo $row[3]; ?>"></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td align="left" nowrap="nowrap" >&nbsp;</td>
                    <td height="29" align="left" nowrap="nowrap" ><input type="submit" name="Submit" value="Update" ></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td height="29" colspan="2" align="left" nowrap="nowrap" bgcolor="#3c7701" >&nbsp;</td>
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
</body>
</html>