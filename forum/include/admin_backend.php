<?php require ("db.php"); ?>
<?php include ("functions.php"); ?>
<?php include ("sessions.php"); ?>
<?php 

    if (isset($_POST['username'])) {
    $username = stripslashes($_POST['username']);    // removes backslashes
    $username = mysqli_real_escape_string($connection, $username);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($connection, $password);

    // Check if user  exist in the database
    $query    = "SELECT * FROM `admins` WHERE username='$username'
                AND password='$password'";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ( "Error in query".mysqli_error($connection) );
    }
    
    $verification = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if ($verification !== 1) {

        echo 0;
    } else {
        // Redirect to user dashboard page
        // $_SESSION['id'] = $row['id'];
        $_SESSION['adminuser'] = $row['username'];
        // $_SESSION['password'] = $row['password'];

        echo 1;
    }

    } else {

    }



?>



