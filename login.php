<?php
  require 'header.php';
  require 'connection.php';
  session_start();

  // Error message and class
  $msg = '';
  $msgClass = '';

  if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM admin WHERE username='$username' and password=SHA2('$password', 256)";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
      $_SESSION['login_user'] = $row['username'];
      $_SESSION['role'] = $row['user_level'];

      if($row['user_level'] == 'admin'){ //for admin account
        header("location: admin_dashboard.php");
      } else {
        header("location: guard_dashboard.php");
      }
    }else {
      //echo "Incorrect username or password";
      //header("location: login.php");
      $msg = "Invalid username or password, try again.";
      $msgClass = "alert-danger";
    }

    mysqli_close($conn);
  }
?>
<style>
  body {
    background-color: rgba(90,193,222,0.3);
  }
</style>
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
        <img class="navbar-brand" src="images/e_checkin.png"><a class="navbar-brand" href="#">E-Checkin</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php">Home&nbsp<i class="fa fa-home" aria-hidden="true"></i></a></li>
          <li><a href="register.php">Register&nbsp<i class="fa fa-user-plus" aria-hidden="true"></i></a></li>
          <li class="active"><a href="login.php">Login&nbsp<i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>
  <div class="container">
    <div class="col-md-4 col-md-offset-4">
      <?php if($msg != ""): ?>
        <div class="alert <?php echo $msgClass; ?> alert-dismissable fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <?php echo $msg; ?>
        </div>
      <?php endif ?>
      <div class="panel panel-bg panel-info">
        <div class="panel-body">
          <img class="logo1" src="images/e_checkin.png" />
          <p class="text-center"><label>E-Checkin</label> Login</p>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                <input type="text" class="form-control input" id="name" name="username" placeholder="Enter username"/>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp</span>
              <input type="password" class="form-control input" id="passwd" name="password" placeholder="Enter password"/>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-sm btn-block btn-info" name="login">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

<?php require 'footer.php' ?>
