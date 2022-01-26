<?php
// session_start();
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from www.wpkixx.com/html/winku/edit-profile-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jan 2022 15:12:34 GMT -->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <title>Winku Social Network Toolkit</title>
  <link rel="icon" href="images/fav.png" type="image/png" sizes="16x16">

  <link rel="stylesheet" href="css/main.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/color.css">
  <link rel="stylesheet" href="css/responsive.css">

</head>

<body>
  <?php
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
  ?>
  <div class="topbar stick">
    <div class="logo">
      <a title="" href="newsfeed.html"><img src="images/logo.png" alt=""></a>
    </div>

    <div class="top-area">
      <ul class="main-menu">
        <li>
          <a href="#" title="">Home</a>
          <ul>
            <li><a href="extblog.php" title="">Home Social</a></li>
            <!-- <li><a href="index2.html" title="">Home Social 2</a></li>
            <li><a href="index-company.html" title="">Home Company</a></li>
            <li><a href="landing.html" title="">Login page</a></li>
            <li><a href="logout.html" title="">Logout Page</a></li>
            <li><a href="newsfeed.html" title="">news feed</a></li> -->
          </ul>
        </li>
        <li>
          <a href="#" title="">timeline</a>
          <ul>
            <li><a href="extmyposts.php?email=<?php echo $_SESSION['email']; ?>" title="">timeline</a></li>
            <!-- <li><a href="timeline-friends.html" title="">timeline friends</a></li>
            <li><a href="timeline-groups.html" title="">timeline groups</a></li>
            <li><a href="timeline-pages.html" title="">timeline pages</a></li>
            <li><a href="timeline-photos.html" title="">timeline photos</a></li>
            <li><a href="timeline-videos.html" title="">timeline videos</a></li>
            <li><a href="social-post-single.html" title="">Post Single</a></li>
            <li><a href="fav-page.html" title="">favourit page</a></li>
            <li><a href="groups.html" title="">groups page</a></li>
            <li><a href="page-likers.html" title="">Likes page</a></li>
            <li><a href="people-nearby.html" title="">people nearby</a></li> -->
          </ul>
        </li>
        <li>
          <a href="#" title="">account settings</a>
          <ul>
            <!-- <li><a href="create-fav-page.html" title="">create fav page</a></li>
            <li><a href="edit-account-setting.html" title="">edit account setting</a></li>
            <li><a href="edit-interest.html" title="">edit-interest</a></li>
            <li><a href="edit-password.html" title="">edit-password</a></li> -->
            <li><a href="extmyprofile.php" title="">edit profile basics</a></li>
            <!-- <li><a href="edit-work-eductation.html" title="">edit work educations</a></li>
            <li><a href="messages.html" title="">message box</a></li>
            <li><a href="inbox.html" title="">Inbox</a></li>
            <li><a href="notifications.html" title="">notifications page</a></li> -->
          </ul>
        </li>
        <li>
          <a href="#" title="">more pages</a>
          <ul>
            <li><a href="404.html" title="">404 error page</a></li>
            <li><a href="about.html" title="">about</a></li>
            <li><a href="contact.html" title="">contact</a></li>
            <li><a href="faq.html" title="">faq's page</a></li>
            <li><a href="insights.html" title="">insights</a></li>
            <li><a href="#">knowledge base</a></li>
            <li><a href="widgets.html" title="">Widgts</a></li>
          </ul>
        </li>
      </ul>
      <ul class="setting-area">
        <li>
          <a href="#" title="Home" data-ripple=""><i class="ti-search"></i></a>
          <div class="searched">
            <form method="post" class="form-search">
              <input type="text" name="search" placeholder="Search">
              <button data-ripple name="searchbtn" type="submit"><i class="ti-search"></i></button>
            </form>
          </div>
        </li>
        <li><a href="newsfeed.html" title="Home" data-ripple=""><i class="ti-home"></i></a></li>
        <li>
          <a href="#" title="Notification" data-ripple="">
            <i class="ti-bell"></i><span>20</span>
          </a>
          <div class="dropdowns">
            <span>4 New Notifications</span>
            <ul class="drops-menu">
              <li>
                <a href="notifications.html" title="">
                  <img src="images/resources/thumb-1.jpg" alt="">
                  <div class="mesg-meta">
                    <h6>sarah Loren</h6>
                    <span>Hi, how r u dear ...?</span>
                    <i>2 min ago</i>
                  </div>
                </a>
                <span class="tag green">New</span>
              </li>
              <li>
                <a href="notifications.html" title="">
                  <img src="images/resources/thumb-2.jpg" alt="">
                  <div class="mesg-meta">
                    <h6>Jhon doe</h6>
                    <span>Hi, how r u dear ...?</span>
                    <i>2 min ago</i>
                  </div>
                </a>
                <span class="tag red">Reply</span>
              </li>
              <li>
                <a href="notifications.html" title="">
                  <img src="images/resources/thumb-3.jpg" alt="">
                  <div class="mesg-meta">
                    <h6>Andrew</h6>
                    <span>Hi, how r u dear ...?</span>
                    <i>2 min ago</i>
                  </div>
                </a>
                <span class="tag blue">Unseen</span>
              </li>
              <li>
                <a href="notifications.html" title="">
                  <img src="images/resources/thumb-4.jpg" alt="">
                  <div class="mesg-meta">
                    <h6>Tom cruse</h6>
                    <span>Hi, how r u dear ...?</span>
                    <i>2 min ago</i>
                  </div>
                </a>
                <span class="tag">New</span>
              </li>
              <li>
                <a href="notifications.html" title="">
                  <img src="images/resources/thumb-5.jpg" alt="">
                  <div class="mesg-meta">
                    <h6>Amy</h6>
                    <span>Hi, how r u dear ...?</span>
                    <i>2 min ago</i>
                  </div>
                </a>
                <span class="tag">New</span>
              </li>
            </ul>
            <a href="notifications.html" title="" class="more-mesg">view more</a>
          </div>
        </li>
        <li>
          <a href="#" title="Messages" data-ripple=""><i class="ti-comment"></i><span>12</span></a>
          <div class="dropdowns">
            <span>5 New Messages</span>
            <ul class="drops-menu">
              <li>
                <a href="notifications.html" title="">
                  <img src="images/resources/thumb-1.jpg" alt="">
                  <div class="mesg-meta">
                    <h6>sarah Loren</h6>
                    <span>Hi, how r u dear ...?</span>
                    <i>2 min ago</i>
                  </div>
                </a>
                <span class="tag green">New</span>
              </li>
              <li>
                <a href="notifications.html" title="">
                  <img src="images/resources/thumb-2.jpg" alt="">
                  <div class="mesg-meta">
                    <h6>Jhon doe</h6>
                    <span>Hi, how r u dear ...?</span>
                    <i>2 min ago</i>
                  </div>
                </a>
                <span class="tag red">Reply</span>
              </li>
              <li>
                <a href="notifications.html" title="">
                  <img src="images/resources/thumb-3.jpg" alt="">
                  <div class="mesg-meta">
                    <h6>Andrew</h6>
                    <span>Hi, how r u dear ...?</span>
                    <i>2 min ago</i>
                  </div>
                </a>
                <span class="tag blue">Unseen</span>
              </li>
              <li>
                <a href="notifications.html" title="">
                  <img src="images/resources/thumb-4.jpg" alt="">
                  <div class="mesg-meta">
                    <h6>Tom cruse</h6>
                    <span>Hi, how r u dear ...?</span>
                    <i>2 min ago</i>
                  </div>
                </a>
                <span class="tag">New</span>
              </li>
              <li>
                <a href="notifications.html" title="">
                  <img src="images/resources/thumb-5.jpg" alt="">
                  <div class="mesg-meta">
                    <h6>Amy</h6>
                    <span>Hi, how r u dear ...?</span>
                    <i>2 min ago</i>
                  </div>
                </a>
                <span class="tag">New</span>
              </li>
            </ul>
            <a href="messages.html" title="" class="more-mesg">view more</a>
          </div>
        </li>
        <li><a href="#" title="Languages" data-ripple=""><i class="fa fa-globe"></i></a>
          <div class="dropdowns languages">
            <a href="#" title=""><i class="ti-check"></i>English</a>
            <a href="#" title="">Arabic</a>
            <a href="#" title="">Dutch</a>
            <a href="#" title="">French</a>
          </div>
        </li>
      </ul>
      <div class="user-img">
        <img src="images/resources/admin.jpg" alt="">
        <span class="status f-online"></span>
        <div class="user-setting">
          <a href="#" title=""><span class="status f-online"></span>online</a>
          <a href="#" title=""><span class="status f-away"></span>away</a>
          <a href="#" title=""><span class="status f-off"></span>offline</a>
          <a href="#" title=""><i class="ti-user"></i> view profile</a>
          <a href="#" title=""><i class="ti-pencil-alt"></i>edit profile</a>
          <a href="#" title=""><i class="ti-target"></i>activity log</a>
          <a href="#" title=""><i class="ti-settings"></i>account setting</a>
          <a href="#" title=""><i class="ti-power-off"></i>log out</a>
        </div>
      </div>
      <span class="ti-menu main-menu" data-ripple=""></span>
    </div>
  </div>
</body>

</html>