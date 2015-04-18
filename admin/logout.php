<?php
session_start();
unset($_SESSION['admin']);
unset($_SESSION['login']);
$_SESSION = array();
unset($_SESSION);
header("location:index.php?message=Logged out successfully "); 
?>
