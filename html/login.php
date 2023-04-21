<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/ITE_18_Project/html/assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
  </head>
  <body>
    <div class="container">
      <h1>Login</h1>
      <?php if(isset($_SESSION['error'])): ?>
        <div class="error"><?php echo $_SESSION['error']; ?></div>
      <?php endif; ?>
      <form action="login_handler.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="login" class="btn">Login</button>
      </form>
      <form action='index.php' method='post'><button type="submit" name="login" class="btn">Go back</button></form>
    </div>
  </body>
  <canvas id="canvas"></canvas>
  <script>
const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const colors = ['#0af', '#0fa', '#a0f', '#f0a', '#fa0'];
const balls = [];

let isDragging = false;
let dragIndex = -1;
let offsetX, offsetY;

function random(min, max) {
  return Math.floor(Math.random() * (max - min + 1) + min);
}

class Ball {
  constructor() {
    this.color = colors[random(0, colors.length - 1)];
    this.radius = random(2, 2);
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

  isPointInside(x, y) {
    const dx = x - this.x;
    const dy = y - this.y;
    return Math.sqrt(dx * dx + dy * dy) <= this.radius;
  }
}

for (let i = 0; i < 100; i++) {
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

function onMouseDown(event) {
  const x = event.clientX;
  const y = event.clientY;
  for (let i = balls.length - 1; i >= 0; i--) {
    if (balls[i].isPointInside(x, y)) {
      isDragging = true;
      dragIndex = i;
      offsetX = x - balls[i].x;
      offsetY = y - balls[i].y;
      break;
    }
  }
}

function onMouseMove(event) {
  if (isDragging) {
    balls[dragIndex].x = event.clientX - offsetX;
    balls[dragIndex].y = event.clientY - offsetY;
  }
}

function onMouseUp(event) {
  isDragging = false;
  dragIndex = -1;
}

canvas.addEventListener('mousedown', onMouseDown);
canvas.addEventListener('mousemove', onMouseMove);
canvas.addEventListener('mouseup', onMouseUp);

animate();
  </script>
</html>
