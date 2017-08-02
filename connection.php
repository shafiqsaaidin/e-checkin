<?php     
    $servername = "localhost";
    $username = "musha";
    $password = "#musha@16";
    $database = "scan";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>