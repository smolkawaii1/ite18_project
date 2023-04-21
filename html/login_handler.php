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
  $login_message = "Welcome ".$username.", You have logged in successfully!";
  $button_text = "Log out";
  $button_link = "index.php";
} else {
  $_SESSION['error'] = "Invalid username or password";
  $login_message = "Invalid username or password";
  $button_text = "Go back";
  $button_link = "javascript:history.go(-1)";
}
?>

<head>
  <meta charset="utf-8">
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="/ITE_18_Project/html/assets/css/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
  <style>
    canvas {
      position: fixed;
      z-index: -1;
      background: rgb(0,0,0);
      background: radial-gradient(circle, rgba(0,0,0,1) 0%, rgba(23,23,23,1) 50%, rgba(37,37,37,1) 100%);
    }
  </style>

</head>

<body>
  <div class="login-message"><?php echo $login_message ?></div>
  <form  id="login-message" action='<?php echo $button_link ?>' method='post'>
    <button class = 'btn' type='submit' name='submit' ><?php echo $button_text ?></button>
  </form>
  <form action='index.php' method='post'><button type="submit" name="login" class="btn" id="btn"><-</button></form>
  <canvas id="galaxy"></canvas>
  <script>
    const canvas = document.getElementById('galaxy');
    const ctx = canvas.getContext('2d');

    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    const stars = [];

    class Star {
      constructor() {
        this.x = Math.random() * canvas.width;
        this.y = Math.random() * canvas.height;
        this.size = Math.random() * 3;
      }

      draw() {
        ctx.fillStyle = 'pink';
        ctx.shadowColor = '#FFF';
        ctx.shadowBlur = 15;
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, 2 * Math.PI);
        ctx.fill();
      }

      // Add method to update position of the star
      update() {
        this.x += Math.random() * 0.5 - 0.25;
        this.y += Math.random() * 0.5 + 1;
        // If the star has gone off the bottom of the screen, reset it
        if (this.y > canvas.height) {
          this.y = 0;
          this.x = Math.random() * canvas.width;
        }
      }
    }

    function createStars(count) {
      for (let i = 0; i < count; i++) {
        stars.push(new Star());
      }
    }

    function animate() {
      requestAnimationFrame(animate);
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      stars.forEach(star => {
        star.draw();
        star.update(); // Update position of the star
      });
    }

    createStars(500);
    setTimeout(() => {
      animate();
    }, 500); // Start animation after 0.5s
  </script>
</body>

