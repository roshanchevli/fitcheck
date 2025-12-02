<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>alert('Please login first');</script>";
    echo "<script>window.location.href='signin.php';</script>";
    exit;
}

$id = $_GET['id'];

include 'connect.php';
$query = "SELECT * FROM tbl_product WHERE pid=$id";
$result = mysqli_query($con, $query);
$product = mysqli_fetch_assoc($result);
$pid = $product['pid'];
$pname = $product['pname'];
$pic = $product['pic'];
$price = $product['price'];

$ins_query = "INSERT INTO tbl_order (oid, pid, pname, pic, status, qty, price,username) 
VALUES (NULL, '$pid', '$pname', '$pic', '0', '1', '$price', '{$_SESSION['user_name']}')";
$result = mysqli_query($con, $ins_query);
if ($result) {
    header("location:cart.php");
} else {
    echo "Error";
}
?>