<?php
require_once('../db_config/db_connect.php');

//Phan trang
$sql_qty = 'select count(id) as qty from account';
$result_qty = mysqli_query($conn, $sql_qty);
$row = mysqli_fetch_array($result_qty);
$total_Product = $row['qty']; //Tong so san pham
$product_perPage = 5; //So san pham tren 1 trang
$total_Page = ceil($total_Product / $product_perPage); //tong so trang
if (isset($_GET['pg']))
    $current_Page = $_GET['pg']; //Trang hien tai
$index = ($current_Page - 1) * $product_perPage; //Vi tri bat dau lay trong $sql LIMIT

$sql = 'Select * from account limit ' . $index . ', ' . $product_perPage . '';
$result = mysqli_query($conn, $sql);

//tim kiem
if (isset($_GET['submit']) && !empty($_GET['s'])) {
    $s = $_GET['s'];
    $sql_qty = 'Select count(id) as qty from account where name like "%' . $s . '%"';
    $result_qty = mysqli_query($conn, $sql_qty);
    $row = mysqli_fetch_array($result_qty);
    $total_Product = $row['qty']; //Tong so san pham
    $product_perPage = 6; //So san pham tren 1 trang
    $total_Page = ceil($total_Product / $product_perPage); //tong so trang
    if (isset($_GET['pg']))
        $current_Page = $_GET['pg']; //Trang hien tai
    $index = ($current_Page - 1) * $product_perPage; //Vi tri bat dau lay trong $sql LIMIT

    $sql = 'Select * from account WHERE name like "%' . $s . '%" OR username like "%' . $s . '%" 
        limit ' . $index . ', ' . $product_perPage . '';
    $result = mysqli_query($conn, $sql);
}
?>

<div class="container detail">
    <div class="top">
        <h4 class="text-color"><i class="fa fa-user"></i> QUẢN LÝ TÀI KHOẢN</h4>
        <form action="" method="get">
            <input type="text" name="page" value="a" hidden>
            <input type="text" name="pg" value="1" hidden>
            <div class="input-group">
                <input type="text" name="s" class="form-control" placeholder="Tìm kiếm tài khoản" value="<?php if (isset($s))
                    echo $s ?>">
                    <div class="input-group-append">
                        <button class="btn btn-color" name="submit" type="submit">
                            <i class="fa fa-search search_icon"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <table class="table">
            <thead class="bg-color text-white">
                <tr>
                    <th>STT</th>
                    <th>Tên tài khoản</th>
                    <th>Ảnh đại diện</th>
                    <th>Tên đăng nhập</th>
                    <th>Mật khẩu</th>
                    <th>Điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Vai trò</th>
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
                        <td>' . $row['name'] . '</td>
                        <td><img class="avt_user" src="../img/' . $row['image'] . '"/></td>
                        <td>' . $row['username'] . '</td>
                        <td>' . $row['password'] . '</td>
                        <td>' . $row['phone'] . '</td>
                        <td>' . $row['address'] . '</td>';
                    if ($row['admin'] == 1)
                        echo '<td>Quản trị</td>';
                    else
                        echo '<td>Khách hàng</td>';
                    echo '
                        <td>
                            <a class="btn btn-sm btn-secondary" href="index.php?page=au&id=' . $row['id'] . '">Cập nhật</a>';
                    if ($row['admin'] != 1)
                        echo '<a class="btn btn-sm btn-danger ml-1" href="account/delete.php?id=' . $row['id'] . '">Xóa</a>
                        </td>
                    </tr>';
                }
                ?>
        </tbody>
    </table>
</div>

<ul class="pagination mx-auto" style="width: 30%">
    <?php
    if (!empty($s)) {
        //Gan nut truoc
        if ($_GET['pg'] > 1)
            echo '        
                    <li class="page-item">
                        <a class="page-link" href="?page=a&pg=' . ($_GET['pg'] - 1) . '&s=' . $s . '&submit=">Trước</a>
                    </li>';
        else
            echo '        
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Trước</a>
                    </li>';
        //Gan cac trang
        for ($i = 1; $i <= $total_Page; $i++) {
            if ($i == $_GET['pg'])
                echo '        
                    <li class="page-item active">
                        <a class="page-link" href="?page=a&pg=' . $i . '&s=' . $s . '&submit=">' . $i . '<span class="sr-only">(current)</span></a>
                    </li>';
            else
                echo '<li class="page-item"><a class="page-link" href="?page=a&pg=' . $i . '&s=' . $s . '&submit=">' . $i . '</a></li>';
        }
        //Gan nut sau
        if ($_GET['pg'] < $total_Page)
            echo '        
                    <li class="page-item">
                        <a class="page-link" href="?page=a&pg=' . ($_GET['pg'] + 1) . '&s=' . $s . '&submit=">Sau</a>
                    </li>';
        else
            echo '        
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Sau</a>
                    </li>';
    } else {
        //Gan nut truoc
        if ($_GET['pg'] > 1)
            echo '        
                    <li class="page-item">
                        <a class="page-link" href="?page=a&pg=' . ($_GET['pg'] - 1) . '">Trước</a>
                    </li>';
        else
            echo '        
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Trước</a>
                    </li>';
        //Gan cac trang
        for ($i = 1; $i <= $total_Page; $i++) {
            if ($i == $_GET['pg'])
                echo '        
                    <li class="page-item active">
                        <a class="page-link" href="?page=a&pg=' . $i . '">' . $i . '<span class="sr-only">(current)</span></a>
                    </li>';
            else
                echo '<li class="page-item"><a class="page-link" href="?page=a&pg=' . $i . '">' . $i . '</a></li>';
        }
        //Gan nut sau
        if ($_GET['pg'] < $total_Page)
            echo '        
                    <li class="page-item">
                        <a class="page-link" href="?page=a&pg=' . ($_GET['pg'] + 1) . '">Sau</a>
                    </li>';
        else
            echo '        
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Sau</a>
                    </li>';
    }
    ?>
</ul>

<?php
mysqli_free_result($result);
mysqli_close($conn);
?>