<?php
include 'library/db.php';
$db = get_db_connect();
$users_list = get_user_list($db);
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
<a href="create_user.php">Create new user</a>
