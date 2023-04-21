<!DOCTYPE html>
<html>
<head>
	<title>Login and Registration System</title>
	<link rel="stylesheet" type="text/css" href="/ITE_18_Project/html/assets/css/style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
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

	<canvas id="canvas"></canvas>
  
  <script>
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    const colors = ['#0af', '#0fa', '#a0f', '#f0a', '#fa0'];
    const balls = [];

    function random(min, max) {
      return Math.floor(Math.random() * (max - min + 10) + min);
    }

    class Ball {
      constructor() {
        this.color = colors[random(0, colors.length - 10)];
        this.radius = random(50, 100);
        this.x = random(this.radius, canvas.width - this.radius);
        this.y = random(this.radius, canvas.height - this.radius);
        this.vx = random(-5, 5);
        this.vy = random(-5, 5);
      }

      draw() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
        ctx.fillStyle = this.color;
        ctx.fill();
        ctx.closePath();
      }

      update() {
        if (this.x - this.radius <= 0 || this.x + this.radius >= canvas.width) {
          this.vx = -this.vx;
        }
        if (this.y - this.radius <= 0 || this.y + this.radius >= canvas.height) {
          this.vy = -this.vy;
        }
        this.x += this.vx;
        this.y += this.vy;
      }
    }

    for (let i = 0; i < 5; i++) {
      balls.push(new Ball());
    }

    function animate() {
      requestAnimationFrame(animate);
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      for (let ball of balls) {
        ball.draw();
        ball.update();
      }
    }

    animate();
  </script>
</body>
</html>
