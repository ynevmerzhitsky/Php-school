<?php 


if(!isset($_SESSION)){
    session_start();
}
require_once 'library/db.php';
include 'auth_form.html';
require_once 'user.php';
$redisClient = get_redis_connect();
$redisClient->setTimeout("",2);
$redisClient->save();

	


if(array_key_exists('logInButton', $_POST))
{

	function authorization()
	{
		$redisClient = get_redis_connect();
		$users=user::get_all_users();
		if(array_key_exists('login', $_POST))
		{

			
			if($redisClient->get($_POST['login'])==-1)
			{
				echo "<br/>You have exceeded the number of authorization";
				return;
			}
			else
			{
				$redisClient->setTimeout($_POST['login'],10);
			}
			$user=user::check_user();
			if($user!=false){
				if($user->_password==$_POST["password"])
				{
					$_SESSION['isLogin'] = true;
					$_SESSION['login']=$user->_login;
					$_SESSION['id']=$user->_id;
					$_SESSION['countAuthorization']=$user->_countAuthorization+1;
					$user->_countAuthorization=$_SESSION['countAuthorization'];
					user::save_user($user);
					header("Location: ".$_SERVER['REQUEST_URI']);//2) $_SERVER['PHP_SELF']
					return;
				}
				else
				{
					if($redisClient->incr($_POST['login'])>=3){
						$redisClient->set($_POST['login'],-1);
						$redisClient->setTimeout($_POST['login'], 60);
					}
					else
						echo "Try again";
				}

			}
			
			
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