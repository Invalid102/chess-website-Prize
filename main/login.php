<?php
error_reporting(E_ERROR);
session_start();
if($_SESSION['logged in']) {
	header('Location: homepage.php');
}

// add mysql server details below
$link = mysqli_connect('SERVER', 'USERNAME', 'PASSWORD', 'DB_NAME');
if (!$link) {
	die('Could not connect: ');
}

if (isset($_POST["submit"])) {
	$usr_username = $_POST['username'];
	$usr_password = $_POST['password'];

	$stmt = $link->prepare('SELECT * FROM accounts WHERE username = ? LIMIT 1');
	$stmt->bind_param('s', $usr_username); // 's' specifies the variable type => 'string'
	$stmt->execute();
	$credentials = $stmt->get_result();
	$num_rows = mysqli_num_rows($credentials);

	if ($num_rows == 1) {	
		while ($row = $credentials->fetch_row()) {
			if (password_verify($usr_password, $row[2])){
				mysqli_close($link);
				$_SESSION['logged in'] = true;

				header('Location: homepage.php');
				exit();
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link href="login.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="login">
		<h1>Login</h1>
		<form method="post"/>
			<label for="username">
				<i class="fas fa-user"></i>
			</label>
			<input type="text" name="username" placeholder="Username" required>
			<br>
			<label for="password">
				<i class="fas fa-lock"></i>
			</label>
			<input type="password" name="password" placeholder="Password" required>
			<br>
			<input type="submit" value="Login" name="submit">
		</form>
		<a href="index.html">Back</a>
	</div>
</body>
</html>

