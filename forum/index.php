<?php 
        session_start();
        if (isset($_SESSION['adminuser'])) {
            header("location:dashboard.php");
        }
        else if (isset($_SESSION['email'])) {
            header("location: blog.php");
        }
        else if (!isset($_SESSION['email'])) {
            header("location: ../signup.login.html");
        } 
        else if (!isset($_SESSION['adminuser'])) {
            header("location: ../signup.login.html");
        } 


?>