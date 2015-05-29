<?php
require_once 'user.php';
function check_user()
{
	$users=json_decode(file_get_contents('users.json'));
		if(array_key_exists('login', $_POST))
		{
			foreach($users as &$user)
			{
				if($user->_login==$_POST["login"])
				{
					return $user;
				}
			}
			return false;
		}
	return false;
}
?>