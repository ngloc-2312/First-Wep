<?php
require_once("./db_config/db_connect.php");
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
$sum = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4e493b69ac.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Estilos.css" />
    <title>Kính mắt Lily</title>
</head>

<body>
    <?php
    require_once('header.php');
    ?>
    <section class="cart">
        <div class="duca">
            <div class="cart-top-warp">
                <div class="cart-top">
                    <div class="cart-top-cart cart-top-item">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="cart-top-address cart-top-item">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="cart-top-payment cart-top-item">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($_SESSION['cart'])) { ?>
            <div class="duca">
                <div class="cart-content roo">
                    <div class="cart-content-left">
                        <table>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <!-- <th>Màu sắc</th> -->
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>
                                    Xoá
                                </th>
                                <!-- <i class="fa-solid fa-trash-can"></i> -->
                            </tr>
                            <?php foreach ($cart as $id => $each) : ?>
                                <tr>
                                    <td><img src="img/<?= $each['image'] ?>"></td>
                                    <td>
                                        <p style="font-weight: bold;"><?= $each['name'] ?></p>
                                    </td>
                                    <td>
                                        <a href="update_quantity_cart.php?id=<?= $id ?>&type=decrement">-</a>
                                        <span><?= $each['quantity'] ?></span>
                                        <a href="update_quantity_cart.php?id=<?= $id ?>&type=increment">+</a>
                                    </td>
                                    <?php $result = $each['price'] * $each['quantity'];
                                    $sum += $result; ?>
                                    <td><?= number_format($each['price'], 0, ',', '.') ?> đ</td>
                                    <!-- HTML -->
                                    <td><a href="delete_cart.php?id=<?= $id ?>"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>

                    <div class="cart-content-right">
                        <table>
                            <tr>
                                <th colspan="2">Thông tin thanh toán</th>
                            </tr>
                            <tr>
                                <td>Tổng sản phẩm</td>
                                <td><?= count($cart) ?></td>
                            </tr>
                            <tr>
                                <td>Tổng tiền hàng</td>
                                <td>
                                    <p><?= number_format($sum, 0, ',', '.') ?> đ</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Tạm tính</td>
                                <td>
                                    <p style="color: black;font-weight: bold;"><?= number_format($sum, 0, ',', '.') ?> đ</p>
                                </td>
                            </tr>
                        </table>
                        <div class="cart-content-right-text">
                            <p>Bạn sẽ được miễn phí ship khi đơn hàng của bạn có tổng giá trị trên 2.000.000 đ</p>
                            <p style="color: red; font-weight: bold;">Mua thêm 500.000 đ để được free SHIP</p>
                        </div>
                        <div class="cart-content-right-button">

                            <!-- ... (các phần tử khác) -->
                            <button onclick="returnToProduct()">Tiếp tục mua hàng</button>


                            <script>
                                function returnToProduct() {
                                    window.location.href = "gong_kinh_can.php";
                                }
                            </script>


                            <!-- ... (các phần tử khác) -->
                            <button onclick="redirectToDelivery()">Thanh toán</button>
                        </div>

                        <script>
                            function redirectToDelivery() {
                                window.location.href = "delivery.php";
                            }
                        </script>


                        <div class="cart-content-right-login">
                            <p>TÀI KHOẢN LILY</p></br>
                            <p>Hãy <a href="dangnhap.php">Đăng nhập</a> tài khoản của bạn để tích thêm thành viên</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <h2 style="text-align: center; font-size: 25px; color: red">GIỎ HÀNG TRỐNG</h2>
        <?php } ?>

    </section>

    <?php
    require_once('footer.php');
    ?>
</body>

</html>