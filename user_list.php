<?php
require_once 'library/db.php';
include 'header.html';
$count=50;
$db = get_db_connect();



if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
if(array_key_exists('isLogin', $_SESSION)&&$_SESSION['isLogin']):
	include 'logOut.php'; 
	$count_users = get_count_users(get_db_connect());
	$count_pages = intval($count_users/$count)+1;

	if(array_key_exists('page', $_GET))
	{
		$page = $_GET['page'];
	}
	else
	{
		$page=1;
	}

	if($page<0 or empty($page)){
		$page=1;
	}
	if($page>$count_pages){
		$page=$count_pages;
	}

	$start = $page*$count - $count;
	$users_list = get_user_list($db,$start,$count);

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
	if($page !=1):
?>
		<a href="user_list.php?page=1"><< </a>
		<a href="user_list.php?page=<?=$page-1?>"><</a>
<?php
	endif;
?>
	Current page <?=$page?>
<?php		
	if($page !=$count_pages):
?>
		<a href="user_list.php?page=<?=$page+1?>"> ></a>
		<a href="user_list.php?page=<?=$count_pages?>"> >></a>
<?php
	endif;
else:
	include 'auth.php';
endif;
?>
<!--<a href="create_user.php">Create new user</a> -->
<?php include 'footer.html';?>
