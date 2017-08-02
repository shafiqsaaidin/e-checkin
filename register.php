<?php
    require 'header.php';
    require 'connection.php';

    //$ic = $nama = $no_matrik = $kelas = $jabatan = $kamsis = '';
    $msg = $msgClass = '';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $ic = $_POST['ic'];
        $nama = strtoupper($_POST['nama']);
        $no_matrik = strtoupper($_POST['no_matrik']);
        $kelas = strtoupper($_POST['kelas']);
        $jabatan = strtoupper($_POST['jabatan']);
        $kamsis = strtoupper($_POST['kamsis']);

        $sql = "INSERT INTO user (ic, nama, no_matrik, kelas, jabatan, kamsis)
        VALUES ('$ic','$nama', '$no_matrik', '$kelas', '$jabatan', '$kamsis')";

        if(mysqli_query($conn, $sql)){
            $msg = "Register successfull";
            $msgClass = 'alert-success';
        } else{
            $msg = "Register error";
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
                <a class="navbar-brand" href="#">E-Checkin</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="register.php">Register</a></li>
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
                <div class="panel-heading"><h4>Borang Pendaftaran Pelajar</h4></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="ic">Kad Pengenalan:</label>
                            <div class="col-sm-9">
                              <input id="ic" type="text" required class="form-control" name="ic" placeholder="Ic">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="nama">Nama Penuh:</label>
                            <div class="col-sm-9">
                              <input id="nama" type="text" required class="form-control" name="nama" placeholder="Nama">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="no_matrik">Number Matrik:</label>
                            <div class="col-sm-9">
                              <input id="no_matrik" type="text" required class="form-control" name="no_matrik" placeholder="No. Matrik">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="kelas">Kelas:</label>
                            <div class="col-sm-9">
                              <input id="kelas" type="text" required class="form-control" name="kelas" placeholder="Kelas">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="jabatan">Jabatan:</label>
                            <div class="col-sm-9">
                              <input id="jabatan" type="text" class="form-control" name="jabatan" placeholder="Jabatan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="kamsis">Kamsis:</label>
                            <div class="col-sm-9">
                                <select id="kamsis" class="form-control" name="kamsis">
                                    <option>sila pilih</option>
                                    <option value="delima">Delima</option>
                                    <option value="kasturi">Kasturi</option>
                                    <option value="mawar">Mawar</option>
                                    <option value="melur">Melur</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info pull-right" name="submit">Hantar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
    require 'footer.php';
?>
