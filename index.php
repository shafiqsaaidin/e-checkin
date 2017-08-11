<?php
    require 'header.php';
    require 'connection.php';
?>
<body>
  <div class="bg-img" align="center">
      <div class="container">
          <h1>E-Checkin</h1>
          <h3>Residential College</h3>
          <label><?php echo date("l, d-m-Y")." | ";?><span id="clock"><?php echo date("g:i:s A"); ?></span></label>
      </div>
  </div>
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
                  <li class="active"><a href="index.php">Home&nbsp<i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li><a href="register.php">Register&nbsp<i class="fa fa-user-plus" aria-hidden="true"></i></a></li>
                  <li><a href="login.php">Login&nbsp<i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
              </ul>
          </div><!--/.nav-collapse -->
      </div>
  </nav>
    <div class="container">
      <h1>Student Information</h1>
      <div id="mytable" class="table-responsive">
          <table id="myTable" class="table table-hover table-bordered table-striped">
              <thead align="center">
                  <tr class="table-bg myHead">
                    <th>Student Name</th>
                    <th>Date</th>
                    <th>Matric no</th>
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
                  $sql = "SELECT nama, tarikh, no_matrik, kelas, jabatan, kamsis, no_bilik, keluar, masuk, status
                  FROM user JOIN public ON user.ic = public.ic WHERE masuk=''";

                  $result = mysqli_query($conn,$sql);
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['tarikh'] . "</td>";
                    echo "<td>" . $row['no_matrik'] . "</td>";
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
<?php
    require 'footer.php';
?>
