<?php 
    require_once "db.php";
    global $connection;

?>

<?php 
    function redirect_to($location){
        header("location:".$location);
    }
    function moveimage($tmp_name, $imagename){
        move_uploaded_file($tmp_name, "uploaded images/".$imagename);
    }function moveprofileimage($tmp_name, $imagename){
        move_uploaded_file($tmp_name, "profile pictures/".$imagename);
    }
    function checkusernameexist($username){
        global $connection;
        $query = "SELECT username from admins where username = '$username'";
        $result = mysqli_query($connection, $query);
        $result = mysqli_num_rows($result);
        if ($result==1) {
            return true;
        } else {
            return false;
        }
    }
    function postcount () {
        global $connection;
        $sql = "SELECT COUNT(*) FROM post";
        $query = mysqli_query($connection, $sql);
        $totalrows=mysqli_fetch_array($query);
        $totalposts = array_shift($totalrows);
        echo $totalposts;
    }
    function categorycount () {
        global $connection;
        $sql = "SELECT COUNT(*) FROM category";
        $query = mysqli_query($connection, $sql);
        $totalrows=mysqli_fetch_array($query);
        $totalposts = array_shift($totalrows);
        echo $totalposts;
    }
    function admincount () {
        global $connection;
        $sql = "SELECT COUNT(*) FROM admins";
        $query = mysqli_query($connection, $sql);
        $totalrows=mysqli_fetch_array($query);
        $totalposts = array_shift($totalrows);
        echo $totalposts;
    }
    function commentscount () {
        global $connection;
        $sql = "SELECT COUNT(*) FROM comments";
        $query = mysqli_query($connection, $sql);
        $totalrows=mysqli_fetch_array($query);
        $totalposts = array_shift($totalrows);
        echo $totalposts;
    }
    function userscount () {
        global $connection;
        $sql = "SELECT COUNT(*) FROM signup";
        $query = mysqli_query($connection, $sql);
        $totalrows=mysqli_fetch_array($query);
        $totalposts = array_shift($totalrows);
        echo $totalposts;
    }
    function approved ($postid) {
        global $connection;
        $sqlcomments = "SELECT COUNT(*) FROM comments where post_id = '$postid' and status='ON'";
        $querycomments = mysqli_query( $connection, $sqlcomments);

        $totalrowss=mysqli_fetch_array($querycomments);
        $totalcomments = array_shift($totalrowss);
        if ($totalcomments>0) {
            ?>
            <span class="badge badge-success">
            <?php
            echo $totalcomments; ?>

                </span>
            <?php
        }
    }
    function disapproved ($postid) {
        global $connection;
        $sqldiscomments = "SELECT COUNT(*) FROM comments where post_id = '$postid' and status='OFF'";
        $querydiscomments = mysqli_query( $connection, $sqldiscomments);

        $totaldisrowss=mysqli_fetch_array($querydiscomments);
        $totaldiscomments = array_shift($totaldisrowss);
        if ($totaldiscomments>0) {
            ?>
    <span class="badge badge-danger">
            <?php
            echo $totaldiscomments; ?>

                </span>
            <?php
        }
    }

?>