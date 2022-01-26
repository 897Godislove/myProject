<?php session_start();
require("include/db.php"); ?>
<?php include("include/functions.php"); ?>
<?php 
    print_r($_SESSION); 
?>
<?php

if (!isset($_SESSION['existingheadline'])) {
    header("location: profile.php");
} else if (!isset($_SESSION['email'])) {
    header("location: ../signup.login.html");
} else {
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Libraries/assets/css/bootstrap-5.0.0-alpha-2.min.css" />
        <link rel="stylesheet" href="Libraries/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="Libraries/bootstrap5.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="Libraries/fontawesome/css/all.css">


        <link rel="stylesheet" href="Libraries/assets/css/LineIcons.2.0.css">
        <link rel="stylesheet" href="Libraries/assets/css/tiny-slider.css">
        <link rel="stylesheet" href="Libraries/assets/css/glightbox.min.css">
        <link rel="stylesheet" href="Libraries/assets/css/animate.css">
        <link rel="stylesheet" href="Libraries/assets/css/lindy-uikit.css?">

        <title>Blog</title>
        <style>
            .heading {
                font-family: Georgia, 'Times New Roman', Times, serif;
                font-weight: bold;
                color: #005e90;
            }

            .heading:hover {
                color: #0090DB;
            }

            #linkman {
                text-decoration: none;
            }

            #linkman:hover {
                text-decoration: none;
                font-size: 14px;
            }

            #profilelink {
                color: black !important;
                font-size: 19px;
            }

            #profilelink:hover {
                font-size: 23px;

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
                                <!-- <a class="navbar-brand" href="index.php"> -->
                                <!-- <img src="Libraries/assets/img/logo/logo.svg" alt="Logo" /> -->
                                <?php if (isset($_SESSION['nickname'])) { ?>
                                    <p class="text-primary h4">Hello @<?php echo $_SESSION['nickname']; ?> </p>
                                <?php } else { ?>
                                    <p class="lead h4">Hello User</p>
                                <?php } ?>

                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent4" aria-controls="navbarSupportedContent4" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent4">
                                    <ul id="nav4" class="navbar-nav mx-auto mx-5 text-center">
                                        <li class="nav-item">
                                            <a class="page-scroll" href="myprofile.php"><i class="fas fa-user text-success"></i> My Profile</a>
                                        </li>
                                        <!-- <li class="nav-item">
                            <a class="page-scroll" href="blog.php">Timeline</a>
                        </li> -->
                                        <li class="nav-item">
                                            <a class="page-scroll" href="addnewpost.php"><i class="fas fa-plus-square text-primary"></i> Add Post</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll" href="myposts.php?email=<?php echo $_SESSION['email']; ?>"><i class="fas fa-blog text-primary"></i> My Blogs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll active" href="blog.php?page=1"><i class="fas fa-blog"></i> Live Blogs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll" href="admin.php"><i class="fas fa-edit text-success"></i> Admin</a>
                                        </li>
                                        <li class="nav-item logout">
                                            <a class="page-scroll logout" href="logoutforliveblog.php"><i class="fas fa-user-times "></i> Logout</a>
                                        </li>
                                        <!-- THE SEARCH BAR -->
                                        <form class="form-inline d-none d-sm-block form-search" method="post">
                                            <div class="form-group">
                                                <input type="text" name="search" class="form-control" placeholder="Search Here">
                                                <button type="submit" name="searchbtn" class="btn btn-primary">Go</button>
                                            </div>
                                        </form>
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
        <div class="container">
            <div class="row mt-4">
                <!-- MAIN AREA STARTS -->
                <div class="col-sm-8">
                    <h3>The Complete Responsive CMS Blog</h3>
                    <h1 class="lead">The Complete Blog by Mufasa-NGN</h1>
                    <?php
                    // SEARCH BUTTON
                    global $connection;
                    if (isset($_POST['searchbtn'])) {
                        $search = $_POST['search'];
                        // $search = trim(strtolower($search));
                        $query = "SELECT * FROM post WHERE title LIKE '%$search%' or category like'%$search%'or author like'%$search%'";
                        $result = mysqli_query($connection, $query);
                        $count = mysqli_num_rows($result);
                        if ($count == 0) {
                            echo '<h1>NO RESULT</h1>';
                        }
                    } elseif (isset($_GET['page'])) { 
                        $page = $_GET['page'];
                        if ($page == 0 || $page < 1) {
                            $showpostfrom = 0;
                        } else {
                            $showpostfrom = ($page * 5) - 5;
                        }

                        $sqlpage = "SELECT * FROM post order by id desc LIMIT $showpostfrom,5";
                        $result = mysqli_query($connection, $sqlpage);
                    }
                    // QUERY WHEN CATEGORY IS ACTIVE IN THE URL TAB
                    else if (isset($_GET['category'])) {
                        $categorytitle = $_GET['category'];
                        $sql = "SELECT * from post where category='$categorytitle' order by id desc";
                        $result = mysqli_query($connection, $sql);
                        if (!$result) {
                            die("Error in query " . mysqli_error($connection));
                        }
                    } else {
                        $query = "SELECT * FROM `post` ORDER BY id desc limit 0,3";
                        $result = mysqli_query($connection, $query);
                    }

                    while ($rows = mysqli_fetch_assoc($result)) {
                        $id = $rows['id'];
                        $id = htmlentities($id);
                        $datetime = $rows['datetime'];
                        $title = $rows['title'];
                        $title = htmlentities($title);
                        $category = $rows['category'];
                        $category = htmlentities($category);
                        // $author = $rows['author'];
                        // $author = htmlentities($author);
                        $author=$_SESSION['name'];
                        $image = $rows['image'];
                        $image = htmlentities($image);
                        $post = $rows['postcontent'];
                        $post = htmlentities($post);
                        $email = $rows['email'];
                        $email = htmlentities($email);
                    ?>
                        <div class=" ">
                            <div class="card mt-5" style="position: relative;">
                                <div style=" float: left; font-size: 20px; margin-bottom: -40px; position: absolute; color: white;" class="text-white bg-danger"><?php echo $category; ?></div>
                                <a href="fullpost.php?id=<?php echo $id; ?>">
                                    <img src="uploaded images/<?php echo $image ?>" class="img-fluid card-img-top" alt="">
                                </a>
                                <div class="card-body">
                                    <h4 class="card-title text-centerr"><?php echo $title; ?></h4>
                                    <small class="text-muted">Written by <span id="profilelink" style=" text-transform: capitalize; font-weight: 700;"><a href="profile.php?email=<?php echo htmlentities($email); ?>"><?php echo $author; ?></a></span> On <?php echo $datetime; ?></small>
                                    <small class="text-muted">id by <?php echo $id; ?> On <?php echo $datetime; ?></small>
                                    <span style="float:right" class="badge badge-dark text-light">Comment
                                        <?php
                                        global $connection;
                                        $sqlcomments = "SELECT COUNT(*) FROM comments where post_id = '$id' and status='ON'";
                                        $querycomments = mysqli_query($connection, $sqlcomments);

                                        $totalrowss = mysqli_fetch_array($querycomments);
                                        $totalcomments = array_shift($totalrowss);
                                        if ($totalcomments > 0) {
                                        ?>
                                            <!-- <span class="badge badge-success"> -->
                                            <?php
                                            echo $totalcomments; ?>

                                            <!-- </span> -->
                                        <?php
                                        }
                                        ?>
                                    </span>
                                    <hr noshade="1">
                                    <p class="card-text"><?php if (strlen($post) > 150) {
                                                                $post = substr($post, 0, 150) . "...";
                                                            }
                                                            echo $post ?></p>
                                    <a class="readmore" href="fullpost.php?id=<?php echo $id; ?>" style="float:right"><span class="text-dark btn btn-info border-dark readmore">Read More >></span></a>

                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                    <?php } ?>
                    <!-- PAGINATION START-->
                    <div class="d-flex justify-content-center">
                        <nav aria-label="Page navigation ">
                            <ul class="pagination pagination-md">

                                <!-- CREATING BACKWARD BUTTON -->

                                <?php
                                if (isset($page)) {
                                    if ($page > 1) {
                                ?>
                                        <li class="page-item" aria-current="page">
                                            <a class="page-link" href="blog.php?page=<?php echo $page - 1; ?>"><i class="fas fa-arrow-left"></i></a>
                                        </li>
                                <?php }
                                } ?>
                                <?php
                                global $connection;
                                $sql = "SELECT COUNT(*) from post";
                                $query = mysqli_query($connection, $sql);
                                $rowpagination = mysqli_fetch_assoc($query);
                                $totalpaginationposts = array_shift($rowpagination);

                                $postpagination = $totalpaginationposts / 5;
                                $postpagination = ceil($postpagination);

                                for ($i = 1; $i <= $postpagination; $i++) {
                                    if (isset($page)) {
                                        if ($i == $page) { ?>
                                            <li class="page-item active" aria-current="page">
                                                <a class="page-link" href="blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                            </li>
                                        <?php } else { ?>
                                            <li class="page-item" aria-current="page">
                                                <a class="page-link" href="blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                            </li>
                                        <?php }  ?>
                                <?php }
                                } ?>
                                <!-- CREATING FORWORD BUTTON -->
                                <?php
                                if (isset($page) && !empty($page)) {
                                    if ($page + 1 <= $postpagination) { ?>
                                        <li class="page-item" aria-current="page">
                                            <a class="page-link" href="blog.php?page=<?php echo $page + 1; ?>"><i class="fas fa-arrow-right"></i></a>
                                        </li>
                                <?php }
                                } ?>
                            </ul>
                        </nav>
                    </div>


                    <!-- PAGINATION END-->
                </div>
                <!-- MAIN AREA ENDS -->



                <!-- SIDE AREA STARTS -->
                <div class="col-sm-4 ">
                    <div class="card mt-4">
                        <div class="card-body">
                            <!-- <img src="assets/images/oshio.jpg" class="d-block img-fluid mb-3" alt=""> -->
                            <img src="assets/images/Edo-University.jpg" class="d-block img-fluid mb-3" alt="">
                            <div class="text-center">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. At, ab odit. Doloribus illum consectetur,
                                vero praesentium culpa, reprehenderit officia sapiente perferendis omnis voluptate quisquam id tempora
                                officiis excepturi blanditiis sunt. Libero esse aliquam veniam facilis at, sequi, quos harum
                                quae vero, cupiditate aperiam. Rem sint optio dolores dolor odio cumque.
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header bg-dark text-light">
                            <h2 class="text-center lead">Join the Forum</h2>
                        </div>
                        <div class="card-body">
                            <a href=""><button type="button" class="btn btn-success btn-block text-center text-white" name="button">Join the Forum</button></a>

                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header bg-primary text-light">
                            <h2 class="lead">Categories</h2>
                        </div>
                        <div class="card-body">
                            <?php
                            global $connection;
                            $sql = "SELECT * from category order by id desc";
                            $query = mysqli_query($connection, $sql);
                            while ($datarows = mysqli_fetch_assoc($query)) {
                                $categoryid = $datarows['id'];
                                $categorytitle = $datarows['title']; ?>
                                <a href="blog.php?category=<?php echo $categorytitle; ?>"><span class="heading"><?php echo $categorytitle; ?></span></a><br>


                            <?php } ?>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="bg-info text-white card-header">
                            <h2 class="lead">Recent Posts</h2>
                        </div>
                        <div class="card-body">
                            <?php
                            global $connection;
                            $sql = "SELECT * from post order by id desc limit 0,5";
                            $result = mysqli_query($connection, $sql);
                            while ($rows = mysqli_fetch_assoc($result)) {
                                $id = $rows['id'];
                                $title = $rows['title'];
                                $datetime = $rows['datetime'];
                                $image = $rows['image']; ?>
                                <a id="linkman" href="fullpost.php?id=<?php echo $id; ?>" target="_blank">
                                    <div class="media">
                                        <img width="90" height="94" src="uploaded images/<?php echo $image ?>" alt="" class="d-block img-fluid align-self-start">
                                        <div class="media-body ml-2">
                                            <h6 class="lead"><?php echo $title; ?></h6>
                                            <p class="small"><?php echo $datetime; ?></p>
                                        </div>
                                    </div>
                                </a>
                                <hr>
                            <?php } ?>
                        </div>
                    </div>

                </div>
                <!-- SIDE AREA ENDS -->


            </div>
        </div>
        <!-- header end -->





        <!-- footer start -->
        <footer class="bg-dark text-white mt-5">
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
    </body>

    </html>
<?php
}

?>