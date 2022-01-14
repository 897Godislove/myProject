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

    <title>Comments</title>
    <style>
    .scrollhead{
	    background-color: #333;
	    overflow: auto;
	    white-space: nowrap;
        margin-left:-20px;
        margin-right:-20px;
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
    <header class="bg-dark py-3 my-3" style="color: white;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><i class="fas fa-comments"></i>Manage Comments</h1>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-6 mb-2">
                        <a href="dashboard.php" class="btn btn-warning btn-block">
                            <i class="fas fa-check"></i> Dashboard
                        </a>
                    </div>
                    <div class="col-lg-6 mb-2 ">
                        <a href="categories.php" class="btn btn-info btn-block">
                            <i class="fas fa-folder-plus"></i> Add New Category
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </header>
    <!-- header end -->
    
    <!-- Main Area -->
    <section class="container py-2 mb-4">
        <div class="row" style="min-height: 30px;">
            <div class="col-lg-12" style="min-height: 400px;">


            <!-- THIS IS TO APPROVE COMMENTS -->

            <h2>Un-Approved Comments</h2>
               <div class="scrollhead">

                <table class="table table-striped table-hover mt-4">
                    <thead class="thead-dark">
                        <tr>
                            <th>No. </th>
                            <th>Date&Time</th>
                            <th>Name</th>
                            <th style="width: 400px;">Comment</th>
                            <th>Approve</th>
                            <th>Action</th>
                            <th>Details</th>
                        </tr>
                    </thead>

                <?php 
                    global $connection;
                    $sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
                    $query = mysqli_query($connection, $sql);
                    if (!$query) {
                        die("Error in Query <br>".mysqli_error($connection));
                    }
                    $SrNo = 0;
                    while ($rows=mysqli_fetch_assoc($query)) {
                        $commentid = $rows['id'];
                        $datetimeofcomment = $rows['datetime'];
                        $nameofcommenter =$rows['name'];
                        $commentcontent = $rows['comments'];
                        $commentpostID = $rows['post_id'];
                        $SrNo++; 
                        // if (strlen($nameofcommenter)>10) {
                        //     $nameofcommenter = substr($nameofcommenter,0,10).'..';
                        // }   
                        // if (strlen($datetimeofcomment)>10) {
                        //     $datetimeofcomment = substr($datetimeofcomment,0,16).'..';
                        // }

                ?>

                    <tbody>
                        <tr>
                            <td><?php echo htmlentities($SrNo); ?></td>
                            <td><?php echo htmlentities($datetimeofcomment) ; ?></td>
                            <td><?php echo htmlentities($nameofcommenter) ; ?></td>
                            <td><?php echo htmlentities($commentcontent) ; ?></td>
                            <td><a class="btn btn-success" href="comments/approvecomment.php?id=<?php echo $commentid; ?>">Approve</a></td>
                            <td><a class="btn btn-danger" href="comments/deletecomment.php?id=<?php echo $commentid; ?>">Delete</a></td>
                            <td><a class="btn btn-primary" href="fullpost.php?id=<?php echo $commentpostID; ?>" target="_blank" >Live Proview</a></td>
                        </tr>
                    </tbody>
                    <?php 
                    }
                
                    ?>
                </table>
              </div>



                    <!-- THIS IS TO DIS-APPROVE COMMENTS -->


                <h2 class="mt-5">Approved Comments</h2>
              <div class="scrollhead">
             
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No. </th>
                            <th>Date&Time</th>
                            <th>Name</th>
                            <th style="width: 400px;">Comment</th>
                            <th>Revert</th>
                            <th>Details</th>
                        </tr>
                    </thead>

                <?php 
                    global $connection;
                    $sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
                    $query = mysqli_query($connection, $sql);
                    if (!$query) {
                        die("Error in Query <br>".mysqli_error($connection));
                    }
                    $SrNo = 0;
                    while ($rows=mysqli_fetch_assoc($query)) {
                        $commentid = $rows['id'];
                        $datetimeofcomment = $rows['datetime'];
                        $nameofcommenter =$rows['name'];
                        $commentcontent = $rows['comments'];
                        $commentpostID = $rows['post_id'];
                        $SrNo++; 
                        // if (strlen($nameofcommenter)>10) {
                        //     $nameofcommenter = substr($nameofcommenter,0,10).'..';
                        // }   
                        // if (strlen($datetimeofcomment)>10) {
                        //     $datetimeofcomment = substr($datetimeofcomment,0,16).'..';
                        // }

                ?>

                    <tbody>
                        <tr>
                            <td><?php echo htmlentities($SrNo); ?></td>
                            <td><?php echo htmlentities($datetimeofcomment) ; ?></td>
                            <td><?php echo htmlentities($nameofcommenter) ; ?></td>
                            <td><?php echo htmlentities($commentcontent) ; ?></td>
                            <td style="min-width: 140px;"><a class="btn btn-warning text-dark" href="comments/disapprovecomments.php?id=<?php echo $commentid; ?>">Dis-Approve</a></td>
                            <!-- <td><a class="btn btn-warning text-dark" href="comments/disapprovecomments.php?id=<?php echo $commentid; ?>">Dis-Approve</a></td> -->
                            <!-- <td><a class="btn btn-danger" href="comments/deletecomment.php?id=<?php echo $commentid; ?>">Delete</a></td> -->
                            <td><a class="btn btn-primary" href="fullpost.php?id=<?php echo $commentpostID; ?>" target="_blank" >Live Proview</a></td>
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
    }

?>