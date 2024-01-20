<?php
require_once("./db_config/db_connect.php");
session_start();
// unset($_SESSION['cart']);
$id = $_GET['id'];

// SP Chưa có trong giỏ hàng
if (empty($_SESSION['cart'][$id])) {
   $sql = "SELECT * FROM glasses WHERE id = '$id'";
   $result = mysqli_query($conn, $sql);
   $each = mysqli_fetch_array($result);

   $_SESSION['cart'][$id]['name'] = $each['name'];
   $_SESSION['cart'][$id]['image'] = $each['image'];
   $_SESSION['cart'][$id]['price'] = $each['sale_price'];
   $_SESSION['cart'][$id]['quantity'] = 1;
} else {
   $_SESSION['cart'][$id]['quantity']++;
}

header('Location:cart.php');
