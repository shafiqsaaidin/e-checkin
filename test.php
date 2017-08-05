<?php
  require 'connection.php';

  $total = mysqli_query($conn, "SELECT * FROM public");
  $out = mysqli_query($conn, "SELECT count(keluar) as x FROM public WHERE keluar!='' AND masuk=''");

  echo json_encode($total); exit();
?>
