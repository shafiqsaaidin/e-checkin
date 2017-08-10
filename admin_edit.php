<?php
  require 'header.php';
  require 'session.php';
  require_once 'connection.php';
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
          <li><a href="admin_dashboard.php"><i class="fa fa-address-book-o" aria-hidden="true"></i>&nbspDashboard</a></li>
          <li class="active"><a href="admin_edit.php"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbspEdit User</a></li>
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

    <div class="container">
      <h3 class="page-header"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbspEdit user</h3>
      <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr class="table-bg">
                <th>Nama</th>
                <th>Kad Matrik</th>
                <th>Kad Pengenalan</th>
                <th>Kelas</th>
                <th>Jabatan</th>
                <th>Kamsis</th>
                <th>Bilik</th>
              </tr>
            </thead>
              <tbody>
                <?php
                    $sql = "SELECT * FROM user";
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
