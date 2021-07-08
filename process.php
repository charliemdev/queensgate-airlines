<?php
  session_start();
  include("includes/conn.php");

  if(isset($_POST['login']))
  {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $row['role'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $loggedIn=false;

    if($row = $stmt->fetch()){
        if (password_verify($password, $row['password'])) {
              $loggedIn=true;
        }
    }
    if($loggedIn){
        $_SESSION["email"]=$email;
        $_SESSION["role"]=$row["role"];
        header( "Location: index.php" );
    }else{
        $_SESSION["error_msg"]="Wrong login details";
        header( "Location: login.php" );
    }
  }else{
      header( "Location: login.php" );
  }
?>
