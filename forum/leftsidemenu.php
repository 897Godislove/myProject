<!DOCTYPE html>
<html lang="en">

  <!-- Mirrored from www.wpkixx.com/html/winku/social-post-single.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jan 2022 15:10:48 GMT -->

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

  <aside class="sidebar static mr-10">
    <div class="widget">
      <h4 class="widget-title">Shortcuts</h4>
      <ul class="naves">
        <li>
          <i class="ti-clipboard"></i>
          <a href="newsfeed.html" title="">My pages</a>
        </li>
        <li>
          <i class="ti-power-off"></i>
          <a href="landing.html" title="">Logout</a>
        </li>
      </ul>
    </div><!-- Shortcuts -->
    <!-- Categories -->
    <div class="widget">
      <h4 class="widget-title">Category</h4>
      <ul class="naves">
        <?php
        global $connection;
        $sql = "SELECT * from category order by id desc";
        $query = mysqli_query($connection, $sql);
        while ($datarows = mysqli_fetch_assoc($query)) {
          $categoryid = $datarows['id'];
          $categorytitle = $datarows['title']; ?>
          <li>
            <i class="ti-clipboard"></i>
            <a href="blog.php?category=<?php echo $categorytitle; ?>" title=""><?php echo $categorytitle; ?></a>
          </li>
          <br>

        <?php } ?>


      </ul>
    </div><!-- Shortcuts -->
    <div class="widget">
      <h4 class="widget-title">Recent Activity</h4>
      <ul class="activitiez">
        <li>
          <div class="activity-meta">
            <i>10 hours Ago</i>
            <span><a href="#" title="">Commented on Video posted </a></span>
            <h6>by <a href="time-line.html">black demon.</a></h6>
          </div>
        </li>
        <li>
          <div class="activity-meta">
            <i>30 Days Ago</i>
            <span><a href="#" title="">Posted your status. “Hello guys, how are you?”</a></span>
          </div>
        </li>
        <li>
          <div class="activity-meta">
            <i>2 Years Ago</i>
            <span><a href="#" title="">Share a video on her timeline.</a></span>
            <h6>"<a href="#">you are so funny mr.been.</a>"</h6>
          </div>
        </li>
      </ul>
    </div>
    <!-- recent activites -->

    <!-- <div class="widget stick-widget">
        <h4 class="widget-title">Who's follownig</h4>
        <ul class="followers">
          <li>
            <figure><img src="images/resources/friend-avatar2.jpg" alt=""></figure>
            <div class="friend-meta">
              <h4><a href="time-line.html" title="">Kelly Bill</a></h4>
              <a href="#" title="" class="underline">Add Friend</a>
            </div>
          </li>
          <li>
            <figure><img src="images/resources/friend-avatar4.jpg" alt=""></figure>
            <div class="friend-meta">
              <h4><a href="time-line.html" title="">Issabel</a></h4>
              <a href="#" title="" class="underline">Add Friend</a>
            </div>
          </li>
          <li>
            <figure><img src="images/resources/friend-avatar6.jpg" alt=""></figure>
            <div class="friend-meta">
              <h4><a href="time-line.html" title="">Andrew</a></h4>
              <a href="#" title="" class="underline">Add Friend</a>
            </div>
          </li>
          <li>
            <figure><img src="images/resources/friend-avatar8.jpg" alt=""></figure>
            <div class="friend-meta">
              <h4><a href="time-line.html" title="">Sophia</a></h4>
              <a href="#" title="" class="underline">Add Friend</a>
            </div>
          </li>
          <li>
            <figure><img src="images/resources/friend-avatar3.jpg" alt=""></figure>
            <div class="friend-meta">
              <h4><a href="time-line.html" title="">Allen</a></h4>
              <a href="#" title="" class="underline">Add Friend</a>
            </div>
          </li>
        </ul>
      </div> -->
    <!-- who's following -->

  </aside>
</html>