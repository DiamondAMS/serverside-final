<?php
include('../connect/dbconnect.php');

if (isset($_GET['sale'])) {
    $item = $_GET['item'];

    $check = mysqli_query($connection, "SELECT * FROM sales WHERE code = '$item'");

    if (mysqli_num_rows($check) > 0) {
        $delete = mysqli_query($connection, "DELETE FROM sales WHERE code = '$item'");
        if ($delete) {
            echo
            '<script>
                alert("Succesfuly deleting the data");
                window.location = "sales.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to delete the data");
                window.location = "sales.php";
            </script>';
        }
    } else {
        echo
        '<script>
            alert("Code not found in the database");
            window.location = "sales.php";
        </script>';
    }
}
?>