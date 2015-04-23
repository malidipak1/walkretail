<?php
@session_start();
if(!isset($_SESSION['login']) && !isset($_SESSION['supplier']))
{
	header('Location: index.php');
	exit;
}?>