<?php
  require 'connection.php';

  $total = mysqli_query($conn, "SELECT COUNT(ic) as total FROM user");
  $out = mysqli_query($conn, "SELECT count(keluar) as x FROM public WHERE keluar!='' AND masuk=''");
  $row = mysqli_fetch_array($total);

?>
