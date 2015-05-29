<?php 


if(!isset($_SESSION)){
    session_start();
}
include 'auth_form.html';
require_once 'user.php';
if(array_key_exists('logInButton', $_POST))
{

	function authorization()
	{
		$users=user::get_all_users();
		if(array_key_exists('login', $_POST))
		{
			
			$user = user::check_user();
			if($user!=false && $user->_password==$_POST["password"])
			{
				$_SESSION['isLogin'] = true;
				$_SESSION['login']=$user->_login;
				$_SESSION['id']=$user->_id;
				$_SESSION['countAuthorization']=$user->_countAuthorization+1;
				$user->_countAuthorization=$_SESSION['countAuthorization'];
				user::save_user($user);
				header("Location: ".$_SERVER['REQUEST_URI']);//2) $_SERVER['PHP_SELF']
			}
			echo "Try again";
		}
	}
	
	authorization();
}
else
{
	if(array_key_exists('signInButton', $_POST))
	{
		header("Location: /registration.php");
	}
			
}
?>