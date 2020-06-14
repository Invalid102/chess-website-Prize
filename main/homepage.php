<?php
error_reporting(E_ERROR);
session_start();
if( !$_SESSION['logged in']) {
	header('Location: index.html');
}
if (isset($_POST["submit"])) {
	session_destroy();
	header('Location: index.html');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Play</title>
</head>
<body>
	<h1>Greetings!</h1>
	<form method="post"/>
	<input type="submit" value="Logout" name="submit"/>
	</form>
</body>
</html>

