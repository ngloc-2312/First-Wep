<?php
require_once("./db_config/db_connect.php");
session_start();

$fullname = $_POST['ho_ten'];
$username = $_POST['ten_dang_nhap'];
$phone = $_POST['so_dien_thoai'];
$address = $_POST['dia_chi'];
$password = $_POST['mat_khau'];

if (isset($_POST['user_signup'])) {
  $errors = false;
  $_SESSION['data'] = $_POST;

  if (empty($fullname)) {
    $_SESSION['error_fullname'] = "Trường này không được để trống";
    $errors = true;
  }
  if (empty($username)) {
    $_SESSION['error_username'] = "Trường này không được để trống";
    $errors = true;
  }
  if (empty($phone)) {
    $_SESSION['error_phone'] = "Trường này không được để trống";
    $errors = true;
  }
  if (empty($address)) {
    $_SESSION['error_address'] = "Trường này không được để trống";
    $errors = true;
  }
  if (empty($password)) {
    $_SESSION['error_password'] = "Trường này không được để trống";
    $errors = true;
  }
  // Kiểm tra và xử lý lỗi
  if ($errors) {
    // Có lỗi, điều hướng về trang signup.php và truyền lỗi dưới dạng query string
    header("Location: dangki.php");
    exit();
  }

  // Xoá dữ liệu đã lưu trữ trong session nếu không có lỗi
  unset($_SESSION['data']);

  // Không có lỗi, tiếp tục xử lý đăng ký
  $sql_signup = "INSERT INTO account (name, username, password,phone, address) VALUES ('$fullname', '$username', '$password', '$phone','$address' )";
  mysqli_query($conn, $sql_signup);

  // Điều hướng về trang signup.php sau khi đăng ký thành công
  header("Location: dangnhap.php");
  exit();
}
mysqli_close($conn);
