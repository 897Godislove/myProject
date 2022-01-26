<?php require("include/db.php"); ?>
<?php include("include/functions.php"); ?>
<?php require("include/sessions.php"); ?>
<?php
print_r($_SESSION)
?>
<?php

if (!isset($_SESSION['email'])) {
    header("location: ../signup.login.html");
} else if (!empty($existingheadline)) {
    header("location: blog.php");
} else {

?>
    <?php
    // FETCHING THE EXISTING USER START
    global $connection;
    $userid = $_SESSION['id'];
    $sql = "SELECT * FROM `signup` where id='$userid'";
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        die("Error in connection " . mysqli_error($connection));
    }
    while ($datarows = mysqli_fetch_assoc($result)) {
        $userid = $datarows['id'];
        $existingname = $datarows['name'];
        $existingheadline = $datarows['headline'];
        $nickname = $datarows['nickname'];
        $existingbio = $datarows['bio'];
        $existingimage = $datarows['image'];
    }
    // FETCHING THE EXISTING USER END

    if (isset($_POST['submit'])) {
        global $connection;
        $name = $_POST['name'];
        $name = mysqli_real_escape_string($connection, $name);
        $nickname = $_POST['nickname'];
        $nickname = mysqli_real_escape_string($connection, $nickname);
        $headline = $_POST['headline'];
        $headline = mysqli_real_escape_string($connection, $headline);
        $bio = $_POST['bio'];
        $bio = mysqli_real_escape_string($connection, $bio);
        $image = $_FILES['image'];
        $imagename = $image['name'];
        // $imagename = "profile picture/".basename($_FILES['image']['name']);

        $imagename = rand(100, 1000) . "." . $imagename;
        $tmp_name = $image['tmp_name'];
        // print_r($image);
        // echo $imagename;



        // TIME AND DATE FUNCTION 
        date_default_timezone_set("africa/lagos");
        $currenttime = time();
        // $datetime =strftime("%b-%d-%Y %H:%M:%S", $currenttime);
        $datetime = strftime("%B-%d-%Y %H:%M", $currenttime);

        $create_datetime = date("Y-m-d H:i:s");

        // Updating my database

        $query = "UPDATE signup SET bio = '$bio',headline='$headline',nickname='$nickname',name='$name' WHERE id = $userid";

        // $_SESSION['errormessage'] = 'Successful';

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Error in Query<br>" . mysqli_error($connection));
        } else {
            header("location:myprofile.php");
        }
        // Updating my database

        // MOVE IMAGE FILE
        moveprofileimage($tmp_name, $imagename);
        $_SESSION['name'] = $name;
        $_SESSION['nickname'] = $nickname;
        $_SESSION['headline'] = $headline;
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
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="Libraries/fontawesome/css/all.css">
        <link rel="stylesheet" href="Libraries/bootstrap/css/bootstrap.min.css">

        <link rel="stylesheet" href="Libraries/assets/css/LineIcons.2.0.css">
        <link rel="stylesheet" href="Libraries/assets/css/tiny-slider.css">
        <link rel="stylesheet" href="Libraries/assets/css/glightbox.min.css">
        <link rel="stylesheet" href="Libraries/assets/css/animate.css">
        <link rel="stylesheet" href="Libraries/assets/css/lindy-uikit.css?">

        <title>My Profile</title>
        <style>
            .catname {
                /* visibility: hidden; */
                display: none;
            }
        </style>
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
        $page = 'profile';
        include("include/header.php");
        ?>
        <!-- navbar end -->

        <!-- header start -->
        <header class="bg-dark py-3 my-5" style="color: white;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1><i class="fas fa-user mr-2" style="color:#27aae1"></i> My Profile</h1>
                    </div>
                </div>
            </div>
        </header>
        <!-- header end -->

        <!-- Main Area -->
        <section class="container py-2 mb-4" style="min-height: 400px;">
            <div class="row">
                <!-- Left side -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-dark text-light">
                            <h3><?php echo $existingname; ?></h3>
                        </div>
                        <div class="card-body">
                            <img class="block img-thumbnail img-fluid mb-3" src="profile pictures/<?php echo $existingimage; ?>" alt="">
                            <div class="card-footer">
                                <?php echo $existingbio; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right side -->
                <div class="col-md-9">

                    <form action="myprofile.php" method="post" enctype="multipart/form-data">
                        <?php echo error(); ?>
                        <div class="card bg-dark text-light">
                            <div class="card-header bg-secondary text-light">
                                <?php
                                if (!empty($existingheadline)) {

                                ?>
                                    <h4 class="text-center">Edit Profile</h4>
                                <?php
                                } else {
                                ?>
                                    <h4 class="text-center">Complete Profile</h4>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <input maxlength=10 type="text" class="form-control mt-4" id="titlenickname" name="nickname" placeholder="Add a nickname" value="<?php echo $nickname ?>" required>
                                    <span class="text-danger ml-3">It is the nickname that will appear as your display name</span>
                                    <span class="text-danger">Not more than 10 characters</span>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" id="titlename" name="name" placeholder="Enter Full Name Here" value="<?php echo $existingname ?>" required>
                                    <!-- <small class="text-muted">Add a professional headline like 'Engineer at XYZ'</small>
                                <span class="text-danger">Not more than 12 characters</span> -->
                                </div>
                                <div class="form-group mt-4 mb-3">
                                    <input type="text" class="form-control" id="titleheadline" name="headline" placeholder="Headline" value="<?php echo $existingheadline ?>" required>
                                </div>
                                <div class="form-group mt-4">
                                    <textarea id="post" placeholder="Bio" class="form-control" name="bio" type="text" rows="8" cols="60"></textarea>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="imageselect"><span class="fieldinfo">Select New Profile Picture <br></label></span>
                                    <input type="file" accept="image/*" class="form-control" name="image" id="imageselect">
                                </div>

                                <div class="row py-4">
                                    <div class="col-lg-6 my-3">
                                        <?php
                                        if (!empty($existingheadline)) {
                                        ?>
                                            <button type="submit" name="submit" class="btn btn-block btn-primary">
                                                <i class="fas fa-check"></i> Update
                                            </button>
                                        <?php
                                        } else {
                                        ?>
                                            <button type="submit" name="submit" class="btn btn-block btn-primary">
                                                <i class="fas fa-check"></i> Complete
                                            </button>
                                        <?php
                                        }
                                        $useremail = $_SESSION['email'];
                                        $_SESSION['existingheadline'] = $existingheadline;
                                        ?>
                                    </div>
                                    <div class="col-lg-6 my-3">
                                        <a href="myposts.php?email=<?php echo $useremail; ?>" class="btn btn-warning btn-block">My Blogs</a>
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
            <script>
                $(function() {
                    $("#category_select").change(function() {
                        var option = $('option:selected', this).attr('category_option');
                        // catname=$('#category_input').val(option);
                        $('#category_input').val(option);
                        // catnameValue =catname.val() 
                        // console.log(catnameValue)
                    });
                });
            </script>

        </all>
    </body>

    </html>
<?php
}
?>