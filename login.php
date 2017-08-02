<?php
  require 'header.php';
  require 'connection.php';
  session_start();

  if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM admin WHERE username='$username' and password=SHA2('$password', 512)";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
      $_SESSION['login_user'] = $row['username'];
      header("location: admin.php");
    }else {
      header("location: login.php");
    }
  }
?>
<body>
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">E-Checkin</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php">Home</a></li>
          <li><a href="register.php">Daftar</a></li>
          <li class="active"><a href="login.php">Login&nbsp<i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>
  <div class="container">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-info">
        <div class="panel-heading"><h4 class="text-center">Admin Login</h4></div>
        <div class="panel-body">
          <img class="logo1" src="images/e_checkin.png" />
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
              <label for="name">Username:</label>
              <input type="text" class="form-control" id="name" name="username" placeholder="Enter username"/>
            </div>
            <div class="form-group">
              <label for="passwd">Password:</label>
              <input type="password" class="form-control" id="passwd" name="password" placeholder="Enter password"/>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-block btn-info" name="login">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

<?php require 'footer.php' ?>
