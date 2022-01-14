<?php 
            session_start();
            if(!isset($_SESSION["adminuser"])) {
                header("Location: signup.login.html");
                exit();
            }

?>