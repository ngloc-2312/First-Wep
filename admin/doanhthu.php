<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_bankinh";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    
}
// Truy vấn dữ liệu theo ngày, tháng và năm
$query = "SELECT DATE_FORMAT(date_order, '%Y-%m-%d') AS date, SUM(total) AS revenue FROM bills GROUP BY DATE_FORMAT(date_order, '%Y-%m-%d')";

$result = $conn->query($query);

// Lưu dữ liệu vào mảng
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Chuyển đổi mảng dữ liệu sang chuỗi JSON
$jsonData = json_encode($data);

// Đóng kết nối
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Biểu đồ doanh thu</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="revenueChart"></canvas>

    <script>
        // Phân tích dữ liệu từ chuỗi JSON
        var data = <?php echo $jsonData; ?>;

        // Tạo mảng các ngày, tháng, năm
        var labels = [];
        var revenueData = [];

        data.forEach(function(item) {
            labels.push(item.date);
            revenueData.push(item.revenue);
        });

        // Tạo biểu đồ
        var ctx = document.getElementById('revenueChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu',
                    data: revenueData,
                    backgroundColor: 'rgba(0, 123, 255, 0.5)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Ngày'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Doanhthu (đơn vị)'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>