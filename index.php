<?php
    require 'header.php';
    require 'connection.php';
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
                    <li class="active"><a href="index.php">Home&nbsp<i class="fa fa-home" aria-hidden="true"></i></a></li>
                    <li><a href="register.php">Register&nbsp<i class="fa fa-user-plus" aria-hidden="true"></i></a></li>
                    <li><a href="login.php">Login&nbsp<i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <div class="jumbotron" align="center">
        <div class="container">
            <h1>E-Checkin Kamsis</h1>
            <p>Sistem maklumat keluar masuk pelajar kamsis Politeknik Ungku Omar</p>
        </div>
    </div>
    <div class="container">
        <h1>Maklumat Pelajar</h1>
        <div id="mytable" class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead align="center">
                    <tr class="table-bg">
                        <th>Name</th>
                        <th>Date</th>
                        <th>Matric no</th>
                        <th>Class</th>
                        <th>Department</th>
                        <th>Kamsis</th>
                        <th>Room</th>
                        <th>Scan (out)</th>
                        <th>Scan (in)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            //$sql = "SELECT * FROM public";
                            $sql = "SELECT nama, tarikh, no_matrik, kelas, jabatan, kamsis, no_bilik, keluar, masuk FROM user JOIN public ON user.ic = public.ic";
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
