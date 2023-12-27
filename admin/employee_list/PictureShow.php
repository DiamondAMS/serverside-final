<?php
include "../../connect/dbconnect.php";
if(isset($_GET['uid'])) {
    $id = $_GET['uid'];
    $query = "SELECT namefile, typefile, size, picture FROM employee_data WHERE uid = '$id'";
    $result = mysqli_query($connection, $query) or die('Error, query failed');
    list($namefile, $type, $size, $content) = mysqli_fetch_array($result);
    header("Content-length: $size");
    header("Content-type: $type");
    header("Content-disposition: attachment; filename=$namefile");
    echo $content;
}

?>