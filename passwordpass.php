<?php 
    session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Must Verify</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
      #followlink:hover{
          text-decoration: none;
      }#followlink{
          font-size: 40px;
      }
  </style>
</head>
<body>
<div class="jumbotron jumbotron-fluid">
  <div class="container text-center">
    <h1><strong><?php echo $_SESSION["email"] ?></strong>, Your password has be changed</h1>      
    <p>Please Follow the link to login <br><a id="followlink" href="signup.login.html">Login Here</a></p>
  </div>
</div>
</body>
</html>
