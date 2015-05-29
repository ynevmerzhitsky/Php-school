<?php
require_once 'greeting.php';
class user {

	function user($login,$password)
	{
		$this->_login=$login;
		$this->_password=$password;
		$this->_countAuthorization=1;
		$this->_id=user::get_max_id()+1;
		$users = user::get_all_users();
		array_push($users, $this);
		user::save_users($users);
	}
	var $_id;
	var $_login;
	var $_password;
	var $_countAuthorization;

	static function get_all_greetings($user)
	{
		$greetings = array();
		$items=user_greeting::get_all();
		foreach ($items as &$item) {
			if($item->_id_user==$user->_id)
			{
				array_push($greetings, greeting::get_by_id($item->_id_greeting));
			}
		}
		return $greetings;
	}

	static function save_user($user)
	{
		$users=user::get_all_users();
		$users[$user->_id] = $user;
		user::save_users($users);
	}

	static function get_user_by_id($id)
	{
		$users=user::get_all_users();
		foreach($users as &$user)
		{
			if($user->_id==$id)
			{
				return $user;
			}
		}
		return false;
	}

	static function get_max_id()
	{
		$max_id =0;
		$users=user::get_all_users();
		foreach($users as &$user)
		{
			if($user->_id>$max_id)
			{
				$max_id=$user->_id;
			}
		}
		return $max_id;
	}

	static function check_user()
	{
		$users = user::get_all_users();
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

	static function get_all_users()
	{
		$users=json_decode(file_get_contents('users.json'));
		if($users===null)
		{
			$users=array();
		}
		return $users;
	}
	static function save_users($users)
	{
		file_put_contents('users.json', json_encode($users));
	}
}
?>