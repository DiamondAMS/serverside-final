<?php
include ('../connect/dbconnect.php');
    if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $select = mysqli_query($connection, "SELECT * FROM product_list WHERE code = '$code' ");
    if (mysqli_num_rows($select) == 0) {
        '<div class = "alert alert-warning">
            Code does not exist in the database
        </div>';
        exit();
    } else {
        $data = mysqli_fetch_assoc($select);
    }
}
$name = $data['name'];
$qty = 1;
$price = $data['price'];

$sql = mysqli_query($connection, "INSERT INTO sales (code, name, qty, price) VALUES('$code', '$name', '$qty', '$price')");
if ($sql) {
    echo '
    <script>
        alert("Add product successful");
        window.location="sales.php";
    </script>';
} else {
    echo '
    <script>
        alert("Failed to save data");
        window.location="sales.php";
    </script>';
}
?>