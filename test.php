<?php
  require 'connection.php';
  session_start();

  if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username='$username' and password=SHA2('$password', 512)";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
      $_SESSION['login_user'] = $row['username'];
      header("location: admin.php");
    } else {
      header("location: test.php");
    }

  }

  //$username = 'musha';
  //$password = '123qwe';

?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <input type="text" name="username" placeholder="username" />
  <input type="password" name="password" placeholder="password"/>
  <button type="submit" name="login">Test</button>
</form>
