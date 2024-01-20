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

// Xây dựng câu truy vấn dựa trên việc có hay không dữ liệu tìm kiếm
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $sql = "SELECT * FROM glasses WHERE name LIKE '%$searchTerm%' LIMIT $index, $product_perPage";
} else {
    $sql = "SELECT * FROM glasses LIMIT $index, $product_perPage";
}

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
    <!-- ----------------Tìm Kiếm ------------------------------- -->
    <section class="search">
        <div class="search-container">
            <div class="search-content">
                <p style="font-weight: bold; font-size: 18px; text-transform: uppercase; margin-bottom: 30px">Kết quả
                    tìm kiếm</p>
            </div>
            <div class="search-list"
                style="display: flex; flex-wrap: wrap; justify-content: flex-start; align-items: flex-start; row-gap: 20px">
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
                                <div class="hover-image-item" style="background-image: url('<?= $each['hover_image'] ?>');">
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <ul class="pagination mx-auto" style="display: flex; align-items: center; margin-top: 50px;">
                <?php
                // Lấy URL hiện tại
                $url = $_SERVER['REQUEST_URI'];

                // Tách các phần của URL
                $url_parts = parse_url($url);

                // Lấy query string (tham số trong URL)
                $query_string = isset($url_parts['query']) ? $url_parts['query'] : '';

                // Chuyển query string thành mảng
                parse_str($query_string, $params);

                // Xóa tham số 'pg' nếu có
                unset($params['pg']);

                // Gán nút trước
                if ($current_Page > 1) {
                    $params['pg'] = $current_Page - 1;
                    $prev_url = $url_parts['path'] . '?' . http_build_query($params);
                    echo '<li class="page-item"><a class="page-link" href="' . $prev_url . '">Trước</a></li>';
                } else {
                    echo '<li class="page-item disabled"><a class="page-link" href="#">Trước</a></li>';
                }

                // Gán các trang
                for ($i = 1; $i <= $total_Page; $i++) {
                    $params['pg'] = $i;
                    $page_url = $url_parts['path'] . '?' . http_build_query($params);

                    if ($i == $current_Page) {
                        echo '<li class="page-item active"><a class="page-link" href="' . $page_url . '">' . $i . '<span class="sr-only">(current)</span></a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="' . $page_url . '">' . $i . '</a></li>';
                    }
                }

                // Gán nút sau
                if ($current_Page < $total_Page) {
                    $params['pg'] = $current_Page + 1;
                    $next_url = $url_parts['path'] . '?' . http_build_query($params);
                    echo '<li class="page-item"><a class="page-link" href="' . $next_url . '">Sau</a></li>';
                } else {
                    echo '<li class="page-item disabled"><a class="page-link" href="#">Sau</a></li>';
                }
                ?>
            </ul>
        </div>
    </section>
    <!-- -------------------------------------------------------- -->
    <?php require_once("footer.php") ?>

</body>

</html>