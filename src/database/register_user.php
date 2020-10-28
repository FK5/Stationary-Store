<?php
  session_start();
  require_once('db.php');

if (!isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['full_name'], $_POST['phone'], $_POST['confirm_password'], $_POST['role'])) {
	// Could not get the data that should have been sent.
  $_SESSION['noData']=true;
  header('Location: ../html/authentication-register-emps.php');
}
// echo $_POST['username'];
// echo $_POST['password'];
// echo $_POST['full_name'];
// echo $_POST['phone'];
// echo $_POST['confirm_password'];

if ($stmt = $conn->prepare('SELECT user_id, password FROM user WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		$_SESSION['usernameExists']=true;
    header('Location: ../html/authentication-register-emps.php');
	} else {
		// Insert new account
        if ($stmt = $conn->prepare('INSERT INTO user (full_name, email, phone, username, password, access, role, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)')) {
    	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
    	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $access=0;
      $image_path="{\"path\":\"1.jpg\"}";
    	$stmt->bind_param('sssssiis', $_POST['full_name'], $_POST['email'], $_POST['phone'], $_POST['username'], $password, $access, $_POST['role'], $image_path);
    	$stmt->execute();
      $_SESSION['userRegister']=true;
      header('Location: ../html/authentication-login1.php');
    } else {
    	echo 'Could not prepare statement!';
    }
	}
	$stmt->close();
} else {
	echo 'Could not prepare statement!';
}
$conn->close();

?>
