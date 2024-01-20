<?php
require_once("./db_config/db_connect.php");
session_start();

$id = isset($_GET['id']) ? $_GET['id'] : null;
$sql = "select glasses.*, brand.name as brand_name 
from glasses
left join brand on brand.id = glasses.id_brand
where glasses.id = '$id'";

$result = mysqli_query($conn, $sql);
$each = mysqli_fetch_array($result);

$sql_related = "SELECT glasses.id_brand, brand.*  
FROM glasses
LEFT JOIN brand ON brand.id = glasses.id_brand
WHERE glasses.id = '$id'";
$result_related  = mysqli_query($conn, $sql_related);
$each_related  = mysqli_fetch_array($result_related);

$brand_id = $each_related['id'];
$sql_product_related = "SELECT * FROM glasses 
WHERE 
id_brand = (SELECT id_brand FROM glasses WHERE id = $id) AND id != $id
LIMIT 5";
$result_product_related  = mysqli_query($conn, $sql_product_related);
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
    <!-- ---------------------------------------------------------- -->
    <section class="product">
        <div class="container">
            <div class="product-top roo">
                <p>Trang chủ</p> <span>&#92;</span>
                <p>Nhựa</p>
            </div>
            <div class="product-content roo">
                <div class="product-content-left roo">
                    <div class="product-content-left-big-img" style="height: 700px;">
                        <img src="img/<?= $each['image'] ?>" style="height: 100%; width: 100%; object-fit: cover;">
                    </div>
                    <div class="product-content-left-small-img" style="margin-top: 10px;">
                        <img src="img/<?= $each['image'] ?>">
                        <img src="image/list2a.jpeg">
                        <img src="image/list3.jpg">
                        <img src="image/list3a.png">
                    </div>
                </div>
                <div class="product-content-right">
                    <div class="product-content-right-product-name">
                        <h1><?= $each['name'] ?></h1>
                        <p><strong>Mã sản phẩm</strong> : R-NC-VV-KC320</p>
                    </div>
                    <div class="product-content-right-product-price">
                        <p><?= number_format($each['normal_price'], 0, ',', '.') ?> đ</p>
                    </div>

                    <div class="product-content-right-product-information">
                        <p>THÔNG TIN GỌNG KÍNH</p>
                        <p>* Thương Hiệu:LILY</p>
                        <p>* Mã sản phẩm: KC320</p>
                        <p>*Thông tin kỹ thuật số :58-20-140</p>
                        <p>*Chất liệu: Nhựa Cứng</p>
                        <p>*Giá sản phẩm: 500000 VNĐ</p>
                        <p>*Xuất sứ: Trung Quốc</p>
                        <p>*CHỊU TRÁCH NHIỆM SP: CÔNG TY TNHH THƯƠNG MẠI VÀ DỊCH VỤ LILY GROUP VIỆT NAM</p>
                        <p>*CẢNH BÁO: BẢO QUẢN TRONG HỘP KÍNH</p>
                        <p>*HDSD: DÙNG ĐỂ ĐEO MẮT, TRÁNH NHIỆT ĐỘ CAO & VA CHẠM MẠNH</p>
                        <p>*MH:511403</p>
                    </div>

                    <div class="product-content-right-product-color roo">
                        <p><span>Màu sắc</span>:</p>
                        <div class="color">
                            <ul class="color-list">
                                <li>
                                    <span class=" active" data-tip="Trắng " data-background-color="#000" currentitem="false">Trắng </span>
                                </li>
                                <li>
                                    <span class=" active" data-tip="Đen " data-background-color="#000" currentitem="false">Đen </span>
                                </li>
                                <li>
                                    <span class=" active" data-tip="Trắng vàng" data-background-color="#000" currentitem="false">Trắng vàng</span>
                                </li>
                                <li>
                                    <span class=" active" data-tip="Đen nâu " data-background-color="#000" currentitem="false">Đen nâu </span>
                                </li>
                                <li>
                                    <span class=" active" data-tip="Đen vàng" data-background-color="#000" currentitem="false">Đen vàng </span>
                                </li>
                                <li>
                                    <span class=" active" data-tip="Vàng kim" data-background-color="#000" currentitem="false">Vàng kim </span>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="product-content-right-product-quantity roo ">
                        <p><span>Số lượng</span>:</p>
                        <div class="product-quantity">
                            <div class="product-quantity-item">
                                <span class="product-quantity-item-back">-</span>
                                <span class="product-quantity-item-qty">1</span>
                                <span class="product-quantity-item-next">+</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <form action="cart.php?id=<?= $each['id'] ?>" method="post">
                            <?php if (!empty($_SESSION['userID']) || !empty($_SESSION['cart'])) { ?>
                                <a href="xu_ly_gio_hang.php?id=<?= $each['id'] ?>" class="product-add-to-cart" style="display: block;">Thêm vào giỏ hàng</a>
                                <a href="xu_ly_gio_hang.php?id=<?= $each['id'] ?>" class="product-add-to-cart buy-now" style="display: block;">Mua ngay</a>
                            <?php } else { ?>
                                <div class="product-add-to-cart" style="display: block;">Thêm vào giỏ hàng</div>
                                <div class="product-add-to-cart buy-now" style="display: block;">Mua ngay</div>
                            <?php } ?>
                        </form>
                    </div>

                    <div class="product-content-right-bottom">
                        <div class="product-content-right-bottom-top">
                            &#8744;
                        </div>
                        <div class="product-content-right-bottom-content-big">
                            <div class="product-content-right-bottom-content-title roo">
                                <div class="product-content-right-bottom-content-title-item warranty">
                                    <p>Bảo hành</p>
                                </div>
                                <div class="product-content-right-bottom-content-title-item delivery">
                                    <p>Giao hàng</p>
                                </div>
                                <div class="product-content-right-bottom-content-title-item refund">
                                    <p>Chính sách hoàn trả</p>
                                </div>
                            </div>
                            <div class="product-content-right-bottom-content">
                                <div class="product-content-right-bottom-content-warranty">
                                    <p>Bảo hành ốc vít rơi ra, gọng lệch, gọng kênh vênh, lỏng chật, rơi ve đệm mũi trọn
                                        đời.</p>
                                </div>
                                <div class="product-content-right-bottom-content-delivery">
                                    <p>Giao hàng tận nơi, được kiểm tra hàng trước khi thanh toán</p>
                                </div>
                                <div class="product-content-right-bottom-content-refund">
                                    <p>Bảo hành 1 đổi 1 khi có lỗi của nhà sản xuất, lỗi do đo mắt sai (trong 10 ngày
                                        đầu), hỗ trợ giảm 50% nếu đổi gọng mới</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- ---------------------------------------------------------- -->
    <section class="product-related">
        <div class="product-related-tittle">
            <p>Sản phẩm liên quan</p>
        </div>
        <div class="product-related-content roo" style="padding: 5px;">
            <?php while ($kq = mysqli_fetch_array($result_product_related)) { ?>
                <div class="product-related-content-item product-shadow">
                    <a href="?id=<?= $kq['id'] ?>" style="display: block; cursor: pointer;">
                        <img src="img/<?= $kq['image'] ?>" style="height: 208px; object-fit: cover;width: 100%;">
                    </a>
                    <a href="?id=<?= $kq['id'] ?>" style="display: block; cursor: pointer;">
                        <h1><?= $kq['name'] ?></h1>
                    </a>
                    <?php if (!empty($kq['sale_price'])) { ?>
                        <div class="tien">
                            <p><?= number_format($kq['normal_price'], 0, ',', '.') ?> đ</p>
                        </div>
                        <p><?= number_format($kq['sale_price'], 0, ',', '.') ?> đ</p>
                    <?php } else { ?>
                        <p><?= number_format($kq['normal_price'], 0, ',', '.') ?> đ</p>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>

    <?php require_once("footer.php") ?>
    <script src="product.js"></script>
</body>

</html>