<?php
	echo "<a href='" . $_SERVER['PHP_SELF'] . "?logOut=true'>Log out</a><br/>";
	if (isset($_GET['logOut'])) 
	{
    	logOut();
	}

	function logOut()
	{
		$_SESSION['isLogin'] = false;
		//session_regenerate_id(FALSE);
		//session_unset();
		header('Location: ' .$_SERVER['PHP_SELF']);
	}
?>