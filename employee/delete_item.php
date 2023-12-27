<?php
include('../connect/dbconnect.php');

if (isset($_GET['sale'])) {

   
        $delete = mysqli_query($connection, "DELETE FROM sales");
        if ($delete) {
            echo
            '<script>
                alert("Succesfuly deleting the item");
                window.location = "sales.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to delete the data");
                window.location = "sales.php";
            </script>';
        }
}
?>