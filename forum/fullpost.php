<?php require ("include/db.php"); ?>
<?php include ("include/functions.php"); ?>
<?php 
        session_start();
        if (!isset($_SESSION['email']) && !isset($_SESSION['adminuser'])) {
            header("location: ../signup.login.html");
        }else {
?>
<?php $searchqueryparameter =$_GET['id']; ?>
<?php 

    if (isset($_POST['commentsubmit'])) {
        $name=$_SESSION['name'];
        $name=mysqli_real_escape_string($connection, $name);
        $email=$_SESSION['email'];
        $email=mysqli_real_escape_string($connection, $email);
        $comments = $_POST['commenterthoughts'];
        $comments = mysqli_real_escape_string($connection, $comments);
            // Date and Time Function
        date_default_timezone_set("africa/lagos");
        $currenttime=time();
        $datetime =strftime("%d-%B-%Y %H:%M", $currenttime);

        $query = "INSERT INTO comments(datetime, name, email, comments, approvedby, status, post_id) VALUES('$datetime', '$name', '$email', '$comments', 'Pending', 'OFF', '$searchqueryparameter')";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Error in Query<br>".mysqli_error($connection));
        } else {
            // $_SESSION['success'] = "Category Added Successfully";
            redirect_to("fullpost.php?id={$searchqueryparameter}" );
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="Libraries/assets/css/bootstrap-5.0.0-alpha-2.min.css" />
    <link rel="stylesheet" href="Libraries/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="Libraries/bootstrap5.min.css">
    <link rel="stylesheet" href="Libraries/fontawesome/css/all.css">

    <link rel="stylesheet" href="Libraries/assets/css/LineIcons.2.0.css">
    <link rel="stylesheet" href="Libraries/assets/css/tiny-slider.css">
    <link rel="stylesheet" href="Libraries/assets/css/glightbox.min.css">
    <link rel="stylesheet" href="Libraries/assets/css/animate.css">
    <link rel="stylesheet" href="Libraries/assets/css/lindy-uikit.css?">

    <title>Full Post Page</title>
    <style>
        .commentblock{
            background-color: #f6f7f9;
            /* background-color: blue; */
            border-radius: 20px;
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
                        <!-- <img src="Libraries/assets/img/logo/logo.svg" alt="Logo" /> -->
                        <p class="lead h4">Hello <?php echo $_SESSION['name']; ?></p>
                    </a>
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
                            <a class="page-scroll" href="addnewpost.php"><i class="fas fa-plus-square text-primary"></i> Create Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="page-scroll" href="myposts.php?email=<?php echo $_SESSION['email'];?>"><i class="fas fa-plus-square text-primary"></i> My Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="page-scroll" href="blog.php"><i class="fas fa-blog"></i> Live Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="page-scroll" href="admin.php"><i class="fas fa-edit text-success"></i> Admin</a>
                        </li>
                        <li class="nav-item logout">
                            <a class="page-scroll logout" href="logoutforliveblog.php"><i class="fas fa-user-times "></i> Logout</a>
                        </li>
                            <form class="form-inline d-none d-sm-block" method="post">
                                <div class="form-group"  >
                                    <input type="text" name="search"class="form-control" placeholder="Search Here">
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
                <h1 class="lead">The Complete Blog using PHP by Mufasa-NGN</h1>
                <?php 
                    global $connection;
                    if (isset($_POST['searchbtn'])) {
                        $search = $_POST['search'];
                        $result = mysqli_query($connection, "SELECT * FROM post WHERE datetime LIKE '%$search%' or title LIKE '%$search%' or category LIKE '%$search%' or author LIKE '%$search%' or postcontent LIKE '%$search%'");
                        // $result = mysqli_query($connection, "SELECT * FROM post WHERE title LIKE '%$search%'");
                        if (!$result) {
                            // die("Error in query".mysqli_errno( ));
                        }
                        $count = mysqli_num_rows($result);
                        if ($count == 0) {
                            echo '<h1>NO RESULT</h1>';
                        }    
                    } else{
                        $idFromURL = $_GET['id'];
                        $query = "SELECT * FROM post WHERE id='$idFromURL'";
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
                        $author = $rows['author'];
                        $author = htmlentities($author);
                        $image = $rows['image'];
                        $image = htmlentities($image);
                        $post = $rows['postcontent'];
                        $post = htmlentities($post);
                        $postemail = $rows['email'];
                        // echo $post;
                    ?>
                    <div class="card">
                        <img src="uploaded images/<?php echo $image?>" class="image-fluid card-img-top" alt="#image">
                        <div class="card-body">
                            <h4 class="card-title text-centerr"><?php echo $title; ?></h4>
                            <small>Written by <span style="font-size: 20px; text-transform: capitalize; font-weight: 700;"><a href="profile.php?email=<?php echo htmlentities($postemail); ?>"><?php echo $author; ?></a></span> On <?php echo $datetime;?></small>
                            <hr>
                            <p class="card-text"><?php  echo $post?></p>

                        </div>
                    </div>
                    <br>
                    <br>
                    <?php
                    } 
                ?>
                <!-- Comment Part Start -->
                <!-- Fetching Existing Comments START -->
                <p class="fieldinfo text-center mb-4" style="font-weight: 700;">Comments</p>

                    <?php 
                        $query = "SELECT * FROM comments WHERE post_id='$searchqueryparameter' AND status = 'ON'";
                        $result = mysqli_query($connection, $query);
                        while ($rows = mysqli_fetch_assoc($result)) {
                            $commentdate = $rows['datetime'];
                            $commentname = $rows['name'];
                            $commentcontent = $rows['comments'];
                        ?>
                        <div class="ml-4">
                            <div class="media commentblock ">
                                <img src="assets/images/default.jpg" class="d-block img-fluid align-self-start" width="100px" height="80px" alt="">
                                <div class="media-body mt-2 mx-2">
                                    <h6 class="lead"><?php echo $commentname; ?></h6>
                                    <p class="small text-info"><?php echo $commentdate; ?></p>
                                    <!-- <br> -->
                                    <p class="mt-2 small"><?php echo $commentcontent; ?></p>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <?php } ?>        
                <!-- Fetching Existing Comments END -->

                    <div class="">
                        <form class="" action="fullpost.php?id=<?php echo $searchqueryparameter;?>" method="post">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="fieldinfo" style="color: darkslategrey;">Share your thoughts about this post</h5>
                                </div>
                                <div class="card-body">
                                    <!-- <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input id="" class="form-control" type="text" name="commentername" placeholder="Name" value="<?php echo $_SESSION['name']; ?>" readonly>
                                        </div>                                        
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input id="" class="form-control" type="email" name="commenteremail" placeholder="Email" value="<?php echo $_SESSION['email']; ?>" readonly>
                                        </div>                                        
                                    </div> -->
                                    <div class="form-group">
                                        <textarea name="commenterthoughts" id="" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group d-flex justify-content-center">
                                        <button type="submit" name="commentsubmit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <!-- Comment Part End -->

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
                            vero praesentium culpa.
                        </div>
                    </div>
                </div>
                <br>

                <div>
                    <?php 

                        // print_r($row);
                        if ($_SESSION['email']==$postemail) {
                            ?>
                            <div class="card text-center">
                                <div class="card-header bg-dark text-light" >
                                    <h2 class="text-center lead">Edit Your Post</h2>
                                </div>
                                <div class="card-body">
                                    <a href="editpost.php?id=<?php echo $id; ?>"><span class="btn btn-warning btn-block btn-lg">Edit</span></a>
                                </div>
                            </div>
                    <?php
                        } else {
                    ?>
                        <!-- <a href="editpost.php?id=<?php echo $id; ?>"><span class="btn btn-warning">Edit</span></a> -->
                    <?php    
                        }
                    ?>

                </div>

                <div class="card">
                    <div class="card-header bg-dark text-light" >
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
                        <a href="blog.php?category=<?php echo$categorytitle; ?>"><span class="heading"><?php echo $categorytitle;?></span></a><br>


                            <?php }?>
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
                            while ($rows=mysqli_fetch_assoc($result)) {
                                $id = $rows['id'];
                                $title = $rows['title'];
                                $datetime = $rows['datetime'];
                                $image = $rows['image']; ?>
                            <a id="linkman" href="fullpost.php?id=<?php echo $id;?>" target="_blank">
                                <div class="media">
                                    <img width="90" height="94" src="uploaded images/<?php echo $image?>" alt="" class="d-block img-fluid align-self-start">
                                    <div class="media-body ml-2">
                                        <h6 class="lead"><?php echo $title;?></h6>
                                        <p class="small"><?php echo $datetime;?></p>
                                    </div>
                                </div>
                            </a>
                            <hr>
                        <?php }?>
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