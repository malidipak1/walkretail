<?php
if(isset($_REQUEST['start']))
{
	$start=$_REQUEST['start'];
}

if(!isset($start)) {                         // This variable is set to zero for the first page
  $start = 0;
}

$eu   = ($start - 0);

if(isset($_SESSION['per_page'])){
  $limit   =  $_SESSION['per_page'];             // Number of records to be shown per page.
}else{
  $limit   =  10;
}
if(isset($_REQUEST['per_page']) && $_REQUEST['per_page']!='')
{                        // if user set the per page limit then it will make a session of the per page
  if(!isset($start)) {                        // This variable is set to zero for the first page
    $start = 0;
  }
$eu     = ($start - 0);
$limit     = $_REQUEST['per_page'];                 // No of records to be shown per page.
$_SESSION['per_page']=$_REQUEST['per_page'];
}

 $query2  =  "SELECT * FROM $paging_table_name ";
$rec  =  mysql_query($query2);
$nume  =  mysql_num_rows($rec);
?>
