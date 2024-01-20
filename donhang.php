<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tra Cứu Đơn Hàng</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            text-align: center;
        }

        input {
            padding: 10px;
            margin: 10px;
            width: 60%;
        }

        button {
            padding: 10px 20px;
            background-color: #ff4500;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_bankinh";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST["phone"];

    $sql = "SELECT account.phone, bill.date_order, bill.total
            FROM account
            INNER JOIN bill ON account.id = bill.account_id
            WHERE account.phone = '$phone'";

    $result = $conn->query($sql);

    if ($result !== false) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='container'>";
                echo "<h2>Thông tin đơn hàng:</h2>";
                echo "<p><strong>Số điện thoại:</strong> " . $row["phone"] . "</p>";
                echo "<p><strong>Ngày Đặt Hàng:</strong> " . $row["date_order"] . "</p>";
                echo "<p><strong>Tổng Tiền:</strong> $" . $row["total"] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<div class='container'>";
            echo "<p>Không tìm thấy đơn hàng</p>";
            echo "</div>";
        }
    } else {
        echo "<div class='container'>";
        echo "<p>Đã xảy ra lỗi trong câu truy vấn</p>";
        echo "</div>";
    }
}

// Đóng kết nối
$conn->close();
?>

<div class="container">
    <h2>Tra Cứu Đơn Hàng</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="phone" placeholder="Nhập số điện thoại..." required>
        <button type="submit">Tra cứu</button>
    </form>
</div>

</body>
</html>