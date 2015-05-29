<?php
include 'library/db.php';
$user = get_user_by_id(get_db_connect(),$_GET['id']);
if(array_key_exists('edit_button', $_POST))
{
	edit($user);
}


function edit($user)
{
	if($user!=false) {
		edit_user(get_db_connect(),$user->id,$_POST['name'],$_POST['password'],$_POST['email']);
		header("Location: /user_list.php");
	}
	
}
?>
<form method="post">
Name:<br>
<input type="text" name="name" value=<?= $user->name?>><br/>
Password:<br/>
<input type="password" name="password"><br/>
E-mail:<br/>
<input type="text" name="email" value=<?= $user->email?>><br/>
<input type="submit" name="edit_button" value="Save">
</form>

