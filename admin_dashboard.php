<?php
  require 'header.php';
  require 'session.php';
  require_once 'connection.php';

  function get_total_user() {
    $total = mysqli_query($conn, "SELECT COUNT(ic) as total FROM user");
    $row = mysqli_fetch_array($total);
    return $row['total'];
  }

  if(isset($_POST['approve'])){
    mysqli_query($conn, "UPDATE public SET status='approve' WHERE keluar!='' AND masuk=''");
  }
?>
<link rel="stylesheet" href="css/dashboard.css">
<body>
  <nav class="navbar navbar-default navbar-fixed-top">
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
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="admin_dashboard.php"><i class="fa fa-address-book-o" aria-hidden="true"></i>&nbspDashboard</a></li>
          <li><a href="admin_edit.php"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbspEdit User</a></li>
          <li><a href="admin_report.php"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbspReport</a></li>
          <li><a href="#">Export</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp<?php echo $_SESSION['login_user']; ?>
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav> <!--### end navbar ###-->

  <!-- ### Main content ### -->
  <div class="container">
    <h3 class="page-header"><i class="fa fa-address-book-o" aria-hidden="true"></i>&nbspDashboard</h3>
    <div id="dashboard">
      <div class="row placeholders">
        <div class="col-sm-3">
          <div class="well">
            <i class="fa fa-users" aria-hidden="true"></i>
            <h4>Total User</h4>
            <span class="badge">
              <?php
                $total = mysqli_query($conn, "SELECT COUNT(ic) as total FROM user");
                $row = mysqli_fetch_array($total);
                echo $row['total'];
              ?>
            </span>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            <h4>Scan (Out)</h4>
            <span class="badge">
              <?php
                $total = mysqli_query($conn, "SELECT count(keluar) as total FROM public WHERE keluar!='' AND masuk=''");
                $row = mysqli_fetch_array($total);
                echo $row['total'];
              ?>
            </span>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <i class="fa fa-sign-in" aria-hidden="true"></i>
            <h4>Scan (In)</h4>
            <span class="badge">
              <?php
                $total = mysqli_query($conn, "SELECT count(masuk) as total FROM public WHERE keluar!='' AND masuk!=''");
                $row = mysqli_fetch_array($total);
                echo $row['total'];
              ?>
            </span>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <i class="fa fa-check" aria-hidden="true"></i>
            <h4>Pending User</h4>
            <span class="badge">
              <?php
                $total = mysqli_query($conn, "SELECT count(status) as total FROM public WHERE status='pending'");
                $row = mysqli_fetch_array($total);
                echo $row['total'];
              ?>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <h2>Students Table</h2>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-8">
            <div class="input-group information">
              <input type="text" class="form-control" placeholder="Search student" id="search_field">
              <div class="input-group-btn">
                <button class="btn btn-info" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <button type="submit" class="btn btn-info btn-block information" name="approve"><i class="fa fa-check" aria-hidden="true"></i>&nbspApprove all</button>
            </form>
          </div><br>
        </div>
      </div>
    </div>
    <div id="admin-table" class="table-responsive">
        <table id="myTable" class="table table-hover table-bordered">
          <thead>
            <tr class="table-bg myHead">
              <th>Name</th>
              <th>Matric no</th>
              <th>Ic no</th>
              <th>Class</th>
              <th>Department</th>
              <th>Kamsis</th>
              <th>Room</th>
              <th>Scan (out)</th>
              <th>Scan (in)</th>
              <th>Status</th>
            </tr>
          </thead>
            <tbody>
              <?php
                  $sql = "SELECT nama, no_matrik, user.ic, kelas, jabatan, kamsis, no_bilik, keluar, masuk, status
                  FROM user JOIN public ON user.ic = public.ic WHERE masuk=''";
                  $result = mysqli_query($conn,$sql);

                  while ($row = mysqli_fetch_array($result)) {
                  echo "<tr>";
                  echo "<td>" . $row['nama'] . "</td>";
                  echo "<td>" . $row['no_matrik'] . "</td>";
                  echo "<td>" . $row['ic'] . "</td>";
                  echo "<td>" . $row['kelas'] . "</td>";
                  echo "<td>" . $row['jabatan'] . "</td>";
                  echo "<td>" . $row['kamsis'] . "</td>";
                  echo "<td>" . $row['no_bilik'] . "</td>";
                  echo "<td>" . $row['keluar'] . "</td>";
                  echo "<td>" . $row['masuk'] . "</td>";
                  echo "<td>" . $row['status'] . "</td>";
                  echo "</tr>";
                }
                mysqli_close($conn);
              ?>
            </tbody>
        </table>
    </div>
  </div>
</body>
<?php require 'footer.php'; ?>
