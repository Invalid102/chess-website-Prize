<?php
error_reporting(E_ERROR);

// add mysql details below
$link = mysqli_connect('SERVER', 'USERNAME', 'PASSWORD', 'DB_NAME');
if (!$link) {
	die('Could not connect: ');
}

session_start();
if(isset($_SESSION['ID'])) {
	if (isset($_POST['logout'])) {
		session_destroy();
		exit();
	}
    echo "Login Success";
    exit();
} 
else if (isset($_POST["username"])) {
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
                $_SESSION['ID'] = $row[0];

				echo "Login Success";
				exit();
			}
		}
	}
}
echo "Login Failure";

?>