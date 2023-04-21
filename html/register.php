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
  <link rel="stylesheet" type="text/css" href="/ITE_18_Project/html/assets/css/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
  <style>
    canvas {
      position: fixed;
      z-index: -1;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Register</h1>
    <?php if(isset($_SESSION['error'])): ?>
      <div class="error"><?php echo $_SESSION['error']; ?></div>
    <?php endif; ?>
    <form method="post" action="">
      <div class="form-control">
        <input type="text" id="username" name="username" placeholder="Username">
      </div>
      <div class="form-control">
        <input type="email" id="email" name="email" placeholder="Email">
      </div>
      <div class="form-control">
        <input type="password" id="password_1" name="password_1" placeholder="Password">
      </div>
      <div class="form-control">
        <input type="password" id="password_2" name="password_2" placeholder="Confirm Password">
      </div>
      <button type="submit" class="btn">Register</button>
    </form>
    <form action='index.php' method='post'><button type="submit" name="login" class="btn">Go back</button></form>
  </div>
  <canvas id="canvas"></canvas>
  <script>
    const canvas = document.createElement('canvas');
    document.body.appendChild(canvas);
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    const ctx = canvas.getContext('2d');

    let meteors = [];

    class Meteor {
      constructor() {
        this.radius = 1 + Math.random() * 2;
        this.x = Math.random() * (canvas.width - this.radius);
        this.y = -this.radius;
        this.speed = 3 + Math.random() * 3;
        this.angle = 10 + Math.random() * 30; // slight tilt to the left
        this.color = 'white';
      }

      update() {
        this.x -= this.speed * Math.cos(this.angle * Math.PI / 180);
        this.y += this.speed * Math.sin(this.angle * Math.PI / 180);

        if (this.y - this.radius > canvas.height || this.x + this.radius < 0) {
          this.radius = 1 + Math.random() * 2;
          this.x = Math.random() * (canvas.width - this.radius) + canvas.width;
          this.y = -this.radius;
          this.speed = 3 + Math.random() * 3;
          this.angle = 165 + Math.random() * 30; // slight tilt to the left
          this.ttl = 100;
        }
        this.draw();
      }

      draw() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
        ctx.fillStyle = this.color;
        ctx.shadowColor = 'black';
        ctx.shadowBlur = 15;
        ctx.fill();
      }
    }

    function createMeteors(count) {
      for (let i = 0; i < count; i++) {
        meteors.push(new Meteor());
      }
    }

    function animate() {
      requestAnimationFrame(animate);
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      meteors.forEach(meteor => meteor.update());

      // add new meteors when some have gone off the screen
      while (meteors.length < 50) {
        meteors.push(new Meteor());
      }
    }

    createMeteors(50);
    animate();
  </script>
</body>
</html>
