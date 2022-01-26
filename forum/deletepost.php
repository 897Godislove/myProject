<?php require("include/db.php"); ?>
<?php include("include/functions.php"); ?>
<?php session_start();
if (!isset($_SESSION['email'])) {
    header("location: ../signup.login.html");
} else {
?>
    <?php

    $serchqueryparameter = $_GET['id'];
    global $connection;

    $query = "SELECT * FROM post WHERE id='$serchqueryparameter'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("Error in Query" . mysqli_error($connection));
    }
    while ($rows = mysqli_fetch_assoc($result)) {
        $authortobeupdated = $rows['author'];
        $idtobeupdated = $rows['id'];
        $titletobeupdated = $rows['title'];
        $categorytobeupdated = $rows['category'];
        $imagetobeupdated = $rows['image'];
        $posttobeupdated = $rows['postcontent'];
    }

    // echo $imagetobeupdated;

    if (isset($_POST['submit'])) {
        global $connection;
        $query = "DELETE FROM post WHERE id='$serchqueryparameter'";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Error in Query<br>" . mysqli_error($connection));
        } else {
            $targetpathtodeleteimage = "uploaded images/$imagetobeupdated";
            unlink($targetpathtodeleteimage);
            header('location: myposts.php?email='.$_SESSION['email']);
            

        }
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

        <title>Delete Post</title>
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

        <div class="header header-4">
            <div class="navbar-area">
                <div class="container-fluid px-4">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg">
                                <a class="navbar-brand" href="index.php">
                                    <?php
                                    if (isset($_SESSION['nickname'])) {
                                    ?>
                                        <p class="lead h4">Hello @<span style="text-transform: lowercase;"><?php echo $_SESSION['nickname']; ?></span></p>
                                        <small><?php echo $_SESSION['existingheadline']; ?></small>
                                    <?php
                                        // print_r($existingID);
                                    } else {
                                    ?>
                                        <p class="lead h4">Hello <?php echo $_SESSION['name']; ?></p>
                                        <p class="text-muted"> Please complete your registration</p>
                                    <?php
                                    }
                                    ?>
                                </a>
                                <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent4" aria-controls="navbarSupportedContent4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="toggler-icon"></span>
                    <span class="toggler-icon"></span>
                    <span class="toggler-icon"></span>
                </button> -->

                                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent4">
                                    <ul id="nav4" class="navbar-nav ml-auto text-sm-center">
                                        <li class="nav-item">
                                            <a class="page-scroll" href="myprofile.php"><i class="fas fa-user text-success"></i> My Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll" href="addnewpost.php"><i class="fas fa-plus-square text-primary"></i> Create Blog</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll" href="myposts.php?email=<?php echo $_SESSION['email']; ?>"><i class="fas fa-plus-square text-primary"></i> My Blogs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll" href="blog.php?page=1"><i class="fas fa-blog"></i> Live Blogs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll" href="admin.php"><i class="fas fa-edit text-success"></i> Admin</a>
                                        </li>
                                        <li class="nav-item logout">
                                            <a class="page-scroll logout" href="../include/logout.inc.php"><i class="fas fa-user-times "></i> Logout</a>
                                        </li>
                                    </ul>
                                </div>

                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- navbar end -->
        <!-- header start -->
        <header class="bg-dark py-3 my-5" style="color: white;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1><i class="fas fa-edit" style="color:#27aae1"></i>Delete Post</h1>
                    </div>
                </div>
            </div>
        </header>
        <!-- header end -->

        <!-- Main Area -->
        <section class="container py-2 mb-4" style="min-height: 400px;">
            <div class="row">
                <div class="offset-lg-1 col-lg-10">
                    <?php


                    ?>
                    <form action="deletepost.php?id=<?php echo $serchqueryparameter; ?>" method="post" enctype="multipart/form-data">
                        <div class="card bg-secondary text-light mb-3">
                            <div class="card-body bg-dark">
                                <div class="form-group">
                                    <label for="author"><span class="fieldinfo">Author</label></span>
                                    <input disabled value="<?php echo $authortobeupdated; ?>" type="text" class="form-control" id="title" name="author" placeholder="Type Author Here">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="title"><span class="fieldinfo">Post Title</label></span>
                                    <input disabled value="<?php echo $titletobeupdated; ?>" type="text" class="form-control" id="posttitle" name="title" placeholder="Type Title Here">
                                </div>

                                <div class="form-group mb-3">
                                    <input type='text' name='category' class="catname" id="category_input" value="" />
                                    <br>
                                    <label for="previousCatName" class="fieldinfo">Category</label>
                                    <input disabled type='text' name='previousCatName' class="form-control" id="" value="<?php echo $categorytobeupdated; ?>" />
                                </div>

                                <div class="form-group mt-4">
                                    <div class="text-center fieldinfo">Image: </div>
                                    <br>
                                    <div class="w-100 d-flex flex-row justify-content-center">
                                        <img class="form-file" src="uploaded images/<?php echo $imagetobeupdated ?>" width="170px;" height="70px;" alt=""><br>
                                    </div>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="post"><span class="fieldinfo">Post:</label></span>
                                    <textarea disabled id="post" class="form-control" name="post_description" type="text"><?php echo $posttobeupdated; ?></textarea>
                                </div>
                                <div class="row py-4">
                                    <div class="col-lg-6 my-3">
                                        <a href="myposts.php?email=<?php echo $_SESSION['email']?>" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>Back</a>
                                    </div>
                                    <div class="col-lg-6 my-3">
                                        <button type="submit" name="submit" class="btn btn-block btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
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