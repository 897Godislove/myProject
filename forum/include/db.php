<?php 
    $servername = "Localhost";
    $serverusername = "root";
    $serverpassword = "";
    $dbname = "andrew";
    $connection = mysqli_connect($servername, $serverusername, $serverpassword, $dbname);
    if (!$connection) {
        die("Error in Connection <br><br>".mysqli_connect_error());
    }

?>

