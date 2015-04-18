<?php
@session_start();
if(!isset($_SESSION['login']) && $_SESSION['supplier'])
{
	header('Location: index.php');
	exit;
}?>