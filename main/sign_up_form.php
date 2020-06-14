<?php
// add mysql server details below
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASSWORD', '');
define('DB_HOST', '');

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$link) {
	die('Could not connect: ');
}

if (isset($_POST["submit"])) {
	$usr_username = $_POST['username'];
	$usr_password = $_POST['password'];
	$usr_password = password_hash($usr_password, PASSWORD_DEFAULT);

	$stmt = $link->prepare('SELECT * FROM accounts WHERE username = ?');
	$stmt->bind_param('s', $usr_username); // 's' specifies the variable type => 'string'
	$stmt->execute();
	$prev_username = $stmt->get_result();
	$num_rows = mysqli_num_rows($prev_username);

	if ($num_rows == 0) {
		$stmt = $link->prepare("INSERT INTO accounts (username, password) VALUES ( ? ,  ? )");
		$stmt->bind_param('ss', $usr_username, $usr_password); // 's' specifies the variable type => 'string'
		$stmt->execute();

		session_start();
		$_SESSION['logged in'] = true;

		echo '<p>Sign up successfull</p>';
		echo '<a href="homepage.php">Home page</a>';
		
	}
}

mysqli_close($link);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sign Up</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link href="login.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="login">
		<h1>Sign Up</h1>
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
			<input type="submit" value="Sign Up" name="submit">
		</form>
	<a href="index.html">Back</a>
</body>
</html>

