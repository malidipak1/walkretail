<?php
include("database.inc.php");
$catid    =  $_REQUEST['catid'];
$i=$_REQUEST['i'];
//echo $i;      
$sql      =  mysql_query("select * from categories where parent_id='".$catid."'");
$result   =  mysql_num_rows($sql);

if($result>0)
{       
echo "<select name='cat".$i."' id='cat".$i."' onChange='chk_str(this.value,$i)'>
      <option value=''>--Select Category--</option>";

     while($row =mysql_fetch_array($sql))
         {
                echo "<option value=".$row['catid'].">".$row['catname']."</option>";
     }
echo "</select>";
echo "<br><br>";
echo "<div id='txtHint".$i."'></div>";
}
?>