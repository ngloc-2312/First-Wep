<?php
session_start();

unset($_SESSION['adminID']);
unset($_SESSION['adminName']);
unset($_SESSION['adminAvatar']);

header('Location:../dangnhap.php');
