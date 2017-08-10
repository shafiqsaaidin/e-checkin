<?php
    require 'header.php';
    require 'connection.php';

    //$ic = $nama = $no_matrik = $kelas = $jabatan = $kamsis = '';
    $msg = $msgClass = '';

    if(isset($_POST['submit'])){
        $ic = mysqli_real_escape_string($conn, $_POST['ic']);
        $nama = mysqli_real_escape_string($conn, strtoupper($_POST['nama']));
        $no_matrik = mysqli_real_escape_string($conn, strtoupper($_POST['no_matrik']));
        $kelas = mysqli_real_escape_string($conn, strtoupper($_POST['kelas']));
        $jabatan = mysqli_real_escape_string($conn, strtoupper($_POST['jabatan']));
        $kamsis = mysqli_real_escape_string($conn, strtoupper($_POST['kamsis']));
        $bilik = mysqli_real_escape_string($conn, strtoupper($_POST['bilik']));

        $sql = "INSERT INTO user (ic, nama, no_matrik, kelas, jabatan, kamsis, no_bilik)
        VALUES ('$ic','$nama', '$no_matrik', '$kelas', '$jabatan', '$kamsis', '$bilik')";

        if(mysqli_query($conn, $sql)){
            $msg = "Registration successfull";
            $msgClass = 'alert-success';
        } else{
            $msg = "Registration error";
            $msgClass = 'alert-danger';
        }
    }
    mysqli_close($conn);
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
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="index.php">Home&nbsp<i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li class="active"><a href="register.php">Register&nbsp<i class="fa fa-user-plus" aria-hidden="true"></i></a></li>
                  <li><a href="login.php">Login&nbsp<i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <?php if($msg !=''): ?>
                <div class="alert <?php echo $msgClass; ?> alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $msg; ?>
                </div>
            <?php endif ?>
            <div class="panel panel-info">
                <div class="panel-heading"><h4>Student Registration Form</h4></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="ic">Identity Card:</label>
                            <div class="col-sm-9">
                              <input id="ic" type="text" required class="form-control" name="ic" placeholder="Ic no.">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="nama">Full Name:</label>
                            <div class="col-sm-9">
                              <input id="nama" type="text" required class="form-control" name="nama" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="no_matrik">Matric Number:</label>
                            <div class="col-sm-9">
                              <input id="no_matrik" type="text" required class="form-control" name="no_matrik" placeholder="Matrik no.">
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
                              <input id="jabatan" type="text" class="form-control" name="jabatan" placeholder="Department">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="kamsis">Residential College:</label>
                            <div class="col-sm-9">
                                <select id="kamsis" class="form-control" name="kamsis">
                                    <option>Please Choose</option>
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
                              <input id="bilik" type="text" class="form-control" name="bilik" placeholder="Room no.">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info pull-right" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
    require 'footer.php';
?>
