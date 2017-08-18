<?php
  require 'header.php';
  require 'session.php';
  require_once 'connection.php';

  $msg = $msgClass = '';

  if(isset($_POST['delete'])){
    $ic = mysqli_real_escape_string($conn, $_POST['ic']);

    $sql = "DELETE FROM user WHERE ic='$ic'";

    if(mysqli_query($conn, $sql)){
        $msg = "Delete successfull";
        $msgClass = 'alert-success';
    } else{
        $msg = "Delete error".mysqli_error($conn);
        $msgClass = 'alert-danger';
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
    <div class="row">
      <div class="col-md-8">
        <h3><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbspEdit user</h3>
      </div>
      <div class="col-md-4">
        <div class="input-group information">
          <input type="text" class="form-control" placeholder="Search student" id="search_field">
          <div class="input-group-btn">
            <button class="btn btn-info" type="submit">
              <i class="fa fa-search" aria-hidden="true"></i>
            </button>
          </div>
        </div>
      </div>
    </div><br>
    <?php if($msg !=''): ?>
        <div class="alert <?php echo $msgClass; ?> alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <?php echo $msg; ?>
        </div>
    <?php endif ?> <!--## Display message when register successfull/error ##-->
    <div class="table-responsive">
      <table id="myTable" class="table table-hover">
        <thead>
          <tr class="table-bg myHead">
            <th>Name</th>
            <th>Matric Number</th>
            <th>Identity Card</th>
            <th>Class</th>
            <th>Department</th>
            <th>Residential Block</th>
            <th>Room Number</th>
            <th colspan="2">Edit User</th>
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
                echo "<td>
                        <a href='admin_edit_update.php?ic=".$row['ic']."' class='btn btn-xs btn-info'>
                          <i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit
                        </a>
                      </td>";
                echo "<td>
                        <form method='POST' action='admin_edit.php'>
                          <input type='hidden' name='ic' value='".$row['ic']."'>
                          <button type='submit' onclick='return confirm(`Delete this user ".$row['ic']." ?`);' name='delete' class='btn btn-xs btn-danger'>
                            <i class='fa fa-trash-o' aria-hidden='true'></i> Delete
                          </button>
                        </form>
                      </td>";
                echo "</tr>";
              }
            ?>
          </tbody>
      </table>
    </div>
  </div>
</body>
<?php
  mysqli_close($conn);
  require 'footer.php';
?>
