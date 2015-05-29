<?php
include 'header.html';
require_once 'user.php';
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
if(array_key_exists('isLogin', $_SESSION)&&$_SESSION['isLogin'])
{
	include 'logOut.php';
	echo "Count authorization: " . $_SESSION['countAuthorization'] . "<br/>";
}
else
{
	include 'auth.php';
}
include 'footer.html';
?>