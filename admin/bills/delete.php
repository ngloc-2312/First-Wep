<?php
if (isset($_GET['id']))
  $id = $_GET['id'];

require_once('../../db_config/db_connect.php');
$sql = 'delete from bills where id=' . $id;
mysqli_query($conn, $sql);

header('Location: ../index.php?page=o&pg=1');
