<?php
// Thông tin kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_bankinh";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Số điện thoại cần tra cứu
$phone = $_POST['phone']; // Giả sử số điện thoại được gửi từ form

// Truy vấn SQL để tra cứu đơn hàng
$sql = "SELECT account.phone, bills.date_order, bills.total
        FROM account
        INNER JOIN bills ON account.account_id = bills.account_id
        WHERE account.phone = '$phone'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Hiển thị kết quả
    while ($row = $result->fetch_assoc()) {
        echo "Số điện thoại: " . $row["phone"] . "<br>";
        echo "Ngày đặt hàng: " . $row["date_order"] . "<br>";
        echo "Tổng cộng: " . $row["total"] . "<br>";
        echo "--------------------------<br>";
    }
} else {
    echo "Không tìm thấy đơn hàng nào cho số điện thoại này.";
}

// Đóng kết nối
$conn->close();
?>