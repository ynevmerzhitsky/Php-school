<?php
require_once 'library/db.php';
include 'header.html';


if(!isset($_SESSION)) 
{ 
	session_start(); 
} 

if(array_key_exists('isLogin', $_SESSION)&&$_SESSION['isLogin']):
	include 'logOut.php';
	$events_list = get_event_list(get_db_connect());
?>
	<form method="post">
		<table>
		<caption>Events</caption>
		<tr>
			<th>Name</th>
			<th>Place</th>
			<th>Price</th>
			<th></th>
		</tr>
		<?php foreach ($events_list as $event) : ?>
			<tr>
				<td><?= $event->name ?></td>
				<td><?= $event->place ?></td>
				<td><?= $event->price ?></td>
				<td><input type="checkbox" name="events[]" value="<?= $event->id ?>"></td>
				<td><a href="edit_event.php?id=<?= $event->id?>">Edit</a></td>
			</tr>
		<?php endforeach; ?>
		</table>
		<input type="submit" name="add_event_button" value="Add to my list">
	</form>
	<a href="create_event.php">Create new event</a>
<?php
	if(array_key_exists('add_event_button', $_POST)):
		add_events_to_user();
	endif;
else:
	include 'auth.php';
endif;
function add_events_to_user()
{
	
	if(empty($_POST['events']))
	{
		echo "You didn't select any events.";
	}
	else
	{
		$selectedEvents = $_POST['events'];
		echo "You select any events.";
		$result = array();
		foreach ($selectedEvents as $event) {
			if(!is_event_in_user_list(get_db_connect(),$_SESSION['id'],$event)){
				add_event_to_user(get_db_connect(), $event, $_SESSION['id']);	
			}
			header("Location: index.php");
		}
	}
}
include 'footer.html';


?>