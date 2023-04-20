<!DOCTYPE html>
<html>
<head>
	<title>Login and Registration System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<h1>Login and Registration System</h1>
		<?php 
			session_start();
			if (isset($_SESSION['username'])) {
				echo "You have logged in successfully as " . $_SESSION['username'] . ".";
				echo "<form action='logout.php' method='post'><input type='submit' name='submit' value='Logout'></form>";
			} else {
				echo "<a href='login.php'>Login</a> or <a href='register.php'>Register</a> to access the system.";
			}
		 ?>
	</div>
</body>
</html>
