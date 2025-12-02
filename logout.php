<?php
echo "<script>alert('are you sure you want to logout?')</script>";
session_start();
session_unset();
session_destroy();
header("Location: index.php");
exit();
?>