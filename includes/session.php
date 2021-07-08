<?php
session_start();
if(!isset($_SESSION["email"]))
{
	//user tried to access the page without logging in
	header( "Location: login.php" );
};
 ?>
