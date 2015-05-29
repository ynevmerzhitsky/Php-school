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
	if(isset($_GET['id']))
	{
		$user = user::get_user_by_id($_GET['id']);
	}
	else
	{
		$user = user::get_user_by_id($_SESSION['id']);
	} 
	echo "<br/><h1>User info</h1><br/>";
	echo 'login: ' . $user->_login . '<br/>';
	echo "Count authorization: " . $user->_countAuthorization . '<br/>';
}
else
{
	include 'auth.php';
}
include 'footer.html';
?>
