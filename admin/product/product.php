<?php 
    require_once('../db_config/db_connect.php');

    //Phan trang
    $sql_qty = 'select count(id) as qty from glasses';
    $result_qty = mysqli_query($conn,$sql_qty);
    $row = mysqli_fetch_array($result_qty);
    $total_Product = $row['qty']; //Tong so san pham
    $product_perPage = 6;//So san pham tren 1 trang
    $total_Page = ceil($total_Product / $product_perPage);//tong so trang
    if(isset($_GET['pg']))
        $current_Page = $_GET['pg'];//Trang hien tai
    $index = ($current_Page - 1)*$product_perPage; //Vi tri bat dau lay trong $sql LIMIT
    
    $sql = 'Select glasses.id as gid, glasses.name as gname, glasses.image as gimage, normal_price, sale_price, brand.image as bimage
                from glasses join brand
                on glasses.id_brand = brand.id limit '.$index.', '.$product_perPage.'';
    $result = mysqli_query($conn,$sql);

    //tim kiem
    if(isset($_GET['submit']) && !empty($_GET['s']))
    {   
        $s = $_GET['s'];
        $sql_qty = 'Select count(id) as qty from glasses where name like "%'.$s.'%"';
        $result_qty = mysqli_query($conn,$sql_qty);
        $row = mysqli_fetch_array($result_qty);
        $total_Product = $row['qty']; //Tong so san pham
        $product_perPage = 6;//So san pham tren 1 trang
        $total_Page = ceil($total_Product / $product_perPage);//tong so trang
        if(isset($_GET['pg']))
            $current_Page = $_GET['pg'];//Trang hien tai
        $index = ($current_Page - 1)*$product_perPage; //Vi tri bat dau lay trong $sql LIMIT

        $sql = 'Select glasses.id as gid, glasses.name as gname, glasses.image as gimage, normal_price, sale_price, brand.image as bimage
        from glasses join brand on glasses.id_brand = brand.id 
        where glasses.name like "%'.$s.'%" or brand.name like "%'.$s.'%" limit '.$index.', '.$product_perPage.'';
        $result = mysqli_query($conn,$sql);
    }

    //Xoa
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql_del = $sql = 'delete from glasses where id='.$id;
        mysqli_query($conn,$sql_del);
    }
?>

<div class="container detail">
    <div class="top">
        <h4 class="text-color"><i class="fas fa-glasses"></i>QUẢN LÝ SẢN PHẨM</h4>
        <form action="" method="get">
            <input type="text" name="page" value="p" hidden>
            <input type="text" name="pg" value="1" hidden>
            <div class="input-group">
                <input type="text" name="s" class="form-control" placeholder="Tìm kiếm sản phẩm" value="<?php if(isset($search)) echo $search ?>">
                <div class="input-group-append">
                    <button class="btn btn-color" name="submit" type="submit">
                    <i class="fa fa-search search_icon"></i>
                    </button>
                </div>
            </div>
        </form>
        <a class="btn btn-color" href="index.php?page=pa">Thêm mới</a>
    </div>

    <table class="table table-hover">
        <thead class="bg-color text-white">
            <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Thương hiệu</th>
                <th>Đơn giá</th>
                <th>Giá khuyến mãi</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i = 1;
                while($row = mysqli_fetch_array($result))
                {
                    if(empty($row['sale_price']))
                        $sale_price = "";
                    else $sale_price = number_format($row['sale_price'])." VND";
                echo '
                <tr>
                    <td>'.$i++.'</td>
                    <td>'.$row['gname'].'</td>
                    <td><img src="../img/'.$row['gimage'].'"/></td>
                    <td><img src="../img/'.$row['bimage'].'"/></td>
                    <td>'.number_format($row['normal_price']).' VND</td>
                    <td class="text-danger">'.$sale_price.'</td>
                    <td>
                        <a class="btn btn-sm btn-secondary" href="index.php?page=pu&id='.$row['gid'].'">Cập nhật</a>
                        <a class="btn btn-sm btn-danger" href="product/delete.php?id='.$row['gid'].'">Xóa</a>
                    </td>
                </tr>
                ';
                }
            ?>
        </tbody>
    </table>
    
    <!--Phan trang-->
    <ul class="pagination mx-auto" style="width: 50%">
        <?php
            if(!empty($s))
            {
                //Gan nut truoc
                if($_GET['pg']>1)
                    echo '        
                    <li class="page-item">
                        <a class="page-link" href="?page=p&pg='.($_GET['pg']-1).'&s='.$s.'&submit=">Trước</a>
                    </li>';
                else echo '        
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Trước</a>
                    </li>';
                //Gan cac trang
                for($i=1;$i<=$total_Page;$i++)
                {   
                    if($i==$_GET['pg'])
                    echo '        
                    <li class="page-item active">
                        <a class="page-link" href="?page=p&pg='.$i.'&s='.$s.'&submit=">'.$i.'<span class="sr-only">(current)</span></a>
                    </li>';
                    else echo '<li class="page-item"><a class="page-link" href="?page=p&pg='.$i.'&s='.$s.'&submit=">'.$i.'</a></li>';
                }
                //Gan nut sau
                if($_GET['pg']<$total_Page)
                    echo '        
                    <li class="page-item">
                        <a class="page-link" href="?page=p&pg='.($_GET['pg']+1).'&s='.$s.'&submit=">Sau</a>
                    </li>';
                else echo '        
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Sau</a>
                    </li>';
            }
            else
            {
                //Gan nut truoc
                if($_GET['pg']>1)
                    echo '        
                    <li class="page-item">
                        <a class="page-link" href="?page=p&pg='.($_GET['pg']-1).'">Trước</a>
                    </li>';
                else echo '        
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Trước</a>
                    </li>';
                //Gan cac trang
                for($i=1;$i<=$total_Page;$i++)
                {   
                    if($i==$_GET['pg'])
                    echo '        
                    <li class="page-item active">
                        <a class="page-link" href="?page=p&pg='.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                    </li>';
                    else echo '<li class="page-item"><a class="page-link" href="?page=p&pg='.$i.'">'.$i.'</a></li>';
                }
                //Gan nut sau
                if($_GET['pg']<$total_Page)
                    echo '        
                    <li class="page-item">
                        <a class="page-link" href="?page=p&pg='.($_GET['pg']+1).'">Sau</a>
                    </li>';
                else echo '        
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Sau</a>
                    </li>';
            } 
        ?>
    </ul>

</div>

<?php 
    mysqli_free_result($result);
    mysqli_close($conn);
?>