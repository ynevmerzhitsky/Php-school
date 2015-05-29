<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
if(array_key_exists('isLogin', $_SESSION)&&$_SESSION['isLogin'])
{
	echo "Hello, " . $_SESSION['login'] . "<br>";
	echo "Count authorization: " . $_SESSION['countAuthorization'] . "<br/>";
	include 'logOut.php';
}
else
{
	include 'isAuthorized.php';
}
?>
<!DOCTYPE html>
<html>
<head>
<title>User info</title>
</head>
<body>
</body>
</html>
