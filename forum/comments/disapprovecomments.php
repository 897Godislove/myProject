<?php //require ("../include/db.php"); ?>
<?php include ("../include/functions.php"); ?>
<?php include ("../include/sessions.php"); ?>
<?php 
    if (isset($_GET['id'])) {
        $searchQueryparameter = $_GET['id'];
        global $connection;
        $admin = $_SESSION['adminusername'];
        $sql = "UPDATE comments SET status='OFF' , approvedby='$admin' WHERE id='$searchQueryparameter'";
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
                        redirect_to("../comments.php");
                    }
    }

?>