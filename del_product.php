<?php
$pid = $_GET['id'];
include 'connect.php';

$query = "DELETE FROM tbl_product WHERE pid=$pid";
$result = mysqli_query($con, $query);

if ($result) {
    header("Location: admin_products.php?success=Product deleted successfully");
} else {
    header("Location: admin_products.php?error=Error deleting product");
    // For debugging: echo "Error: " . mysqli_error($con);
}

mysqli_close($con);

?>