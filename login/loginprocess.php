<?php
$dir = dirname(__DIR__, 1);
session_start();
include('../connect/dbconnect.php');
$user_login = $_POST['user_email'];
$pWord_login = $_POST['pWord_login'];

if ($_GET['mod'] == 'login') {
    $login = mysqli_query($connection, "SELECT * FROM user_data WHERE email = '$user_login' AND password = '$pWord_login' ");
    $r = mysqli_fetch_array($login);

    if($r['user_type'] == 'admin') {
        $_SESSION['username'] = $r['username'];
        $_SESSION['password'] = $r['password'];
        $_SESSION['admin'] = $r['user_type'];
        header('location:../admin/admin_page.php');
    } elseif($r['user_type'] == 'user') {
        $_SESSION['username'] = $r['username'];
        $_SESSION['password'] = $r['password'];
        $_SESSION['user'] = $r['user_type'];
        header('location:../employee/sales.php');
    }
}
?>