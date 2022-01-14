<?php //require ("../include/db.php"); ?>
<?php include ("include/functions.php"); ?>
<?php
        session_start();
        if (!isset($_SESSION['adminuser'])) {
            header("location: ../signup.login.html");
        }else { ?>
<?php 
    if (isset($_GET['id'])) {
        $searchQueryparameter = $_GET['id'];
        global $connection;
        $sql = "DELETE FROM category WHERE id='$searchQueryparameter'";
        $query = mysqli_query($connection, $sql);
                    if (!$query) {
                        die("Error in connection ".mysqli_error($connection))
                        ?>
                            <script>
                                alert("Error!")
                            </script>
                        <?php
                        header("location:../comments.php");
                    } else {
                        redirect_to("categories.php");
                    }
    }
}
?>