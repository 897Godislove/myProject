<?php
include "../Forum/include/functions.php";
    session_start();
    
    if(session_destroy()) {
        // header("Location: ../signup.login.html");
        redirect_to("../signup.login.html");
    }
?>
