<?php require("include/db.php"); ?>
<?php include("include/functions.php"); ?>
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location: ../signup.login.html");
} else {

?>
    <?php

    if (isset($_POST['submit'])) {
        global $connection;
        $title = $_POST['title'];
        $title = mysqli_real_escape_string($connection, $title);
        $author = $_SESSION['name'];
        $author = mysqli_real_escape_string($connection, $author);
        $category = $_POST['category_select'];
        $image = $_FILES['image'];
        $imagename = $image['name'];
        $imagename = rand(100, 1000) . "." . $imagename;
        $tmp_name = $image['tmp_name'];
        $email = $_SESSION['email'];

        // print_r($_POST);
        // echo '<br>';
        // print_r($_FILES);
        // echo '<br>';
        // print_r($_FILES['image']);
        // echo '<br>';



        $post_desc = $_POST['post_description'];
        $post_desc = mysqli_real_escape_string($connection, $post_desc);

        // TIME AND DATE FUNCTION 
        date_default_timezone_set("africa/lagos");
        $currenttime = time();
        $datetime = strftime("%B-%d-%Y %H:%M", $currenttime);

        $create_datetime = date("Y-m-d H:i:s");

        // MOVE IMAGE FILE
        moveimage($tmp_name, $imagename);


        $query = "INSERT INTO `post`(datetime, title, category, author, image, postcontent, email) VALUES('$datetime', '$title', '$category', '$author', '$imagename', '$post_desc', '$email')";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Error in Query<br>" . mysqli_error($connection));
        } else {
            // $_SESSION['success'] = "Category Added Successfully";
            // redirect_to("basic.html");
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
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="Libraries/fontawesome/css/all.css">
        <link rel="stylesheet" href="Libraries/bootstrap/css/bootstrap.min.css">

        <link rel="stylesheet" href="Libraries/assets/css/LineIcons.2.0.css">
        <link rel="stylesheet" href="Libraries/assets/css/tiny-slider.css">
        <link rel="stylesheet" href="Libraries/assets/css/glightbox.min.css">
        <link rel="stylesheet" href="Libraries/assets/css/animate.css">
        <link rel="stylesheet" href="Libraries/assets/css/lindy-uikit.css?">

        <title>Add Post</title>
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
        $page = 'add';
        include("include/header.php");
        ?>
        <!-- navbar end -->
        <!-- header start -->
        <header class="bg-dark py-3 my-5" style="color: white;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1><i class="fas fa-edit" style="color:#27aae1"></i>Add New Post</h1>
                    </div>
                </div>
            </div>
        </header>
        <!-- header end -->

        <!-- <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->

        <!-- Main Area -->
        <section class="container py-2 mb-4" style="min-height: 400px;">
            <div class="row">
                <div class="offset-lg-1 col-lg-10">
                    <form action="addnewpost.php" method="post" enctype="multipart/form-data">
                        <div class="card bg-secondary text-light mb-3">
                            <div class="card-body bg-dark">
                                <div class="form-group">
                                    <label for="author"><span class="fieldinfo">Author</span></label>
                                    <input readonly value="<?php echo $_SESSION['name']; ?>" type="text" class="form-control" id="title" name="author" placeholder="Type Author Here">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="title"><span class="fieldinfo">Post Title</span></label>
                                    <input type="text" class="form-control" id="posttitle" name="title" placeholder="Type Title Here">
                                </div>

                                <!-- <input type='text' name='category' class="catname" id="category_input" value="" /> -->
                                <div class="form-group">
                                    <label for="category_select"><span class="fieldinfo">Choose Category</span></label>
                                    <select name="category_select" class="form-control" id="category_select">
                                        <?php
                                        // Fetching all the categories

                                        global $connection;
                                        $readquery = "SELECT id,title FROM category";
                                        $readresult = mysqli_query($connection, $readquery);

                                        while ($rows = mysqli_fetch_array($readresult)) {
                                            $id = $rows['id'];
                                            $categoryname = $rows['title'];

                                        ?>
                                            <option value="" category_option="<?php echo $categoryname; ?>"><?php echo $categoryname; ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="imageselect"><span class="fieldinfo">Select Image</span></label>
                                    <input type="file" accept="image/*" class="form-control" name="image" id="imageselect">
                                </div>
                                <div class="form-group mt-4">
                                    <label for="post"><span class="fieldinfo">Post:</label></span>
                                    <textarea id="post" class="form-control" name="post_description" type="text"></textarea>
                                </div>
                                <div class="row py-4">
                                    <div class="col-lg-6 my-3">
                                        <button type="submit" name="submit" class="btn btn-block btn-success">
                                            <i class="fas fa-check"></i> Publish
                                        </button>
                                    </div>
                                    <div class="col-lg-6 my-3">
                                        <a href="post.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>Back to Dashboard</a>
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