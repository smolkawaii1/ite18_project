<?php
  session_start();
  include('./includes/db_connection.php');
  
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) == 1) {
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You have logged in successfully!";
    echo "success";
  } else {
    $_SESSION['error'] = "Invalid username or password";
    echo "Invalid username or password";
  }
?>
