<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Log out</title>
</head>

<body>
<?php
  $_SESSION = array();
  session_destroy();
  echo "<p>You've been logged out</p>";
  echo "<p><a href='login.php'>Login again</a></p>";
?>
</body>
