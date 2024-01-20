<?php 
    require_once('db_define.php');
  
    $conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    //Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    //Set tiengviet
    mysqli_set_charset($conn,'utf8');
?>