<?php
require_once 'library/db.php';
include 'header.html';
$db = get_db_connect();
$users_list = get_user_list($db);
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
if(array_key_exists('isLogin', $_SESSION)&&$_SESSION['isLogin']):
	include 'logOut.php'; 
?>
<table>
<caption>Users list</caption>
<tr>
	<th>Name</th>
	<th>Email</th>
	<th>Password Hash</th>
	<th></th>
</tr>
<?php foreach ($users_list as $user) : ?>
	<tr>
		<td><?= $user->name ?></td>
		<td><?= $user->email ?></td>
		<td><?= $user->password ?></td>
		<td><a href="edit_user.php?id=<?= $user->id ?>">Edit</a></td>
	</tr>
<?php endforeach; ?>
</table>
<?php 
else:
	include 'auth.php';
endif;
?>
<!--<a href="create_user.php">Create new user</a> -->
<?php include 'footer.html';?>
