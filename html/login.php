<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
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
    </div>
  </body>
</html>
