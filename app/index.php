<?php
    require '../connection.php';

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    $ic = mysqli_real_escape_string($conn, $_REQUEST['data']);

    // Query set for mysql
    $sql = "SELECT * FROM user WHERE ic=$ic";

    $sql1 = "INSERT INTO public(ic, masuk, keluar, tarikh, status)
        VALUES($ic, '', date_format(now(), '%r'), date_format(now(), '%d/%m/%Y'), 'pending')";

    $sql2 = "UPDATE public SET masuk=date_format(now(), '%r') WHERE ic=$ic AND masuk='' AND status='approve'";

    // User check
    $check_user = mysqli_query($conn, $sql);
    $check_row_user = mysqli_num_rows($check_user);
    // Public Check
    $check_public = mysqli_query($conn, "select * from public where ic=$ic AND masuk=''");
    $check_row_public = mysqli_num_rows($check_public);

    // Check user ic in table user, if user not exist, need to register first then will insert into public_db
    if($check_row_user > 0){
      //echo "User available";
     if($check_row_public > 0 ) {
       //echo "User exists";
        if(mysqli_query($conn, $sql2)){
            echo "Update successfully";
        } else{
            echo "Error: ".$sql2."<br>".mysqli_error($conn);
        }
     } else {
        if(mysqli_query($conn, $sql1)){
            echo "New record created successfully";
        } else{
            echo "Error: ".$sql1."<br>".mysqli_error($conn);
        }
      }
    } else {
      echo "Please register first";
    }

    mysqli_close($conn);
?>
