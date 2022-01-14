<?php require ("include/db.php"); ?>
<?php include ("include/functions.php"); ?>
<?php 
        session_start();
        if (!isset($_SESSION['adminuser'])) {
            header("location: admin.php");
        }else {

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

    <title>Post</title>

    <style>
        .adminusername{
            text-transform: capitalize;
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
    <header class="bg-dark py-3 my-5 text-center" style="color: white;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class=""><i class="fas fa-cog" style="color:#27aae1"></i>Manage Post</h3>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-4 mb-4 ">
                        <a href="dashboard.php" class="btn btn-warning btn-block">
                            <!-- <i class="fas fa-"></i> Dashboard -->
                            <i class=""></i> Dashboard
                        </a>
                    </div>
                    <div class="col-lg-4 mb-4 ">
                        <a href="categories.php" class="btn btn-info btn-block">
                            <i class="fas fa-folder-plus"></i> Add New Category
                        </a>
                    </div>
                    <div class="col-lg-4 mb-2">
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
    <section class="container-fluid py-2 mb-4">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th class="table-primary">#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <!-- <th>Date&Time</th> -->
                            <th>Author</th>
                            <th>Banner</th>
                            <th>Comments</th>
                            <th>Action</th>
                            <th>Live Preview</th>
                        </tr>
                    </thead>

                    <?php 
                        global $connection;
                        $query = "SELECT * FROM post ORDER BY id desc";
                        $result=mysqli_query($connection, $query);
                        if (!$result) {
                            die("Error in Query <br>".mysqli_error($connection));
                        }
                        $sr = 0;
                        while ($rows=mysqli_fetch_assoc($result)) {
                            $id = $rows['id'];
                            $datetime = $rows['datetime'];
                            $posttitle = $rows['title'];
                            $category =$rows['category'];
                            $author = $rows['author'];
                            $image = $rows['image'];
                            $postcontent = $rows['postcontent'];
                            $sr++; 
                    ?>
                    <tbody>
                        <tr>
                            <td class="table-primary"><?php echo $sr;?></td>
                            <td> <?php if (strlen($posttitle)>20) {
                                $posttitle = substr($posttitle, 0, 15)."...";
                                        }
                                echo $posttitle;?>
                            </td>
                            <td><?php
                                if (strlen($category)>8) {
                                    $category = substr($category, 0, 8)."...";
                                }
                                echo $category;?></td>
                            <!-- <td><?php
                                // if (strlen($datetime)>11) {
                                //     $datetime = substr($datetime, 0, 11)."...";
                                // }
                                // echo $datetime;?></td> -->
                            <td><?php
                                if (strlen($author)>9) {
                                $author = substr($author, 0, 9)."..";
                                } 
                                echo $author;?>
                            </td>
                            <td><img src="uploaded images/<?php echo $image;?>" alt="Error in display" width="170px" height="80px"></td>
                            <td>
                                        <?php 
                                        approved($id);
                                   
                                   
                                        disapproved($id);
                                        ?> 
                                </td>
                            <td>
                                <a href="deletepost.php?id=<?php echo $id; ?>"><span class="btn btn-danger mt-sm-2">Delete</span></a>
                            </td>
                            <td>
                                <a href="fullpost.php?id=<?php echo $id; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a>
                            </td>
                        </tr>
                    </tbody>
                    <?php 
                        }
                    ?>
                </table>
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
        }

?>
