<?php
require_once('db.php');

if (!isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['full_name'], $_POST['phone'], $_POST['confirm_password'])) {
	// Could not get the data that should have been sent.
	exit('Please complete the registration form!');
  // header('Location: authentication-register1.php');
}

// echo $_POST['username'];
// echo $_POST['password'];
// echo $_POST['full_name'];
// echo $_POST['phone'];
// echo $_POST['confirm_password'];



if ($stmt = $conn->prepare('SELECT customer_id, password FROM customer WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		echo 'Username exists, please choose another!';
	} else {
		// Insert new account
        if ($stmt = $conn->prepare('INSERT INTO customer (full_name, email, phone, username, password, access) VALUES (?, ?, ?, ?, ?, ?)')) {
    	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
    	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $access=1;
    	$stmt->bind_param('sssssi', $_POST['full_name'], $_POST['email'], $_POST['phone'], $_POST['username'], $password, $access);
    	$stmt->execute();
    	echo 'You have successfully registered, you can now login!';
    } else {
    	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
    	echo 'Could not prepare statement!';
    }
	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
$conn->close();

?>
