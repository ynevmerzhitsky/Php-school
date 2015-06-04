<?php
include 'library/db.php';
include 'registration_form.html';
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
