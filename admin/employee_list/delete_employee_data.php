<?php
include('../../connect/dbconnect.php');

if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];

    $check = mysqli_query($connection, "SELECT * FROM employee_data WHERE uid = '$uid'");

    if (mysqli_num_rows($check) > 0) {
        $delete = mysqli_query($connection, "DELETE FROM employee_data WHERE uid = '$uid'");
        if ($delete) {
            echo
            '<script>
                alert("Succesfuly deleting the data");
                window.location = "employee_list.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to delete the data");
                window.location = "employee_list.php";
            </script>';
        }
    } else {
        echo
        '<script>
            alert("Code not found in the database");
            window.location = "employee_list.php";
        </script>';
    }
}