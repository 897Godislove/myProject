<?php require ("include/db.php"); ?>
<?php include ("include/functions.php"); ?>

<?php 
    session_start();
    if (!isset($_SESSION['adminuser'])) {
        header("location: admin.php");
    }else {
        

    if (isset($_POST['submit'])) {
        $title=$_POST['title'];
        $title=mysqli_real_escape_string($connection, $title);
        // ADMIN VAR
        $admin="temitope";
        date_default_timezone_set("africa/lagos");
        $currenttime=time();
        $datetime =strftime("%B-%d-%Y %H:%M", $currenttime);

        $create_datetime = date("Y-m-d H:i:s");

        $query = "INSERT INTO category(title, time, create_datetime) VALUES('$title', '$datetime', '$datetime')";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Error in Query<br>".mysqli_error($connection));
        } else {
            // $_SESSION['success'] = "Category Added Successfully";
            redirect_to("categories.php");
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

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

    <title>Category</title>
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
                    <h1><i class="fas fa-edit" style="color:#27aae1"></i>Manage Categories</h1>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->
    
    <!-- Main Area -->
    <section class="container py-2 mb-4" style="min-height: 400px;">
        <div class="row">
            <div class="offset-lg-1 col-lg-10">
                <form action="categories.php" method="post">
                    <div class="card bg-secondary text-light mb-3">
                        <div class="card-header">
                            <h1>Add New Category</h1>
                        </div>
                        <div class="card-body bg-dark">
                            <div class="form-group mb-3">
                                <label for="title"><span class="fieldinfo">Category Title</label></span> 
                                <input type="text" class="form-control text-center" id="title" name="title" placeholder="Type Category Here" required>
                            </div>

                            <div class="row py-4" >
                                <div class="col-lg-6 my-3">
                                    <button type="submit" name="submit" class="btn btn-block btn-primary">
                                        <i class="fas fa-check"></i> Submit
                                    </button>
                                </div>
                                <div class="col-lg-6 my-3">
                                    <a href="dashboard.php" class="btn btn-warning text-light btn-block"><i class="fas fa-arrow-left"></i>Back to Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <h2 class="mt-5">Existing Categories </h2>

                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No. </th>
                            <th style="width: 200px;">Date&Time</th>
                            <th style="width: 200px;">Category Name</th>
                            <th style="width: 200px;">Creator Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                <?php 
                    global $connection;
                    $sql = "SELECT * FROM category ORDER BY id desc";
                    $query = mysqli_query($connection, $sql);
                    if (!$query) {
                        die("Error in Query <br>".mysqli_error($connection));
                    }
                    $SrNo = 0;
                    $admin = $_SESSION['adminuser'];
                    while ($rows=mysqli_fetch_assoc($query)) {
                        $categoryid = $rows['id'];
                        $datetime = $rows['time'];
                        $title =$rows['title'];
                        // $title =$rows['title'];
                        // $title =$rows['title'];
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
                            <td><?php echo htmlentities($datetime) ; ?></td>
                            <td><?php echo htmlentities($title) ; ?></td>
                            <td><?php echo htmlentities($admin) ; ?></td>
                            <td style="min-width: 140px;"><a class="btn btn-danger text-light" href="deletecategory.php?id=<?php echo $categoryid; ?>">Delete</a></td>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

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

