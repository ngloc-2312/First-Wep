<?php
require_once("./db_config/db_connect.php");
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
$sum = 0;
// Lấy thông tin người dùng
$idUser = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;
$sql_user = "SELECT * FROM account WHERE id = '$idUser'";
$result_user = mysqli_query($conn, $sql_user);
$ketqua = mysqli_fetch_array($result_user);

// Lấy thông tin đơn hàng
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
$sum = 0;
foreach ($cart as $id => $each) {
    $result = $each['price'] * $each['quantity'];
    $sum += $result;
}

// Thêm dữ liệu vào bảng "bills"
$date_order = date("Y-m-d"); // Lấy ngày hiện tại
$total = $sum; // Tổng tiền đơn hàng
$status = "pending"; // Trạng thái đơn hàng (ví dụ: "pending", "completed", "cancelled")

$sql_insert = "INSERT INTO bills (id_customer, date_order, total, status) VALUES ('$idUser', '$date_order', '$total', '$status')";
mysqli_query($conn, $sql_insert);
// Truy vấn dữ liệu từ bảng "bills"
$sql_select = "SELECT * FROM bills WHERE id_customer = '$idUser' ORDER BY date_order DESC";
$result_select = mysqli_query($conn, $sql_select);

// Hiển thị dữ liệu trong bảng HTML
// Truy vấn dữ liệu từ bảng 'bills'
$sql = "SELECT * FROM bills";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>ID Customer</th>";
    echo "<th>Date Order</th>";
    echo "<th>Total</th>";
    echo "<th>Status</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['id_customer'] . "</td>";
        echo "<td>" . $row['date_order'] . "</td>";
        echo "<td>" . $row['total'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Không có đơn hàng.";
}
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

    $idUser = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;
    $sql_user = "SELECT * FROM account WHERE id = '$idUser'";
    $result_user = mysqli_query($conn, $sql_user);
    $ketqua = mysqli_fetch_array($result_user);
    ?>
    <!-- -----------------------Delivery----------------------------------- -->
    <section class="delivery-i">
        <div class="duca">
            <div class="delivery-top-warp">
                <div class="delivery-top">
                    <div class="delivery-top-delivery delivery-top-item">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="delivery-top-address delivery-top-item">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="delivery-top-payment delivery-top-item">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                </div>
            </div>
        </div>

        <section class="duca">
            <form action="thanh_toan_gio_hang.php" method="post">
                <div class="delivery-content roo">
                    <div class="delivery-content-left">
                        <p>Vui lòng chọn địa chỉ giao hàng</p>
                        <div class="delivery-content-left-login roo">
                            <i class="fas fa-sign-in-alt"></i>
                            <p>Đăng nhập(Nếu bạn đã có tài khoản của Lily)</p>
                        </div>
                        <div class="delivery-content-left-khachle roo">
                            <input checked name="loaikhach" type="radio">
                            <p><span style="font-weight: bold;">Khách lẻ</span>(Nếu bạn không muốn lưu lại thông tin)</p>
                        </div>
                        <div class="delivery-content-left-dangky roo">
                            <input name="loaikhach" type="radio">
                            <p><span style="font-weight: bold;">Đăng ký</span>(Tạo mới tài khoản với thông tin bên dưới)</p>
                        </div>
                        <div class="delivery-content-left-input-top roo">
                            <div class="delivery-content-left-input-top-item">
                                <label for="">Họ tên <span style="color: red;">*</span></label>
                                <input type="text" value="<?= isset($idUser) ? $ketqua['name'] : '' ?>" name="name">
                            </div>
                            <div class="delivery-content-left-input-top-item">
                                <label for="">Điện thoại <span style="color: red;">*</span></label>
                                <input type="text" value="<?= isset($idUser) ? $ketqua['phone'] : '' ?>" name="phone">
                            </div>
                            <div class="delivery-content-left-input-top-item">
                                <label for="">Địa chỉ <span style="color: red;">*</span></label>
                                <input type="text" value="<?= isset($idUser) ? $ketqua['address'] : '' ?>" name="address">
                            </div>
                        </div>
                        <div class="delivery-content-left-button roo">
                            <a href="cart.php"><span>&#171;</span>
                                <p style="font-size: 13px;">Quay lại giỏ hàng</p>
                            </a>
                            <button type="submit" name="dathang">
                                <p style="font-weight:bold;text-transform:uppercase;">Thanh toán và giao hàng</p>
                            </button>
                        </div>
                    </div>
                    <div class="delivery-content-right">
                        <?php if (!empty($_SESSION['cart'])) { ?>
                            <table>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Giảm giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                                <?php foreach ($cart as $id => $each) : ?>
                                    <tr>
                                        <td><?= $each['name'] ?></td>
                                        <td>-30%</td>
                                        <td><?= $each['quantity'] ?></td>
                                        <?php $result = $each['price'] * $each['quantity'];
                                        $sum += $result; ?>
                                        <td><?= number_format($result, 0, ',', '.') ?> đ</td>
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <td style="font-weight: bold;" colspan="3">Tổng</td>
                                    <td style="font-weight: bold;"><?= number_format($sum, 0, ',', '.') ?> đ</td>
                                </tr>
                            </table>
                        <?php } ?>
                        <div class="payment-content-left">
                            <div class="payment-content-left-method-delivery">
                                <p style="font-weight: bold;">Phương thức giao hàng</p>
                                <div class="payment-content-left-method-delivery-input">
                                    <input type="radio">
                                    <label for="">Giao hàng chuyển phát nhanh</label>
                                </div>
                            </div>
                            <div class="payment-content-left-method-payment">
                                <p style="font-weight: bold;">Phương thức Thanh toán</p>
                                <p>Mọi giao dịch đều được bảo mật và mã hóa.Thông tin thẻ tín dụng sẽ không bao giờ được lưu lại</p>
                                <div class="payment-content-left-methodde-payment-item">
                                    <input checked name="method-payment" type="radio">
                                    <label for="">Thanh toán khi nhận hàng</label>
                                </div>
                                <div class="payment-content-left-method-payment-item">
                                    <input name="method-payment" type="radio">
                                    <label for="">Thanh toán bằng thẻ ứng dụng(OnePay)</label>
                                </div>
                                <div class="payment-content-left-method-payment-item-img">
                                    <img src="image/visa.jpg" alt="">
                                    <img src="image/visa1.jpg" alt="">
                                </div>
                                <div class="payment-content-left-methodde-payment-item">
                                    <input name="method-payment" type="radio">
                                    <label for="">Thanh toán bằng thẻ ATM(OnePay)</label>
                                </div>
                                <div class="payment-content-left-methodde-payment-item-img">
                                    <img src="image/visa2.jpg" alt="">
                                    <img src="image/visa3.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </section>



    <!-- -------------------------------------------------------------- -->
    <?php require_once("footer.php") ?>

</body>

</html>