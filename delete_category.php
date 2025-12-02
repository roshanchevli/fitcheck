<?php

$id = $_GET['id'];
include 'connect.php';
$query = "DELETE FROM tbl_category WHERE `tbl_category`.`cat_id` = $id";

$result = mysqli_query($con, $query);
if ($result > 0) {
    header("location:admin_cat.php");
} else {
    echo "not deleteed";
}

?>