<?php 
    include "include/db.php";
    include "include/functions.php";
    session_start();
        if (!isset($_SESSION['nickname'])) {
            header("location: myprofile.php");
        }else {
?>
<?php 
global $connection;
    $searchqueryparameter = $_GET['email'];
    $sql = "SELECT * FROM `signup` where email = '$searchqueryparameter'";
    $result = mysqli_query($connection, $sql);
        if (!$result) {
            die("Error in Connection<br>".mysqli_error($connection));
        }
    $verification = mysqli_num_rows($result);

        if ($verification == 1) {
            while ($rows = mysqli_fetch_assoc($result)) {
                $existingnamed = $rows['name'];
                $existingnicknamed = $rows['nickname'];
                $existingbiod = $rows['bio'];
                $existingimaged = $rows['image'];
                $existingheadlined = $rows['headline'];
            }

        } else {
            header("location: blog.php?page=1");
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Libraries/assets/css/bootstrap-5.0.0-alpha-2.min.css" />
    <link rel="stylesheet" href="Libraries/bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/style.css?">
    <link rel="stylesheet" href="Libraries/fontawesome/css/all.css">
    <link rel="stylesheet" href="Libraries/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="Libraries/assets/css/LineIcons.2.0.css">
    <link rel="stylesheet" href="Libraries/assets/css/tiny-slider.css">
    <link rel="stylesheet" href="Libraries/assets/css/glightbox.min.css">
    <link rel="stylesheet" href="Libraries/assets/css/animate.css">
    <link rel="stylesheet" href="Libraries/assets/css/lindy-uikit.css?">

    <title>Profile</title>
</head>
<body>
            <!-- PRELOADER -->
    <div class="preloader">
        <div class="loader">
        <div class="spinner">
            <div class="spinner-container">
            <div class="spinner-rotator">
                <div class="spinner-left">
                <div class="spinner-circle"></div>
                </div>
                <div class="spinner-right">
                <div class="spinner-circle"></div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <!-- navbar start-->
    <?php 
        include ("include/header.php")
    ?>
    <!-- navbar end -->
    <!-- header start -->
    <header class="bg-dark py-3 my-5" style="color: white;">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <h1><i class="fas fa-user text-success mr-2"></i><?php echo htmlentities($existingnamed)?></h1>
                    <span class="">@<?php echo htmlentities($existingnicknamed)?></span>
                    <h3><?php echo $existingheadlined?></h3>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->
    
    <!-- Main Area Start-->
        <section class="container py-2 mb-4">
            <div class="row">
                <div class="col-md-3">
                    <img src="profile pictures/<?php echo $existingimaged;?>" class="d-block img-fluid mb-3" alt="" style="border-radius: 40%;">
                </div>
                <div class="col-md-9" style="min-height: 450px;">
                    <div class="card">
                        <div class="card-body">
                            <p class="lead">
                                <?php echo $existingbiod;?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Main Area End -->

    <!-- footer start -->
    <footer class="bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="lead text-center">Theme By | Mufasa | <span class="year"></span> &copy; ---- All Right Reserved</p>
                    <p class="text-center small">
                         elit. Cumque illum deserunt reiciendis, at incidunt praesentium
                         beatae tempore placeat rem blanditiis. Maxime repellat nobis, asperiores
                         doloremque necessitatibus possimus deleniti dignissimos, corrupti, dicta quibusdam 
                        eos voluptatibus nisi quasi reiciegbgfbndis sed modi magnam!
                    </p>
                </div>
            </div>
        </div>
    </footer>
    
      <all>
          <script src="Libraries/jquery.js"></script>
          <script src="Libraries/assets/js/bootstrap.5.0.0.alpha-2-min.js"></script>
          <script src="Libraries/popper.min.js"></script>
          <script src="Libraries/bootstrap5.bundle.min.js"></script>
          <script src="assets/js/main.js"></script>
          <script src="Libraries/fontawesome/js/all.js"></script>

          <script src="Libraries/assets/js/tiny-slider.js"></script>
          <script src="Libraries/assets/js/count-up.min.js"></script>
          <script src="Libraries/assets/js/imagesloaded.min.js"></script>
          <script src="Libraries/assets/js/isotope.min.js"></script>
          <script src="Libraries/assets/js/glightbox.min.js"></script>
          <script src="Libraries/assets/js/wow.min.js"></script>
          <script src="Libraries/assets/js/main.js"></script>

      </all>
</body>
</html>
<?php }?>