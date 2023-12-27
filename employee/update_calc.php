<?php
include ('../connect/dbconnect.php');
if (isset($_GET['sale'])) {
    $id = $_POST['id'];
    $qty = $_POST['qty'];
    $product_id = $_POST['product_id'];
    $select = mysqli_query($connection, "SELECT * FROM product_list WHERE code = '$product_id' ");
    if (mysqli_num_rows($select) == 0) {
        '<div class = "alert alert-warning">
            Code does not exist in the database
        </div>';
        exit();
    } else {
        $data = mysqli_fetch_assoc($select);
    }
}

if($data['stock'] >= $qty) {
    $price = $data['price'];
    $total = $price * $qty;
    $sql = mysqli_query($connection, "UPDATE sales SET qty = '$qty', price = '$total' WHERE id = '$id'");
    if ($sql) {
        echo '
        <script>
            alert("update data successful");
            window.location="sales.php";
        </script>';
    } else {
        echo '
        <script>
            alert("Failed to save data");
            window.location="sales.php";
        </script>';
    }
}
?>