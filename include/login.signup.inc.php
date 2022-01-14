<?php 
        // THIS IS FOR SIGN-UP
    if(isset($_POST['reg_name'])) {
        session_start();
        require 'db.inc.php';
        $name = mysqli_real_escape_string($connection, $_POST['reg_name']);
        $email = mysqli_real_escape_string($connection, $_POST['reg_email']);
        $pwd = mysqli_real_escape_string($connection, $_POST['reg_password']);
        $datestamp = date("Y-m-d H:i:s");
        // echo $name;
        // echo '<br>';
        // echo $email;
        // echo '<br>';
        // echo $pwd;
        // echo '<br>';
        // echo $datestamp;
        // echo '<br>';

       
                $sql = "SELECT * FROM signup  WHERE email = '$email'";
                $result = mysqli_query($connection, $sql);
                if (!$result) {
                    mysqli_error($connection);
                }
                $resultCheck = mysqli_num_rows($result);
                
                    if($resultCheck > 0) {
                        echo 'Email already in use';
                       
                    } else {
                        $encryptedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                        $sql = "INSERT into `signup` (name, email, password, datestamp, status) VALUES ('$name', '$email', '$encryptedPwd', '$datestamp', 0);";
                        $query = mysqli_query($connection, $sql);
                        if ($query) {
 
                                    
                            $otp = rand(100000,999999);
                            $_SESSION['otp'] = $otp;
                            $_SESSION['email'] = $email;
                            // $_SESSION['password'] = $encryptedPwd;
                            $_SESSION['date'] = $datestamp;
                            // $_SESSION['con'] = $connection;
                            // $_SESSION['query'] = $query;

                            require "../email/Mail/phpmailer/PHPMailerAutoload.php";
                            $mail = new PHPMailer;
            
                            $mail->isSMTP();
                            $mail->Host='smtp.gmail.com';
                            $mail->Port=587;
                            $mail->SMTPAuth=true;
                            $mail->SMTPSecure='tls';
            
                            $mail->Username='kingpeace12345@gmail.com';
                            $mail->Password='Temitope1234';
            
                            $mail->setFrom('email account', 'OTP Verification');
                            $mail->addAddress($_POST["reg_email"]);
            
                            $mail->isHTML(true);
                            $mail->Subject="Your verification code";
                            $mail->Body="<p>Dear user, We received your request for a verification code</p>
                            <h3>Your verify OTP code is $otp <br></h3>
                            <br><br>
                            <p>With regrads,</p>
                            <b>...................</b>";
            
                                    if(!$mail->send()){
                                        echo "Register Failed, Invalid Email ";

                                    }else{
                                        
                                        echo $email." Check your Email for the OTP code";
                                        header("location: ../email/verification.php");
                                    }

                     } else {
                            mysqli_error($connection);
                        }

                    }
    }

            


                        // THIS IS FOR LOGIN

    // When form submitted, check and create user session.
    else if (isset($_POST['login_email'])) {
        session_start();
        require 'db.inc.php';
        $email = stripslashes($_POST['login_email']);    // removes backslashes
        $email = mysqli_real_escape_string($connection, $email);
        $password = stripslashes($_POST['login_password']);
        $password = mysqli_real_escape_string($connection, $password);

        // Check if user  exist in the database
        $query    = "SELECT * FROM `signup` WHERE email='$email'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die ( "Error in query".mysqli_error($connection) );
        }
        $verification = mysqli_num_rows($result);
        // Converts $query to boolean

        if ($verification !== 1) {
            echo 'Invalid Email';
        } else{
                if($row = mysqli_fetch_assoc($result)) {
                   $hashedPwdCheck = password_verify($password, $row['password']);
                    if($hashedPwdCheck == false) {
                       echo 'Invalid Password';
                    } elseif($hashedPwdCheck == true) {
                        //Logs the user in
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['email'] = $row['email'];
                        // $_SESSION['password'] = $row['password'];
                        $_SESSION['status'] = $row['status'];
                        
                        echo 'Login Successful';

                    }
                }
            }


        } else {

        }

?>