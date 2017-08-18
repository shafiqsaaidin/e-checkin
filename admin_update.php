<?php
  require 'header.php';
  require 'connection.php';

  $msg = $msgClass = '';

  if(isset($_REQUEST['ic'])){
    $edit_ic = mysqli_real_escape_string($conn, $_REQUEST['ic']);
    $sql = "SELECT * FROM user WHERE ic='$edit_ic'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);
  }

  if(isset($_POST['update'])){
      //$ic = mysqli_real_escape_string($conn, $_POST['ic']);
      $nama = mysqli_real_escape_string($conn, strtoupper($_POST['nama']));
      $no_matrik = mysqli_real_escape_string($conn, strtoupper($_POST['no_matrik']));
      $kelas = mysqli_real_escape_string($conn, strtoupper($_POST['kelas']));
      $jabatan = mysqli_real_escape_string($conn, strtoupper($_POST['jabatan']));
      $kamsis = mysqli_real_escape_string($conn, strtoupper($_POST['kamsis']));
      $bilik = mysqli_real_escape_string($conn, strtoupper($_POST['bilik']));

      $sql = "UPDATE user SET nama='$nama', no_matrik='$no_matrik', kelas='$kelas', jabatan='$jabatan', kamsis='$kamsis', no_bilik='$bilik' WHERE ic='$edit_ic'";

      if(mysqli_query($conn, $sql)){
          $msg = "Update successfull";
          $msgClass = 'alert-success';
      } else{
          $msg = "Update error".mysqli_error($conn);
          $msgClass = 'alert-danger';
      }
  }
  mysqli_close($conn);
?>
<div class="container-fluid">
  <?php if($msg !=''): ?>
      <div class="alert <?php echo $msgClass; ?> alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <?php echo $msg; ?>
      </div>
  <?php endif ?> <!--## Display message when register successfull/error ##-->

  <form class="form-horizontal" method="POST" action="admin_edit.php">
      <div class="form-group">
          <label class="control-label col-sm-3" for="ic">Identity Card:</label>
          <div class="col-sm-9">
            <input id="ic" type="text" class="form-control" name="ic" value="<?php echo $row['ic']; ?>">
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-sm-3" for="nama">Full Name:</label>
          <div class="col-sm-9">
            <input id="nama" type="text" required class="form-control" name="nama" value="<?php echo $row['nama']; ?>">
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-sm-3" for="no_matrik">Matric Number:</label>
          <div class="col-sm-9">
            <input id="no_matrik" type="text" required class="form-control" name="no_matrik" value="<?php echo $row['no_matrik']; ?>">
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-sm-3" for="kelas">Class:</label>
          <div class="col-sm-9">
            <input id="kelas" type="text" required class="form-control" name="kelas" value="<?php echo $row['kelas']; ?>">
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-sm-3" for="jabatan">Department:</label>
          <div class="col-sm-9">
            <input id="jabatan" type="text" class="form-control" name="jabatan" value="<?php echo $row['jabatan']; ?>">
          </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3" for="kamsis">Residential College:</label>
        <div class="col-sm-9">
            <select id="kamsis" class="form-control" name="kamsis">
              <option value="<?php echo $row['kamsis']; ?>">Please Choose</option>
              <option value="delima">Delima</option>
              <option value="zamrud">Zamrud</option>
              <option value="emas">Emas</option>
              <option value="berlian">Berlian</option>
              <option value="mutiara">Mutiara</option>
            </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3" for="bilik">Room Number:</label>
        <div class="col-sm-9">
          <input id="bilik" type="text" class="form-control" name="bilik" value="<?php echo $row['no_bilik']; ?>">
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-info btn-block" name="update">Update</button>
      </div>
  </form>
</div>
