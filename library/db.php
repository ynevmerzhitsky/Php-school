<?php

function get_db_connect()
{
	$config = parse_ini_file('config/db.ini');
	$db = new PDO("mysql:host={$config['host']};dbname={$config['db_name']};", $config['user'], $config['password']);
	return $db;
}

function get_redis_connect()
{
	try 
	{
		$redis = new Redis();
		$redis->connect('127.0.0.1', 6379 );
		return $redis;
	}
	catch (Exception $e) {
	    die($e->getMessage());
	    return false;
	}
}


function get_user_list($db,$status = 1)
{
	$result = array();
	$query = $db->prepare("select * from user where is_active=:status");
	$query->bindParam(":status", $status,PDO::PARAM_INT);
	$query->execute();
	while($row=$query->fetch(PDO::FETCH_OBJ))
	{
		array_push($result, $row);
	}
	return $result;
}

function create_user($db,$name,$password,$email)
{
	$query = $db->prepare("insert into user (`name`, `email`,`password`) values(:name,:email,PASSWORD(:password))");
	$query->bindParam(":name",$name);
	$query->bindParam(":email",$email);
	$query->bindParam(":password",$password);
	$query->execute();
}

function edit_user($db,$id,$name, $password,$email)
{
	$query=$db->prepare("update user set `name`=:name, `email`=:email, `password`=PASSWORD(:password) where `id`=:id");
	$query->bindParam(":name",$name);
	$query->bindParam(":email",$email);
	$query->bindParam(":password",$password);
	$query->bindParam(":id",$id);
	$query->execute();
}

function get_user_by_id($db,$id)
{
	$query = $db->prepare("select * from user where id=:id");
	$query->bindParam(":id", $id,PDO::PARAM_INT);
	$query->execute();
	while($row=$query->fetch(PDO::FETCH_OBJ))
	{
		return $row;
	}
	return false;
}

function check_user($db, $login,$password)
{
	$query = $db->prepare("select * from user where `name`=:login and password=PASSWORD(:password)");
	$query->bindParam(":login", $login,PDO::PARAM_INT);
	$query->bindParam(":password",$password);
	$query->execute();
	while($row=$query->fetch(PDO::FETCH_OBJ))
	{
		return $row;
	}
	return false;
}

function get_event_list($db)
{
	$result = array();
	$query = $db->prepare("select * from event");
	$query->bindParam(":status", $status,PDO::PARAM_INT);
	$query->execute();
	while($row=$query->fetch(PDO::FETCH_OBJ))
	{
		array_push($result, $row);
	}
	return $result;
}

function create_event($db, $name, $place, $price)
{
	$query = $db->prepare("insert into event (`name`, `place`,`price`) values(:name,:place,:price)");
	$query->bindParam(":name", $name);
	$query->bindParam(":place",$place);
	$query->bindParam(":price",$price);
	$query->execute();
}

function edit_event($db, $name,$place,$id)
{
	$query = $db->prepare("update event set `name` = :name, `place`=:place where `id`=:id");
	$query->bindParam(":name",$name);
	$query->bindParam(":place", $place);
	$query->bindParam(":id",$id);
	$query->execute();
}

function get_event_by_id($db, $id)
{
	$query = $db->prepare("select * from event where id=:id");
	$query->bindParam(":id", $id,PDO::PARAM_INT);
	$query->execute();
	while($row=$query->fetch(PDO::FETCH_OBJ))
	{
		return $row;
	}
	return false;
}

function add_event_to_user($db, $id_event, $id_user)
{
	$query = $db->prepare("insert into user_event (`id_user`,`id_event`) values (:id_user,:id_event)");
	$query->bindParam(":id_user", $id_user, PDO::PARAM_INT);
	$query->bindParam(":id_event", $id_event, PDO::PARAM_INT);
	$query->execute();
}

function delete_event_from_user($db, $id_event, $id_user)
{
	$query = $db->prepare("delete user_event where `id_user`=:id_user and `id_event`=:id_event");
	$query->bindParam(":id_user", $id_user, PDO::PARAM_INT);
	$query->bindParam(":id_event", $id_event, PDO::PARAM_INT);
	$query->execute();
}

function get_events_by_user($db,$id_user)
{
	$result = array();
	$query = $db->prepare("select event.* from event, user_event where user_event.id_user=:id_user and event.id=user_event.id_event");
	$query->bindParam(":id_user", $id_user, PDO::PARAM_INT);
	$query->execute();
	while($row=$query->fetch(PDO::FETCH_OBJ))
	{
		array_push($result, $row);
	}
	return $result;
}


function is_event_in_user_list($db, $id_user,$id_event)
{
	$query = $db->prepare("select count(*) as count from user_event where id_user=:id_user and id_event=:id_event");
	$query->bindParam(":id_user", $id_user, PDO::PARAM_INT);
	$query->bindParam(':id_event', $id_event, PDO::PARAM_INT);
	$query->execute();
	while($row=$query->fetch(PDO::FETCH_OBJ))
	{
		if($row->count==0){
			return false;
		}
		else
		{
			return true;
		}
	}
	return false;
}

?>