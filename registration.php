<?php
include 'header.html';
include 'registration_form.html';
require_once 'user.php';
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
if(array_key_exists('signInButton', $_POST))
{
	registration();
}
function registration()
{
	if(array_key_exists('login', $_POST))
	{
		$loginPattern = '/^[a-z0-9_-]{3,20}$/';
		$passwordPattern = '/^[a-z0-9_-]{6,25}$/';
		if((preg_match($loginPattern, $_POST['login'])===1)&&(preg_match($passwordPattern, $_POST['password'])===1))
		{	
			$user = user::check_user();
			if(!$user)
			{
				$newUser = new user($_POST['login'],$_POST['password']);
				$_SESSION['isLogin'] = true;
				$_SESSION['login']=$newUser->_login;
				$_SESSION['countAuthorization']=$newUser->_countAuthorization;
				header("Location: /index.php");
			}
			else
			{
				echo "User with login '" . $_POST['login'] . "' is already exists";
			}
		}
		else
		{
			echo "Enter correct login and password";
		}
	}
}
include 'footer.html';
?>

