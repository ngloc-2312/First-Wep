<?php
session_start();
require_once('permission.php');
if (!isset($_SESSION['adminID'])) {
    header('Location: ../index.php');
    exit;
}
if (isset($_GET['page']))
    $page = $_GET['page'];
?>
<!doctype html>
<html lang="en">

<head>
    <title>Trang Quản Trị</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro@8af0edd/css/all.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../img/logo1.png">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../code.js"></script>
</head>

<body>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!--Header-->
    <nav class="navbar navbar-expand-sm sticky-top" id="navbar">
        <!-- Place Logo -->
        <a class="navbar-brand" href="index.php">
            <div class="logo">
                <img height="auto" src="../img/logo1.png" id="logo" style="width: 100%;height: auto;">
            </div>
            
        </a>
        <!-- Button Collapse Menu -->
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_res">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Menu Responsive, hide in small screen-->
        <div class="collapse navbar-collapse menu" id="navbar_res">
            <ul class="navbar-nav ml-auto">
                <?php
                echo '
                <li class="nav-item">
                <a class="nav-link active" id="navlink" href="#"><i id="qtv">Quản trị viên: </i>' . $_SESSION['adminName'] . '<img class="avt ml-4" src="../img/anhdaidien.png"></a>
                </li>
                ';
                ?>
            </ul>
        </div>
    </nav>

    <!--Sidebar-->
    <div class="row">
        <div class="col-2">
            <nav class="sidebar sticky-left">
                <ul style="list-style:none;" class="rounded">
                    <li class=""><a href="index.php"><i class="fa fa-home"></i> Trang chủ</a></li>
                    <li class=""><a href="index.php?page=p&pg=1"><i class="fas fa-glasses"></i>Sản Phẩm</a></li>
                    <li class=""><a href="index.php?page=b&pg=1"><i class="fas fa-copyright"></i> Thương Hiệu</a></li>
                    <li class=""><a href="index.php?page=a&pg=1"><i class="fa fa-user"></i> Tài Khoản</a></li>
                    <li class=""><a href="index.php?page=o&pg=1"><i class="fas fa-box-open"></i> Đơn Hàng</a></li>
                    <li class=""><a href="index.php?page=s"><i class="fa-regular fa-money-bill"></i> Doanh Thu</a></li>
                    <li class="logout"><a href="log_out_admin.php"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-10">
            <?php
            if (isset($page)) {
                switch ($page) {
                    case 'p':
                        include('product/product.php');
                        break;
                    case 'pa':
                        include('product/add.php');
                        break;
                    case 'pu':
                        include('product/update.php');
                        break;
                    case 'b':
                        include('brand/brand.php');
                        break;
                    case 'ba':
                        include('brand/add.php');
                        break;
                    case 'bu':
                        include('brand/update.php');
                        break;
                    case 'a':
                        include('account/account.php');
                        break;
                    case 'au':
                        include('account/update.php');
                        break;
                    case 'o':
                        include('bills/bills.php');
                        break;
                    case 'od':
                        include('bills/bill_detail.php');
                        break;
                    case 's':
                        include('doanhthu.php');
                        break;
                }
            } else include('home.php');
            ?>
        </div>
    </div>

</body>

</html>