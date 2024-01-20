<?php
require_once("../db_config/db_connect.php");
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$sql = "select * from account where username = '$username' and password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    session_start();
    $each = mysqli_fetch_array($result);
    // print_r(json_encode($each));
    // exit;
    if ($each['admin'] == 1) {
        $_SESSION['adminID'] = $each['id'];
        $_SESSION['adminName'] = $each['name'];
        $_SESSION['adminAvatar'] = $each['image'];

        header('Location:index.php');
        exit;
    } else {
        $_SESSION['userID'] = $each['id'];
        $_SESSION['userName'] = $each['name'];
        $_SESSION['userAvatar'] = $each['image'];

        header('Location: ../index.php');
        exit;
    }
}
