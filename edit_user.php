<?php
include 'header.html';
include 'library/db.php';
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
if(array_key_exists('isLogin', $_SESSION)&&$_SESSION['isLogin']):
	include 'logOut.php';
	if(array_key_exists('id', $_GET)):
		$user = get_user_by_id(get_db_connect(),$_GET['id']);
		if(array_key_exists('edit_button', $_POST))
		{
			edit($user);
		}

?>
	<form method="post">
		Name:<br>
		<input type="text" name="name" value=<?= $user->name?>><br/>
		Password:<br/>
		<input type="password" name="password"><br/>
		E-mail:<br/>
		<input type="text" name="email" value=<?= $user->email?>><br/>
		<input type="submit" name="edit_button" value="Edit">
	</form>
<?php
	else:
		header("Location: /user_list.php");
	endif;
else:
	include 'auth.php';
endif;
include 'footer.html';

function edit($user)
{
	if($user!=false) {
		edit_user(get_db_connect(),$user->id,$_POST['name'],$_POST['password'],$_POST['email']);
		header("Location: /user_list.php");
	}
	
}
?>

