<?php
// session_start();
if (isset($_SESSION['adminuser'])) {
?>
    <div class="header header-4">
        <div class="navbar-area">
            <div class="container-fluid px-4">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="index.php">
                                <!-- <img src="Libraries/assets/img/logo/logo.svg" alt="Logo" /> -->
                                <p class="lead h4 adminusername" style=" ">Hello <?php echo $_SESSION['adminuser']; ?> </p>
                                <!-- <p class="lead h4 adminusername" style=" ">Hello <?php echo $_SESSION['adminusername']; ?> </p> -->
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent4" aria-controls="navbarSupportedContent4" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent4">
                                <ul id="nav4" class="navbar-nav ml-auto text-center">
                                    <li class="nav-item">
                                        <a class="page-scroll" href="dashboard.php"><i class="fas fa-user text-success"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="post.php"><i class="fas fa-user text-success"></i>Manage Posts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="categories.php">Manage Categories</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="comments.php">Manage Comments</a>
                                    </li>
                                    <li class="nav-item logout">
                                        <a class="page-scroll logout" href="logout.php"><i class="fas fa-user-times"></i> Logout</a>
                                    </li>
                                </ul>
                            </div>

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
} elseif (isset($_SESSION['email'])) {
    global $connection;
    $userid = $_SESSION['id'];
    $sql = "SELECT * FROM `signup` where id='$userid'";
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        die("Error in conneciton " . mysqli_error($connection));
    }
    while ($datarows = mysqli_fetch_assoc($result)) {
        $existingID = $datarows['id'];
        $existingname = $datarows['name'];
        $existingheadline = $datarows['headline'];
        $nickname = $datarows['nickname'];
        $existingbio = $datarows['bio'];
        $existingimage = $datarows['image'];
    }
?>




    <div class="header header-4">
        <div class="navbar-area">
            <div class="container-fluid px-4">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="index.php">
                                <?php
                                if (isset($nickname)) {
                                ?>
                                    <p class="lead h4">Hello @<span style="text-transform: lowercase;"><?php echo $nickname; ?></span></p>
                                    <small><?php echo $existingheadline; ?></small>
                                <?php
                                    // print_r($existingID);
                                } else if (isset($_SESSION['name'])) {
                                ?>
                                    <p class="lead h4">Hello <?php echo $_SESSION['name']; ?></p>
                                <?php
                                }
                                ?>
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent4" aria-controls="navbarSupportedContent4" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent4">
                                <ul id="nav4" class="navbar-nav ml-auto text-sm-center">
                                    <li class="nav-item ">
                                        <a class="page-scroll <?php if ($page == 'profile') {
                                                                    echo 'active';
                                                                } ?>" href="myprofile.php"><i class="fas fa-user text-success"></i> My Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll <?php if ($page == 'add') {
                                                                    echo 'active';
                                                                } ?>" href="addnewpost.php"><i class="fas fa-plus-square text-primary"></i> Add Post</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll <?php if ($page == 'blog') {
                                                                    echo 'active';
                                                                } ?>" href="myposts.php?email=<?php echo $_SESSION['email']; ?>"><i class="fas fa-blog text-primary"></i> My Blogs</a>
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


<?php } ?>