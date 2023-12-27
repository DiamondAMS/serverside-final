<?php
include('../connect/dbconnect.php');
if (!empty($_GET['receipt'] == 'yes')) {
    $total = $_POST['total'];
    $pay = $_POST['pay'];
    if (!empty($pay)) {
        $calc = $pay - $total;
        if ($pay >= $total) {
            $code = $_POST['code'];
            $qty = $_POST['qty'];
            $price = $_POST['price'];
            $jumlah_dipilih = count($code);

            for ($x = 0; $x < $jumlah_dipilih; $x++) {
                $sql = mysqli_query($connection, "INSERT INTO receipt (code, qty, price) VALUES('$code[$x]', '$qty[$x]', '$price[$x]')");

                $sql_product = mysqli_query($connection, "SELECT * FROM product_list WHERE code = '$code[$x]'");
                $row_product = mysqli_fetch_assoc($sql_product);
                $stock = $row_product['stock'];
                $prcode = $row_product['code'];
                $total_stock = $stock - $qty[$x];

                $sql_update = mysqli_query($connection, "UPDATE product_list SET stock = '$total_stock' WHERE code = '$code[$x]'");
            }
            echo '<script>alert("PAYMENT SUCCESS"); window.location="sales.php";</script>';
        } else {
            echo '<script>alert("MONEY IS NOT ENOUGH Rp' . $calc . '"); window.location="sales.php";</script>';
        }
    } else {
        echo '<script>alert("not yet input"); window.location="sales.php";</script>';
    }
}
