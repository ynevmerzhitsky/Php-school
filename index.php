<?php
//$config = parse_ini_file('config/db.ini');
//var_dump($config);
/*$db = mysqli_connect($config['host'], $config['user'], $config['password'], $config['db_name']) or die("Error" . mysql_error());
$result = mysqli_query($db,'select * from user');
while ($row = mysqli_fetch_assoc($result)) {
	var_dump($row);
}*/
include 'library/db.php';
include 'header.html';
require_once 'greeting.php';
require_once 'user.php';


if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
if(array_key_exists('isLogin', $_SESSION)&&$_SESSION['isLogin'])
{
	include 'logOut.php';
	echo "Hello, " . $_SESSION['login'] . "<br>";
	$user = user::get_user_by_id($_SESSION['id']);
	$greetings = user::get_all_greetings($user);
	echo $greetings[rand(0,count($greetings)-1)]->_greeting;
	echo '<table border="1">
	<caption>Users</caption>
	<tr>
	<th>Login</th>
	<th>Link</th>
	<tr>';
	$users=json_decode(file_get_contents('users.json'));
	foreach($users as &$user)
	{
		echo "<tr><td>" . $user->_login . '</td><td><a href="user_info.php?id=' .$user->_id . '">Info</a></td></tr>' ;
	}
	echo "</table>";

}
else
{
	include 'auth.php';
}

include 'footer.html';
?>
