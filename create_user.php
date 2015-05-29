<?php
include 'library/db.php';
if(array_key_exists('add_button', $_POST))
{
	create();
}
function create()
{
	create_user(get_db_connect(),$_POST['name'],$_POST['password'],$_POST['email']);
	header("Location: /user_list.php");
}
?>
<form method="post">
Name:<br>
<input type="text" name="name"><br/>
Password:<br/>
<input type="password" name="password"><br/>
E-mail:<br/>
<input type="text" name="email"><br/>
<input type="submit" name="add_button" value="AddUser">
</form>