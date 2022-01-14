<?php
session_start();
// if (!isset($_SESSION['email'])) {
//     header("location: ../signup.login.html");
// }else {


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Libraries/assets/css/bootstrap-5.0.0-alpha-2.min.css" />
    <link rel="stylesheet" href="Libraries/bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="Libraries/fontawesome/css/all.css">
    <link rel="stylesheet" href="Libraries/bootstrap/css/bootstrap.min.css">


    <link rel="stylesheet" href="Libraries/assets/css/LineIcons.2.0.css">
    <link rel="stylesheet" href="Libraries/assets/css/tiny-slider.css">
    <link rel="stylesheet" href="Libraries/assets/css/glightbox.min.css">
    <link rel="stylesheet" href="Libraries/assets/css/animate.css">
    <link rel="stylesheet" href="Libraries/assets/css/lindy-uikit.css?">

    <title>Admin Page</title>
</head>

<body>

    <!-- PRELOADER -->
    <!-- <div class="preloader">
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
    </div> -->
    <!-- navbar start-->
    <?php
    // include ("include/header.php");
    ?>
    <!-- header start -->
    <header class="bg-dark py-3 my-5" style="color: white;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><i class="fas fa-user" style="color:#27aae1;"></i>Manage Admins</h1>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->
    <!-- Main Area -->
    <section class="container py-2 mb-4 text-center" style="min-height: 400px;">
        <div class="row">
            <div class="offset-lg-1 col-lg-10">

                <form method="post" action="include/admin_backend.php" id="adminform">

                    <div id="pull" class="text-center h5"></div>

                    <div class="card bg-secondary text-light mb-3">
                        <div class="card-header">
                            <h1>Admin Login</h1>
                        </div>
                        <div class="card-body bg-dark">
                            <div class="form-group mb-3">
                                <label for="username"><span class="fieldinfo">Username</span></label>
                                <input type="text" class="form-control text-center username" id="username" name="username" placeholder="Enter Username Here">
                            </div>


                            <div class="form-group mb-3">
                                <label for="password"><span class="fieldinfo">Password</span></label>
                                <input type="password" class="form-control text-center" id="password" name="password" placeholder="Enter Password Here" required>
                            </div>
                            <div class="invalidpassword"></div>

                            <div class="row py-4">
                                <div class="col-lg-6 my-3">
                                    <button type="submit" id="marksubmit" name="submit" class="btn btn-block btn-primary">
                                        <i class="fas fa-check"></i> Login
                                    </button>
                                </div>
                                <div class="col-lg-6 my-3">
                                    <a href="blog.php?page=1" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>Back to Site</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>



    <!-- footer start -->
    <footer class="bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="lead text-center">Theme By | Mufasa | <span class="year"></span> &copy; ---- All Right Reserved</p>
                    <p class="text-center small">
                        sfvdfvLorem ipsum dolor sit amet consectetur adipisicing
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
    <script>
        $(document).ready(function() {
            $("#adminform").submit(function(e) {
                e.preventDefault();
                $("#pull").hide();
                var url = $(this).attr("action");
                var postdata = $(this).serialize();
                $.post(url, postdata,
                    (data, textStatus, jqXHR) => {
                        $("#pull").addClass("alert alert-success mb-3");
                        $("#pull").show();
                        // $("body").text(data);
                        console.log(data);
                        if (data == 1) {
                            $("#pull").text("Login Successful");
                            setTimeout(() => {
                                window.location.href = "dashboard.php";
                            }, 5000);
                        } else if (data == 0) {
                            $("#pull").text("Invalid");
                            setTimeout(() => {
                                window.location.href = "admin.php";
                            }, 3000);
                        }
                    },
                );
            });
        });
    </script>
</body>

</html>
<?php
// }

?>