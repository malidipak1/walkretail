<?php
session_start();
include("database.inc.php");
error_reporting(~E_ALL);
if(!isset($_SESSION['login']))
   {
     header('Location: index.php');
	 exit;
   }

###########################################  PAGING WITH PER PAGE            #####################################
$file_name			=	"view_teams.php"; // this is file name which is used during paging  , included at the bottom of the page
$paging_table_name	=	"team";
include("paging/paging_query.inc.php");

############################################ END PAGING WITH PER PAGE       ##############################################

/*if(isset($_REQUEST['category_id']) && $_REQUEST['category_id']!='')
{
	$query2="SELECT * FROM books WHERE book_category_id = '".$_REQUEST['category_id']."'";
	$rec=mysql_query($query2);
	$nume=mysql_num_rows($rec);
}*/
############################################ END PAGING WITH PER PAGE       ##############################################


if(!isset($_REQUEST['action']))		
{
	
	$sql=mysql_query("select * from team ORDER BY header_id LIMIT $eu, $limit");
	$result=mysql_num_rows($sql);
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{
	$sql	=	"DELETE FROM team where header_id ='".$_REQUEST['image_id']."' ";
	mysql_query($sql);
	
	if(file_exists("teams/".$_REQUEST['image_name']))
	{
		unlink("teams/".$_REQUEST['image_name']);
	}
	if(file_exists("teams/thumb1/".$_REQUEST['image_name']))
	{
		unlink("teams/thumb1/".$_REQUEST['image_name']);
	}
	if(file_exists("teams/thumb2/".$_REQUEST['image_name']))
	{
		unlink("teams/thumb2/".$_REQUEST['image_name']);
	}
	header("location:view_teams.php?message=Image deleted successfully&action=search_product");
	exit;
}
################################################### END DELETE ########################

############################################################## SEARCH ########################
if(isset($_REQUEST['action']) && $_REQUEST['action']=='search_product')		
{
	$sql=mysql_query("select * from team ORDER BY team_name");
	$result=mysql_num_rows($sql);
}
##############################################################END SEARCH ########################

if(isset($_REQUEST['action']) && $_REQUEST['action']=='view'){
$sql=mysql_query("select * from team ORDER BY team_name  ");
$result=mysql_num_rows($sql);
}
############################################## DELELE ########################
 ?>
<html>
<head>
<title>:::(Admin Panel) :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/css.css" rel="stylesheet" type="text/css">
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
                                        <td height="57" colspan="2" align="left"  valign="middle" class="head_ing">Manage  Advertise</td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" align="left"  valign="top" class="red">                                            </td>
                                      </tr>
                                      
                                      <tr>
									   <?php if(isset($_REQUEST['message'])){ ?>
									   <tr align="right"  bgcolor="#ffffff">
                                            <td colspan="10" height="" class="red"><div align="center">
                                              <?php echo $_REQUEST['message'];?>
                                            </div>                                            </td>
                                            </tr>
										<?php }?>	
      	<td colspan="2" align="center" valign="top">
	  	<form name="search_product" method="post" action="view_images.php?action=search_product">
<script language="javascript">function addRow(tableID){var table=document.getElementById(tableID);var rowCount=table.rows.length;var row=table.insertRow(rowCount);var colCount=table.rows[0].cells.length;for(var i=0;i<colCount;i++){var newcell=row.insertCell(i);newcell.innerHTML=table.rows[0].cells[i].innerHTML;switch(newcell.childNodes[0].type){case"text":newcell.childNodes[0].value="";break;case"checkbox":newcell.childNodes[0].checked=false;break;case"select-one":newcell.childNodes[0].selectedIndex=0;break;}}}
function deleteRow(tableID){try{var table=document.getElementById(tableID);var rowCount=table.rows.length;for(var i=0;i<rowCount;i++){var row=table.rows[i];var chkbox=row.cells[0].childNodes[0];if(null!=chkbox&&true==chkbox.checked){if(rowCount<=1){alert("Cannot delete all the rows.");break;}
table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}</script>
    <div style="float:right;"><input value="Add Row" onclick="addRow('dataTable')" type="button">
    <input value="Delete Row" onclick="deleteRow('dataTable')" type="button"></div>
    
    <div><select name="">
      <option selected>Select Page</option>
      <option>Home Page Ad</option>
    </select></div>
 <div style="padding:0 0 0 0;"><span>Product ID</span><span style="padding:0 0 0 85px;">Sequence</span></div>
    <table id="dataTable" border="1" width="350px">
        <tbody>
        
        <tr>
            <td><input name="chk" type="checkbox"></td>
            <td><input name="txt" type="text"></td>
            <td><input name="" type="text" /></td>
        </tr>
    </tbody></table>
        
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
<script language="JavaScript" type="text/JavaScript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function navigate(file_name){
window.location	= file_name;	
//alert(file_name);
}

function paging_function(file_name,start){
document.search_product.action=file_name+"?action=search_product&start="+start;
document.search_product.submit();
}

function set_page_limit(records){
document.search_product.action="<?php echo $file_name?>?action=search_product&per_page="+records;
document.search_product.submit();
}
function paging_function(file_name,start){
document.search_product.action=file_name+"?action=search_product&start="+start;
document.search_product.submit();
}
</script>