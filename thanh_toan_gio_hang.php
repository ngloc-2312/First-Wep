<?php
require_once("./db_config/db_connect.php");
session_start();

$name_receiver = $_POST['name'];
$phone_receiver = $_POST['phone'];
$email_receiver = $_POST['address'];
$user_id = $_SESSION['userID'];
$cart = $_SESSION['cart'];

$total_price = 0;
foreach ($cart as $each) {
   $total_price += $each['quantity'] * $each['price'];
}
if (isset($_POST['dathang'])) {
   $sql = "INSERT INTO bills(id_customer,total) VALUES('$user_id','$total_price')";
   mysqli_query($conn, $sql);

   $sql_query = "SELECT max(id) FROM bills WHERE id_customer = '$user_id'";
   $result = mysqli_query($conn, $sql_query);
   $order_id = mysqli_fetch_array($result)['max(id)'];

   foreach ($cart as $product_id => $each) {
      $quantity = $each['quantity'];
      $price = $each['price'];
      $sql = "INSERT INTO bill_detail(id_bill,id_glasses,quantity,normal_price) VALUES('$order_id','$product_id','$quantity','$price')";
      mysqli_query($conn, $sql);
   }

   mysqli_close($conn);
   unset($_SESSION['cart']);

   header('Location:index.php');
}
