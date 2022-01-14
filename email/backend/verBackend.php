<?php 
session_start();

    include('../../include/db.inc.php');
    if(isset($_POST["otp_code"])){
        $otp = $_SESSION['otp'];
        $email = $_SESSION['email'];
        $otp_code = $_POST['otp_code'];

        if($otp != $otp_code){

            //   echo "Invalid OTP code";
              echo "Wrong";


        }else{
            mysqli_query($connection, "UPDATE signup SET status = 1 WHERE email = '$email'");

                // echo "Verfiy account done, you may sign in now";
                echo "Success";
            $_SESSION['status'] = 1;
            // header("location: ../../signup.login.html");

        }

    }
?>
