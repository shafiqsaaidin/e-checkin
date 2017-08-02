<?php
  require 'connection.php';

  if(isset($_POST['submit'])){
      $ic = mysqli_real_escape_string($_POST['ic']);
      $nama = mysqli_real_escape_string($_POST['nama']);
      $no_matrik = mysqli_real_escape_string($_POST['no_matrik']);
      $kelas = mysqli_real_escape_string($_POST['kelas']);
      $jabatan = mysqli_real_escape_string($_POST['jabatan']);
      $kamsis = mysqli_real_escape_string($_POST['kamsis']);
      $bilik = mysqli_real_escape_string($_POST['no_bilik']);

      $sql = "INSERT INTO user (ic, nama, no_matrik, kelas, jabatan, kamsis, no_bilik)
      VALUES ('$ic','$nama', '$no_matrik', '$kelas', '$jabatan', '$kamsis', '$bilik')";

      if(mysqli_query($conn, $sql)){
          $msg = "Registration successfull";
          $msgClass = 'alert-success';
      } else{
          $msg = "Registration error";
          $msgClass = 'alert-danger';
      }
      mysqli_close($conn);
  }


?>
<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
        <label class="control-label col-sm-3" for="ic">Identity Card:</label>
        <div class="col-sm-9">
          <input id="ic" type="text" required class="form-control" name="ic" placeholder="Ic">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="nama">Full Name:</label>
        <div class="col-sm-9">
          <input id="nama" type="text" required class="form-control" name="nama" placeholder="Name">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="no_matrik">Matric Id:</label>
        <div class="col-sm-9">
          <input id="no_matrik" type="text" required class="form-control" name="no_matrik" placeholder="Matrik No.">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="kelas">Class:</label>
        <div class="col-sm-9">
          <input id="kelas" type="text" required class="form-control" name="kelas" placeholder="Class">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="jabatan">Department:</label>
        <div class="col-sm-9">
          <input id="jabatan" type="text" class="form-control" name="jabatan" placeholder="Jabatan">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="kamsis">Kamsis:</label>
        <div class="col-sm-9">
            <select id="kamsis" class="form-control" name="kamsis">
                <option>Please Choose</option>
                <option value="delima">Delima</option>
                <option value="kasturi">Kasturi</option>
                <option value="mawar">Mawar</option>
                <option value="melur">Melur</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="bilik">Room Number:</label>
        <div class="col-sm-9">
          <input id="bilik" type="text" class="form-control" name="no_bilik" placeholder="Room no.">
        </div>
    </div>
    <button type="submit" class="btn btn-info pull-right" name="submit">Submit</button>
</form>
