<?php
include_once '../lib/config.php';
class database_connection{
  function database_connection($database_name,$host,$userid,$password){
    MySQL_connect($host,$userid,$password);
    //Select the database we want to use
    MySQL_select_db($database_name) or die("Could not select database");
  }
}
#################################### FOR LOCAL CONNECTION############################################
/*$conection     =  new database_connection('walkretail','localhost','root','');*/

########################################################################################################

#################################### FOR SERVER CONNECTION ############################################

//$conection     =  new database_connection('walkreta_walk','localhost','walkreta_walk','db@walk#558');
$conection     =  new database_connection(DB_NAME,DB_HOST,DB_USER,DB_PASSWD);

########################################################################################################
?>
