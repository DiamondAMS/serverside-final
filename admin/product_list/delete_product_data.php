<?php
include('../../connect/dbconnect.php');

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $check = mysqli_query($connection, "SELECT * FROM product_list WHERE code = '$code'");

    if (mysqli_num_rows($check) > 0) {
        $delete = mysqli_query($connection, "DELETE FROM product_list WHERE code = '$code'");
        if ($delete) {
            echo
            '<script>
                alert("Succesfuly deleting the data");
                window.location = "product_list.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to delete the data");
                window.location = "product_list.php";
            </script>';
        }
    } else {
        echo
        '<script>
            alert("Code not found in the database");
            window.location = "product_list.php";
        </script>';
    }
}