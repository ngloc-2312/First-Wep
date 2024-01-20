<?php
require_once('../db_config/db_connect.php');

//Phan trang
$sql_qty = 'select count(id) as qty from brand';
$result_qty = mysqli_query($conn, $sql_qty);
$row = mysqli_fetch_array($result_qty);
$total_Product = $row['qty']; //Tong so san pham
$product_perPage = 5; //So san pham tren 1 trang
$total_Page = ceil($total_Product / $product_perPage); //tong so trang
if (isset($_GET['pg']))
    $current_Page = $_GET['pg']; //Trang hien tai
$index = ($current_Page - 1) * $product_perPage; //Vi tri bat dau lay trong $sql LIMIT

$sql = 'SELECT * FROM brand limit ' . $index . ', ' . $product_perPage . '';
$result = mysqli_query($conn, $sql);

//tim kiem
if (isset($_GET['submit']) && !empty($_GET['s'])) {
    $s = $_GET['s'];
    $sql_qty = 'Select count(id) as qty from brand where name like "%' . $s . '%"';
    $result_qty = mysqli_query($conn, $sql_qty);
    $row = mysqli_fetch_array($result_qty);
    $total_Product = $row['qty']; //Tong so san pham
    $product_perPage = 6; //So san pham tren 1 trang
    $total_Page = ceil($total_Product / $product_perPage); //tong so trang
    if (isset($_GET['pg']))
        $current_Page = $_GET['pg']; //Trang hien tai
    $index = ($current_Page - 1) * $product_perPage; //Vi tri bat dau lay trong $sql LIMIT

    $sql = 'SELECT * FROM brand WHERE name like "%' . $s . '%" 
                limit ' . $index . ', ' . $product_perPage . '';
    $result = mysqli_query($conn, $sql);
}
?>

<div class="container detail">
    <div class="top">
        <h4 class="text-color"><i class="fas fa-copyright"></i> QUẢN LÝ THƯƠNG HIỆU</h4>
        <form action="" method="get">
            <input type="text" name="page" value="b" hidden>
            <input type="text" name="pg" value="1" hidden>
            <div class="input-group">
                <input type="text" name="s" class="form-control" placeholder="Tìm kiếm thương hiệu" value="<?php if (isset($search)) echo $search ?>">
                <div class="input-group-append">
                    <button class="btn btn-color" name="submit" type="submit">
                        <i class="fa fa-search search_icon"></i>
                    </button>
                </div>
            </div>
        </form>
        <a class="btn btn-color" href="index.php?page=ba">Thêm mới</a>
    </div>

    <table class="table table-hover">
        <thead class="bg-color text-white">
            <tr>
                <th>STT</th>
                <th>Thương hiệu</th>
                <th>Logo</th>
                <th>Xuất xứ</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $STT = 1;
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?= $STT++ ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><img src="../img/<?= $row['image'] ?>" /></td>
                    <td><?= $row['country'] ?></td>
                    <td>
                        <a class="btn btn-sm btn-secondary" href="index.php?page=bu&id=<?= $row['id'] ?>">Cập nhật</a>
                        <a class="btn btn-sm btn-danger" href="brand/delete.php?id=<?= $row['id'] ?>">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
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
                    <a class="page-link" href="?page=b&pg=' . ($_GET['pg'] - 1) . '&s=' . $s . '&submit=">Trước</a>
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
                    <a class="page-link" href="?page=b&pg=' . $i . '&s=' . $s . '&submit=">' . $i . '<span class="sr-only">(current)</span></a>
                </li>';
            else echo '<li class="page-item"><a class="page-link" href="?page=b&pg=' . $i . '&s=' . $s . '&submit=">' . $i . '</a></li>';
        }
        //Gan nut sau
        if ($_GET['pg'] < $total_Page)
            echo '        
                    <li class="page-item">
                        <a class="page-link" href="?page=b&pg=' . ($_GET['pg'] + 1) . '&s=' . $s . '&submit=">Sau</a>
                    </li>';
        else echo '        
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Sau</a>
                    </li>';
    } else {
        //Gan nut truoc
        if ($_GET['pg'] > 1)
            echo '        
                    <li class="page-item">
                        <a class="page-link" href="?page=b&pg=' . ($_GET['pg'] - 1) . '">Trước</a>
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
                        <a class="page-link" href="?page=b&pg=' . $i . '">' . $i . '<span class="sr-only">(current)</span></a>
                    </li>';
            else echo '<li class="page-item"><a class="page-link" href="?page=b&pg=' . $i . '">' . $i . '</a></li>';
        }
        //Gan nut sau
        if ($_GET['pg'] < $total_Page)
            echo '        
                    <li class="page-item">
                        <a class="page-link" href="?page=b&pg=' . ($_GET['pg'] + 1) . '">Sau</a>
                    </li>';
        else echo '        
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