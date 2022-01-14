<?php
session_start();
require("include/db.php"); ?>
<?php include("include/functions.php"); ?>

<?php
if (isset($_SESSION["adminuser"])) {


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Libraries/assets/css/bootstrap-5.0.0-alpha-2.min.css">
        <link rel="stylesheet" href="Libraries/bootstrap5.min.css">
        <link rel="stylesheet" href="Libraries/bootstrap/css/bootstrap.min.css">

        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="Libraries/fontawesome/css/all.css">

        <link rel="stylesheet" href="Libraries/assets/css/LineIcons.2.0.css">
        <link rel="stylesheet" href="Libraries/assets/css/tiny-slider.css">
        <link rel="stylesheet" href="Libraries/assets/css/glightbox.min.css">
        <link rel="stylesheet" href="Libraries/assets/css/animate.css">
        <link rel="stylesheet" href="Libraries/assets/css/lindy-uikit.css?">

        <title>Dashboard</title>

        <style>
            .adminusername {
                text-transform: capitalize;
            }

            .section h1 {
                font-weight: 700;
            }

            #section a {
                color: white;
            }

            #section a:hover {
                color: white;
                /* font-size:500px!important; */
            }

            .scrollhead {
                background-color: #333;
                overflow: auto;
                white-space: nowrap;
            }

            .scroll {
                /* display: inline-block; */
                /* color: white;
    text-align: center;
    padding: 14px;
    text-decoration: none; */
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
        include("include/header.php");
        ?>
        <!-- navbar end -->
        <!-- header start -->
        <header class="bg-dark py-3 my-5" style="color: white;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class=""><i class="fas fa-cog" style="color:#27aae1"></i> Dashboard</h3>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-6 mb-2 ">
                            <a href="categories.php" class="btn btn-info btn-block">
                                <i class="fas fa-folder-plus"></i> Add New Category
                            </a>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <a href="comments.php" class="btn btn-success btn-block">
                                <i class="fas fa-check"></i> Manage Comments
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header end -->

        <!-- Main Area -->
        <section id="section" class="container-fluid py-2 mb-4 section" style="min-height: 300px;">
            <div class="row">
                <!-- Left Side Area Start -->
                <div class="col-lg-2 d-none d-md-block">

                    <div class="card text-center bg-dark text-white mb-3">
                        <a href="post.php">
                            <div class="card-body">
                                <h1 class="lead">Posts</h1>
                                <h4 class="display-5">
                                    <i class="fab fa-readme"></i>
                                    <?php
                                    postcount();

                                    ?>
                                </h4>
                            </div>
                        </a>
                    </div>

                    <div class="card text-center bg-dark text-white mb-3">
                        <a href="categories.php">
                            <div class="card-body">
                                <h1 class="lead">Categories</h1>
                                <h4 class="display-5">
                                    <i class="fas fa-folder"></i>
                                    <?php
                                    categorycount();

                                    ?>
                                </h4>
                            </div>
                        </a>
                    </div>

                    <div class="card text-center bg-dark text-white mb-3">
                        <div class="card-body">
                            <h1 class="lead">Admins</h1>
                            <h4 class="display-5">
                                <i class="fas fa-users"></i>
                                <?php
                                admincount();

                                ?>
                            </h4>
                        </div>
                    </div>
                    <div class="card text-center bg-dark text-white mb-3">
                        <a href="comments.php">
                            <div class="card-body">
                                <h1 class="lead">Comments</h1>
                                <h4 class="display-5">
                                    <i class="fas fa-comments"></i>
                                    <?php
                                    commentscount();

                                    ?>
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div class="card text-center bg-dark text-white mb-3">
                        <div class="card-body">
                            <h1 class="lead">Users</h1>
                            <h4 class="display-5">
                                <i class="fas fa-user"></i>
                                <?php
                                userscount();

                                ?>
                            </h4>
                        </div>
                    </div>
                </div>
                <!-- Left Side Area End -->


                <!-- Right Side Area Start -->
                <div class="col-lg-10">
                    <h1>Top Posts</h1>
                    <div class="scrollhead">

                        <table class="table table-striped table-hover scroll">

                            <thead class="thead-dark">
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Date&Time</th>
                                    <th>Author</th>
                                    <th>Comments</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <?php
                            $SrNo = 0;
                            global $connection;
                            $sql = "SELECT *FROM post order by id desc limit 0,5";
                            $query = mysqli_query($connection, $sql);
                            while ($rows = mysqli_fetch_assoc($query)) {
                                $postid = $rows['id'];
                                $datetime = $rows['datetime'];
                                $author = $rows['author'];
                                $title = $rows['title'];
                                $SrNo++;
                                // $postid = $rows['category'];
                                // $postid = $rows['image'];
                                // $postid = $rows['postcontent'];


                            ?>
                                <tbody class="bg-light">
                                    <tr>
                                        <td><?php echo $SrNo; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $datetime; ?></td>
                                        <td><?php echo $author; ?></td>
                                        <td>
                                            <a href="./comments.php">
                                                <?php
                                                approved($postid);


                                                disapproved($postid);
                                                ?>
                                            </a>
                                        </td>
                                        <td><a target="_blank" href="fullpost.php?id=<?php echo $postid; ?>"><span class="btn btn-info">Preview</span></a></td>

                                    </tr>
                                </tbody>
                            <?php
                            }

                            ?>
                        </table>

                    </div>

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
    </body>

    </html>

<?php
} else {
    header("Location: admin.php");
    exit();
}

?>