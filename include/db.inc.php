<?php 
    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "andrew";

    $connection=mysqli_connect($db_servername, $db_username, $db_password , $dbname);

    if (!$connection) {
        die("Error in CONNECTION");
    }
    // else {
    //     echo 'Success';
    // }

?>