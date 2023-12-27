<?php
session_start();
// To ensure you're using same session
session_destroy();
// To destroy the session
header("location:../login/login.php");
// To redirect back
?>