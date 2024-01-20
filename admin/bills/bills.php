<?php
require_once('../db_config/db_connect.php');

//Phan trang
$sql_qty = 'select count(id) as qty from bills';
$result_qty = mysqli_query($conn, $sql_qty);
$row = mysqli_fetch_array($result_qty);
$total_Product = $row['qty']; //Tong so san pham
$product_perPage = 5; //So san pham tren 1 trang
$total_Page = ceil($total_Product / $product_perPage); //tong so trang
if (isset($_GET['pg']))
    $current_Page = $_GET['pg']; //Trang hien tai
$index = ($current_Page - 1) * $product_perPage; //Vi tri bat dau lay trong $sql LIMIT

$sql = 'Select * from account join bills 
            on account.id = bills.id_customer order by status,bills.id desc limit ' . $index . ', ' . $product_perPage . '';
$result = mysqli_query($conn, $sql);
?>

<div class="container detail">
    <div class="top">
        <h4 class="text-color"><i class="fas fa-box-open"></i>QUẢN LÝ ĐƠN HÀNG</h4>

    </div>

    <table class="table table-hover">
        <thead class="bg-color text-white">
            <tr>
                <th>STT</th>
                <th>Ngày đặt</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            while ($row = mysqli_fetch_array($result)) {
                echo '
                    <tr>
                        <td>' . $i++ . '</td>
                        <td>' . date('d/m/Y', strtotime($row['date_order'])) . '</td>
                        <td>' . $row['name'] . '</td>
                        <td>' . number_format($row['total']) . ' VND</td>';
                if ($row['status'] == 1)
                    echo '<td class="text-success">Đã duyệt</td>';
                else echo '<td class="text-danger">Chưa duyệt</td>';
                echo '
                        <td>
                            <a class="btn btn-sm btn-secondary" href="index.php?page=od&id=' . $row['id'] . '&pg=1">Xem</a>';
                if ($row['status'] == 1)
                    echo '<a class="btn btn-sm btn-dark ml-1" href="bills/checkstt.php?id=' . $row['id'] . '&stt=1">Hủy</a>';
                else echo '<a class="btn btn-sm btn-color ml-1" href="bills/checkstt.php?id=' . $row['id'] . '&stt=0">Duyệt</a>';
                echo '<a class="btn btn-sm btn-danger ml-1" href="bills/delete.php?id=' . $row['id'] . '">Xóa</a>
                        </td>
                    </tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<ul class="pagination mx-auto" style="width: 30%">
    <?php
    //Gan nut truoc
    if ($_GET['pg'] > 1)
        echo '        
                <li class="page-item">
                    <a class="page-link" href="?page=o&pg=' . ($_GET['pg'] - 1) . '">Trước</a>
                </li>';
    else echo '        
                <li class="page-item disabled">
                    <a class="page-link" href="#">Trước</a>
                </li>';
    //Gan cac trang
    for ($i = 1; $i <= $total_Page; $i++) {
        if ($i == $_GET['pg'])
            echo '        
                <li class="page-item active">
                    <a class="page-link" href="?page=o&pg=' . $i . '">' . $i . '<span class="sr-only">(current)</span></a>
                </li>';
        else echo '<li class="page-item"><a class="page-link" href="?page=o&pg=' . $i . '">' . $i . '</a></li>';
    }
    //Gan nut sau
    if ($_GET['pg'] < $total_Page)
        echo '        
                <li class="page-item">
                    <a class="page-link" href="?page=o&pg=' . ($_GET['pg'] + 1) . '">Sau</a>
                </li>';
    else echo '        
                <li class="page-item disabled">
                    <a class="page-link" href="#">Sau</a>
                </li>';
    ?>
</ul>

<?php
mysqli_free_result($result);
mysqli_close($conn);
?>