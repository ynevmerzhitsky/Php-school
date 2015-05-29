<?php

function get_db_connect()
{
	$config = parse_ini_file('config/db.ini');
	$db = new PDO("mysql:host={$config['host']};dbname={$config['db_name']};", $config['user'], $config['password']);
	return $db;
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
?>