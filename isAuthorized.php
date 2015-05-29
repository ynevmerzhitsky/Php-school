<?php 
if(!isset($_SESSION)){
    session_start();
}
include 'auth_form.html';

if(array_key_exists('logInButton', $_POST))
{
	function authorization()
	{
		$users=json_decode(file_get_contents('users.json'));
		if(array_key_exists('login', $_POST))
		{
			foreach($users as &$user)
			{
				if(($user->_login==$_POST["login"])&&($user->_password==$_POST["password"]))
				{
					$_SESSION['isLogin'] = true;
					$_SESSION['login']=$_POST["login"];
					$_SESSION['countAuthorization']=$user->_countAuthorization+1;
					$user->_countAuthorization=$_SESSION['countAuthorization'];
					file_put_contents('users.json', json_encode($users));
					echo $_SESSION['countAuthorization'];
					header("Location: /account.php");
					break;
				}
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