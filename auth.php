<?php

if(!isset($_SESSION)){
    session_start();
}
require_once 'library/db.php';
include 'auth_form.html';
require_once 'user.php';
$redisClient = get_redis_connect();
$redisClient->save();

	


if(array_key_exists('log_in_button', $_POST))
{

    /**
     *
     */
    function authorization()
	{
		$redisClient = get_redis_connect();
		if(array_key_exists('login', $_POST))
		{

			if($redisClient->get($_POST['login'])==-1)
			{
				echo "<br/>You have exceeded the number of authorization";
				
				return;
			}
			$user=check_user(get_db_connect(),$_POST['login'],$_POST['password']);
			if($user!=false){
				
					$_SESSION['isLogin'] = true;
					$_SESSION['login']=$user->name;
					$_SESSION['id']=$user->id;
					header("Location: ".$_SERVER['REQUEST_URI']);//2) $_SERVER['PHP_SELF']
					return;

			}
			else
				{

					if($redisClient->incr($_POST['login'])>=3){
						$redisClient->set($_POST['login'],-1);
						$redisClient->setTimeout($_POST['login'], 60);
						echo "You have exceeded the number of authorization";
					}
					else
					{
						if($redisClient->get($_POST['login'])==1)
						{
							$redisClient->setTimeout($_POST['login'], 10);
						}
						echo "Login and/or password incorrect!";
					}
				}
			
			
		}
	}
	
	authorization();
}
else
{
	if(array_key_exists('sign_in_button', $_POST))
	{
		header("Location: /registration.php");
	}
			
}
?>