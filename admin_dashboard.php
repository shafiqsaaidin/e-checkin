<?php
  require 'header.php';
  require 'session.php';
  require_once 'connection.php';

  if($_SESSION['role'] != 'admin'){
    header("location: guard_dashboard.php");
  }

  $btnClass = "btn-info";

  function get_total_user() {
    $total = mysqli_query($conn, "SELECT COUNT(ic) as total FROM user");
    $row = mysqli_fetch_array($total);
    return $row['total'];
  }

  if(isset($_POST['approve'])){
    mysqli_query($conn, "UPDATE public SET status='approved' WHERE keluar!='' AND masuk=''");
  }

  if(isset($_POST['block'])){
    $ic = mysqli_real_escape_string($conn, $_POST['ic']);

    $sql = "UPDATE public SET status='pending' WHERE ic = '$ic' AND masuk=''";

    mysqli_query($conn, $sql);
  }

  if(isset($_POST['del_date'])){
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $sql = "DELETE FROM public WHERE tarikh='$date'";

    mysqli_query($conn, $sql);
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
        <img class="navbar-brand" src="images/e_checkin.png"><a class="navbar-brand" href="#">E-Checkin</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="admin_dashboard.php"><i class="fa fa-address-book-o" aria-hidden="true"></i>&nbspDashboard</a></li>
          <li><a href="admin_edit.php"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbspEdit User</a></li>
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
          <div class="panel panel-info quick-panel">
            <div class="panel-body">
              <i class="fa fa-users" aria-hidden="true"></i>
            </div>
            <div class="panel-footer">
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
        </div>
        <div class="col-sm-3">
          <div class="panel panel-info quick-panel">
            <div class="panel-body">
              <i class="fa fa-sign-out" aria-hidden="true"></i>
            </div>
            <div class="panel-footer">
              <h4>Scan (Out)</h4>
              <span class="badge">
                <?php
                  $total = mysqli_query($conn, "SELECT count(keluar) as total FROM public WHERE keluar!='' AND masuk='' AND tarikh=date_format(now(), '%d/%m/%Y')");
                  $row = mysqli_fetch_array($total);
                  echo $row['total'];
                ?>
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="panel panel-info quick-panel">
            <div class="panel-body">
              <i class="fa fa-sign-in" aria-hidden="true"></i>
            </div>
            <div class="panel-footer">
              <h4><a data-toggle="modal" data-target="#scan_in">Scan (In)</a></h4>
              <span class="badge">
                <?php
                  $total = mysqli_query($conn, "SELECT count(masuk) as total FROM public WHERE keluar!='' AND masuk!='' AND tarikh=date_format(now(), '%d/%m/%Y')");
                  $row = mysqli_fetch_array($total);
                  echo $row['total'];
                ?>
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="panel panel-info quick-panel">
            <div class="panel-body">
              <i class="fa fa-check" aria-hidden="true"></i>
            </div>
            <div class="panel-footer">
              <h4>Pending User
                <span class="badge">
                  <?php
                    $total = mysqli_query($conn, "SELECT count(status) as total FROM public WHERE status='pending' AND tarikh=date_format(now(), '%d/%m/%Y')");
                    $row = mysqli_fetch_array($total);
                    echo $row['total'];
                  ?>
                </span>
              </h4>
            </div>
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
            <div class="btn-group pull-right">
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <button type="button" class="btn btn-success information" onclick="window.location.reload()"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                <button type="submit" class="btn btn-info information" name="approve"><i class="fa fa-check" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-danger information" data-toggle="modal" data-target="#clean"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
              </form>
            </div>
          </div><br>
        </div>
      </div>
    </div>
    <div id="admin-table" class="table-responsive">
        <table id="myTable" class="table table-hover table-bordered">
          <thead>
            <tr class="table-bg myHead">
              <th>Name</th>
              <th>Date</th>
              <th>Matric no</th>
              <th>Ic no</th>
              <th>Class</th>
              <th>Department</th>
              <th>Kamsis</th>
              <th>Room</th>
              <th>Scan (out)</th>
              <th>Scan (in)</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
            <tbody>
              <?php
                  $sql = "SELECT nama, tarikh, no_matrik, user.ic, kelas, jabatan, kamsis, no_bilik, keluar, masuk, status
                  FROM user JOIN public ON user.ic = public.ic WHERE masuk=''";
                  $result = mysqli_query($conn,$sql);

                  while ($row = mysqli_fetch_array($result)) {
                  echo "<tr>";
                  echo "<td>" . $row['nama'] . "</td>";
                  echo "<td>" . $row['tarikh'] . "</td>";
                  echo "<td>" . $row['no_matrik'] . "</td>";
                  echo "<td>" . $row['ic'] . "</td>";
                  echo "<td>" . $row['kelas'] . "</td>";
                  echo "<td>" . $row['jabatan'] . "</td>";
                  echo "<td>" . $row['kamsis'] . "</td>";
                  echo "<td>" . $row['no_bilik'] . "</td>";
                  echo "<td>" . $row['keluar'] . "</td>";
                  echo "<td>" . $row['masuk'] . "</td>";
                  echo "<td>" . $row['status'] . "</td>";
                  echo "<td>
                          <form method='POST' action='".htmlspecialchars($_SERVER['PHP_SELF'])."'>
                            <input type='hidden' name='ic' value='".$row['ic']."'>
                            <button type='submit' name='block' class='btn btn-xs btn-danger'>Block</button>
                          </form>
                        </td>";
                  echo "</tr>";
                }
                //mysqli_close($conn);
              ?>
            </tbody>
        </table>
    </div>
  </div>

  <!-- Modal -->
  <div id="scan_in" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="col-md-4">
            <h4 class="modal-title">Scanned In Student</h4>
          </div>
          <div class="col-md-6">
            <div style="margin-top:1px;" class="input-group information">
              <input type="text" class="form-control input-sm" placeholder="Search student" id="search_student">
              <div class="input-group-btn">
                <button class="btn btn-info btn-sm" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table id="scannedTable" class="table table-bordered">
              <thead>
                <tr class="table-bg myHead">
                  <th>Name</th>
                  <th>Date</th>
                  <th>Matric no</th>
                  <th>Kamsis</th>
                  <th>Room</th>
                  <th>Scan (out)</th>
                  <th>Scan (in)</th>
                  <th>Status</th>
                </tr>
              </thead>
                <tbody>
                  <?php
                      $sql = "SELECT nama, tarikh, no_matrik, user.ic, kelas, jabatan, kamsis, no_bilik, keluar, masuk, status
                      FROM user JOIN public ON user.ic = public.ic WHERE keluar!='' AND masuk!='' AND tarikh=date_format(now(), '%d/%m/%Y') ORDER BY masuk DESC";
                      $result = mysqli_query($conn,$sql);

                      while ($row = mysqli_fetch_array($result)) {
                      echo "<tr>";
                      echo "<td>" . $row['nama'] . "</td>";
                      echo "<td>" . $row['tarikh'] . "</td>";
                      echo "<td>" . $row['no_matrik'] . "</td>";
                      echo "<td>" . $row['kamsis'] . "</td>";
                      echo "<td>" . $row['no_bilik'] . "</td>";
                      echo "<td>" . $row['keluar'] . "</td>";
                      echo "<td>" . $row['masuk'] . "</td>";
                      echo "<td>" . $row['status'] . "</td>";
                      echo "</tr>";
                    }
                  ?>
                </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <!-- Modal -->
<div id="clean" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete log</h4>
      </div>
      <div class="modal-body">
        <legend>Available date</legend>
        <ul class="list-group">
          <?php
            $total = mysqli_query($conn, "SELECT tarikh FROM public");
            $row = mysqli_fetch_array($total);
            echo "<li class='list-group-item'>".$row['tarikh']."</li>";
          ?>
        </ul>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <div class="input-group">
            <input type="text" class="form-control" name="date" placeholder="02/08/2017">
            <div class="input-group-btn">
              <button class="btn btn-danger" type="submit" name="del_date">Delete</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</body>
<?php
  mysqli_close($conn);
  require 'footer.php';
?>
