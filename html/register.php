<?php
session_start();
include('./includes/db_connection.php');

$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password_1'] ?? '';

if (!empty($username) && !empty($email) && !empty($password)) {
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You have registered and logged in successfully!";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
	<h1>Register</h1>
	<form method="post" action="">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username"><br><br>
		
		<label for="email">Email:</label>
		<input type="email" id="email" name="email"><br><br>
		
		<label for="password_1">Password:</label>
		<input type="password" id="password_1" name="password_1"><br><br>
		
		<label for="password_2">Confirm Password:</label>
		<input type="password" id="password_2" name="password_2"><br><br>
		
		<input type="submit" value="Register">
	</form>
</body>
</html>
