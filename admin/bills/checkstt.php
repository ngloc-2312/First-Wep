<?php
require_once('../../db_config/db_connect.php');
if (isset($_GET['id']))
    $id = $_GET['id'];
if (isset($_GET['stt']))
    $stt = $_GET['stt'];
if ($stt == 0) {
    $sql = 'UPDATE bills SET status = 1 WHERE id= ' . $id;
    mysqli_query($conn, $sql);
} else {
    $sql = 'UPDATE bills SET status = 0 WHERE id= ' . $id;
    mysqli_query($conn, $sql);
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
