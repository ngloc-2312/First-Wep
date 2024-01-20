<?php
require_once("./db_config/db_connect.php");
session_start();

// Tính toán phân trang
$sql_qty = 'select count(id) as qty from glasses';
$result_qty = mysqli_query($conn, $sql_qty);
$row = mysqli_fetch_array($result_qty);
$total_Product = $row['qty']; //Tổng số sản phẩm
$product_perPage = 12; //Số sản phẩm trên mỗi trang
$total_Page = ceil($total_Product / $product_perPage); //Tổng số trang
if (isset($_GET['pg'])) {
    $current_Page = $_GET['pg']; //Trang hiện tại
} else {
    $current_Page = 1; // Trang mặc định là 1
}
$index = ($current_Page - 1) * $product_perPage; //Vị trí bắt đầu lấy trong $sql LIMIT

$sql = 'SELECT * FROM glasses LIMIT ' . $index . ', ' . $product_perPage . '';
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4e493b69ac.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Estilos.css" />
    <title>Kính mắt Lily</title>
</head>

<body>
    <?php
    require_once('header.php');
    ?>
    <!-- ---------------------------------------------------------- -->

    <div class="header-cat">
        <div class="header-cat-image">
            <div class="cat-banner">
                <img src="image/gongkinhcan.jpg" alt="">
            </div>
        </div>
    </div>

    <section class="cartegory">
        <div class="container">
            <div class="row">
                <div class="container-top-row">
                    <p>Gọng Kính</p>
                    <li class="container-top-row-write">Gọng kính được xem như bộ khung vững chắc, là giá đỡ vững chắc
                        cho mắt kính. Không những thế, các loại gọng kính còn được thiết kế như là một phụ kiện thời
                        trang hấp dẫn giúp chủ sở hữu nổi bần bật, thu hút mọi ánh nhìn.</li>
                </div>
                <div class="cartegory-left">
                    <ul>
                        <li class="cartegory-left-li ">
                            <div class="category-title">
                                <a href="#">Chất liệu</a>
                            </div>
                            <ul>
                                <li><input type="checkbox" class="jet-checkboxes-list__input" name="chat_lieu"
                                        value="84" data-label="Acetate">Nhựa</li>
                                <li><input type="checkbox" class="jet-checkboxes-list__input" name="chat_lieu"
                                        value="85" data-label="Metal">Kim loại</li>
                                <li><input type="checkbox" class="jet-checkboxes-list__input" name="chat_lieu"
                                        value="86" data-label="Mixed Plastic and Metal">Nhựa mix kim loại</li>
                            </ul>
                        </li>
                        <li class="cartegory-left-li">
                            <div class="category-title">
                                <a href="#">Kiểu dáng</a>
                            </div>
                            <ul>
                                <li><input type="checkbox" class="jet-checkboxes-list__input" name="kieu_dang" value="1"
                                        data-label="Cat Eye">Mắt mèo</li>
                                <li><input type="checkbox" class="jet-checkboxes-list__input" name="kieu_dang" value="2"
                                        data-label="Round">Tròn tròn</li>
                                <li><input type="checkbox" class="jet-checkboxes-list__input" name="kieu_dang" value="3"
                                        data-label="Square">Vuông vuông</li>
                            </ul>
                        </li>
                        <li class="cartegory-left-li">
                            <div class="category-title">
                                <a href="#">Giá</a>
                            </div>
                            <ul>
                                <li><input type="checkbox" class="jet-checkboxes-list__input" name="gia"
                                        value="100000-200000" data-label="100.000đ — 200.000đ">100.000đ — 200.000đ</li>
                                <li><input type="checkbox" class="jet-checkboxes-list__input" name="gia"
                                        value="200000-500000" data-label="200.000đ — 500.000đ">200.000đ — 500.000đ</li>
                                <li><input type="checkbox" class="jet-checkboxes-list__input" name="gia"
                                        value="500000-1000000" data-label="500.000đ — 1.000.000đ">500.000đ — 1.000.000đ
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>


                <div class="cartegory-right row" class="bodys">
                    <div class="cartegory-right-content">
                        <?php while ($each = mysqli_fetch_array($result)) { ?>
                            <div class="cartegory-right-content-item">
                                <img src="image/<?= $each['image'] ?>" alt="Error"
                                    style="object-fit: cover; width: 100%; height: 300px;"
                                    onmouseover="changeHoverImage(this, '<?= $each['hover_image'] ?>')"
                                    onmouseout="restoreOriginalImage(this)">
                                <div style="margin-top: 10px;">
                                    <a href="product.php?id=<?= $each['id'] ?>">
                                        <div class="name">
                                            <?= $each['name'] ?>
                                        </div>
                                        <div class="price">
                                            <?= number_format($each['normal_price'], 0, ',', '.') ?> VNĐ
                                        </div>
                                        <div class="hover-image-item"
                                            style="background-image: url('<?= $each['hover_image'] ?>');"></div>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>

                        <script>
                            function changeHoverImage(element, hoverImageUrl) {
                                element.src = hoverImageUrl;
                            }

                            function restoreOriginalImage(element) {
                                element.src = element.getAttribute('data-original-image');
                            }
                        </script>

                        <!-- ----------------------Phân Trang------------------------ -->
                        <ul class="pagination mx-auto"
                            style="width: 30%;flex: 1;text-align: center;margin: auto;margin-top: 40px">
                            <?php
                            // Lấy URL hiện tại
                            $url = $_SERVER['REQUEST_URI'];

                            // Kiểm tra xem có truyền tham số 'pg' không
                            if (isset($_GET['pg'])) {
                                $page_url = preg_replace('/&?pg=[0-9]+/', '', $url);
                                $page_url .= '&pg=';
                            } else {
                                $page_url = $url . '?pg=';
                            }

                            // Kiểm tra xem có truyền tham số 's' không
                            if (isset($_GET['s'])) {
                                $search_param = '&s=' . $_GET['s'];
                            } else {
                                $search_param = '';
                            }

                            // Gán nút trước
                            if ($current_Page > 1) {
                                echo '
            <li class="page-item">
                <a class="page-link" href="' . $page_url . ($current_Page - 1) . $search_param . '">Trước</a>
            </li>';
                            } else {
                                echo '
            <li class="page-item disabled">
                <a class="page-link" href="#">Trước</a>
            </li>';
                            }

                            // Gán các trang
                            for ($i = 1; $i <= $total_Page; $i++) {
                                if ($i == $current_Page) {
                                    echo '
                <li class="page-item active">
                    <a class="page-link" href="' . $page_url . $i . $search_param . '">' . $i . '<span class="sr-only">(current)</span></a>
                </li>';
                                } else {
                                    echo '<li class="page-item"><a class="page-link" href="' . $page_url . $i . $search_param . '">' . $i . '</a></li>';
                                }
                            }

                            // Gán nút sau
                            if ($current_Page < $total_Page) {
                                echo '
            <li class="page-item">
                <a class="page-link" href="' . $page_url . ($current_Page + 1) . $search_param . '">Sau</a>
            </li>';
                            } else {
                                echo '
            <li class="page-item disabled">
                <a class="page-link" href="#">Sau</a>
            </li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require_once("footer.php") ?>

</body>

</html>