<?php

function get_db_connect()
{
	$config = parse_ini_file('../config/db.ini');
	$db = new PDO("mysql:host={$config['host']};dbname={$config['db_name']};", $config['user'], $config['password']);
	return $db;
}

function get_user_list($status = 1)
{
	$db = get_db_connect();
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
?>