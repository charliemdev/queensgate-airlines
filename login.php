<?php
  session_start();
  include("includes/header.php");
?>
<body id="login">
  <div class="login-container">
    <div class="login-box">
      <h1>Queensgate Airlines</h1>
      <?php
      if(isset($_SESSION["error_msg"])) {
        echo "<p class='error'>{$_SESSION["error_msg"]}</p>";
      }
      ?>
      <!-- Form -->
      <form action="process.php" method="POST">
        <label for="email">Email</label>
        <input type="text" id="email" name="email">
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <input type="submit" name="login" value="Login" class="btn-add">
      </form>
    </div>
  </div>
</body>
</html>
