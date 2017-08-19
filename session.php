<?php
  require('connection.php');
  session_start();

  $user_check = $_SESSION['login_user'];

  $ses_sql = mysqli_query($conn, "SELECT username from admin WHERE username='$user_check'");

  $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

  //$login_session = $row['username'];
  /*if(isset($_SESSION['login_user'] == 'admin')){
    header("location: admin_dashboard.php");
  } else {
    header("location: guard_dashboard.php");
  }*/

  if(!isset($_SESSION['login_user'])){
    header("location: login.php");
  }

?>
