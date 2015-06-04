<?php
include 'header.html';
include 'registration_form.html';
require_once 'library/db.php';
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
if(array_key_exists('sign_in_button', $_POST))
{
	registration();
}
function registration()
{
	if(array_key_exists('name', $_POST))
	{
		$loginPattern = '/^[a-z0-9_-]{3,20}$/';
		$passwordPattern = '/^[a-z0-9_-]{6,25}$/';
		if((preg_match($loginPattern, $_POST['login'])===1)&&(preg_match($passwordPattern, $_POST['password'])===1))
		{	
			$db = get_db_connect();
			$user = check_user();
			if(!$user)
			{
				create_user($db,$_POST['name'],$_POST['password'],$_POST['email'])
				$_SESSION['isLogin'] = true;
				$_SESSION['login']=$_POST['name'];
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

