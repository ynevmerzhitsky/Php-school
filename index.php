<?php
//$config = parse_ini_file('config/db.ini');
//var_dump($config);
/*$db = mysqli_connect($config['host'], $config['user'], $config['password'], $config['db_name']) or die("Error" . mysql_error());
$result = mysqli_query($db,'select * from user');
while ($row = mysqli_fetch_assoc($result)) {
	var_dump($row);
}*/
require_once 'library/db.php';
include 'header.html';
require_once 'greeting.php';
require_once 'user.php';

if(!isset($_SESSION)) 
{ 
	session_start(); 
} 

if(array_key_exists('isLogin', $_SESSION) && $_SESSION['isLogin']):
	include 'logOut.php';
	echo "Hello, " . $_SESSION['login'] . "<br>";
	$events_list_by_user = get_events_by_user(get_db_connect(),$_SESSION['id']);
	echo '<h2>My events</h2>';
	foreach ($events_list_by_user as $event) {
		echo $event->name . '<br/>';
	}
else:
	include 'auth.php';
endif;
include 'footer.html';
?>
