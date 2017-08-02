<?php
  require 'header.php';
  require 'session.php';
  require_once 'connection.php';
?>
<link rel="stylesheet" href="css/dashboard.css">
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">E-Checkin</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="admin_dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout&nbsp<i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search">
              <div class="input-group-btn">
                <button class="btn btn-info" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="admin_dashboard.php"><i class="fa fa-address-book-o" aria-hidden="true"></i>&nbspDashboard<span class="sr-only">(current)</span></a></li>
            <li><a href="admin_edit.php"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbspEdit User</a></li>
            <li><a href="admin_report.php"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbspReport</a></li>
            <li><a href="#">Export</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><i class="fa fa-address-book-o" aria-hidden="true"></i>&nbspDashboard</h1>

          <div class="row placeholders">
            <div class="col-sm-3 placeholder">
              <div class="well">
                <i class="fa fa-users" aria-hidden="true"></i>
                <h4>Total User</h4>
                <span class="text-muted">Something else</span>
              </div>
            </div>
            <div class="col-sm-3 placeholder">
              <div class="well">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <h4>Outing student</h4>
                <span class="text-muted">Something else</span>
              </div>
            </div>
            <div class="col-sm-3 placeholder">
              <div class="well">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
                <h4>In student</h4>
                <span class="text-muted">Something else</span>
              </div>
            </div>
            <div class="col-sm-3 placeholder">
              <div class="well">
                <i class="fa fa-check" aria-hidden="true"></i>
                <h4>Pending User</h4>
                <span class="text-muted">Something else</span>
              </div>
            </div>
          </div>

          <h2 class="sub-header">Students Table</h2>
          <div id="admin-table" class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr class="table-bg">
                    <th>Nama</th>
                    <th>Kad Matrik</th>
                    <th>Kad Pengenalan</th>
                    <th>Kelas</th>
                    <th>Jabatan</th>
                    <th>Kamsis</th>
                    <th>Waktu Keluar</th>
                    <th>Waktu Masuk</th>
                  </tr>
                </thead>
                  <tbody>
                    <?php
                        $sql = "SELECT nama, no_matrik, user.ic, kelas, jabatan, kamsis, keluar, masuk FROM user JOIN public ON user.ic = public.ic";
                        $result = mysqli_query($conn,$sql);

                        while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['no_matrik'] . "</td>";
                        echo "<td>" . $row['ic'] . "</td>";
                        echo "<td>" . $row['kelas'] . "</td>";
                        echo "<td>" . $row['jabatan'] . "</td>";
                        echo "<td>" . $row['kamsis'] . "</td>";
                        echo "<td>" . $row['keluar'] . "</td>";
                        echo "<td>" . $row['masuk'] . "</td>";
                        echo "</tr>";
                      }
                      mysqli_close($conn);
                    ?>
                  </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
</body>
<?php require 'footer.php'; ?>
