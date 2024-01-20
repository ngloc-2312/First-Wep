<?php
require_once('../db_config/db_connect.php');

if (isset($_GET['id']))
  $id = $_GET['id'];

$sql_product = 'Select glasses.name as gname, glasses.image as gimage, normal_price, sale_price, brand.id as bid
                    from glasses join brand
                    on glasses.id_brand = brand.id 
                    where glasses.id = ' . $id;
$result_product = mysqli_query($conn, $sql_product);
$row = mysqli_fetch_array($result_product);
$name = $row['gname'];
$brand = $row['bid'];
$normal_price = $row['normal_price'];
$sale_price = $row['sale_price'];
$img = $row['gimage'];

$sql_brand = 'select * from brand';
$result_brand = mysqli_query($conn, $sql_brand);

$errName = $errBrand = $errNormal_price = $errSale_price = $errImg = "";
if (isset($_POST['submit'])) {
  //Kiem Tra name
  if (isset($_POST['name'])) {
    $name = $_POST['name'];
    if ($name == "")
      $errName = "Chưa nhập tên sản phẩm";
    elseif (!preg_match('/[a-zA-Z0-9]/', $name))
      $errName = "Dữ liệu không hợp lệ";
  }
  //Kiem Tra brand
  if (isset($_POST['brand'])) {
    $brand = $_POST['brand'];
    if ($brand == "")
      $errBrand = "Chưa chọn thương hiệu";
  }
  //Kiem Tra normal_price
  if (isset($_POST['normal_price'])) {
    $normal_price = $_POST['normal_price'];
    if ($normal_price == "")
      $errNormal_price = "Chưa nhập đơn giá";
    elseif (!is_numeric($normal_price))
      $errNormal_price = "Chỉ cho phép nhập số";
    if (isset($sale_price))
      if ($sale_price == "" && $normal_price < $sale_price)
        $errNormal_price = "Đơn giá phải lớn hơn giá khuyến mãi!";
  }
  //Kiem Tra sale_price
  if (isset($_POST['sale_price'])) {
    $sale_price = $_POST['sale_price'];
    if (!is_numeric($sale_price) && $sale_price != "")
      $errSale_price = "Chỉ cho phép nhập số";
    if ($normal_price == "" && $sale_price < $normal_price)
      $errSale_price = "giá khuyến mãi phải nhỏ hơn đơn giá!";
  }
  //update
  if (empty($errName) && empty($errBrand) && empty($errNormal_price) && empty($errSale_price)) {
    if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
      // Xử lý và lưu ảnh mới vào thư mục
      $img = time() . '_' . $img;
      move_uploaded_file($_FILES['img']['tmp_name'], '../img/' . $img);
      // Xóa ảnh cũ nếu tồn tại
      $sql = "select * from glasses where id = '$id'";
      $query = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_array($query)) {
        // Kiểm tra nếu có ảnh cũ, thì xóa ảnh cũ trước khi cập nhật ảnh mới
        if (!empty($row['image'])) {
          unlink('../img/' . $row['image']);
        }
      }
      $sql = 'UPDATE glasses
      SET name = "' . $name . '",
      id_brand = "' . $brand . '",
      normal_price = "' . $normal_price . '",
      sale_price = "' . $sale_price . '",
      image = "' . $img . '"
      WHERE id =' . $id;
    } else {
      $sql = 'UPDATE glasses
        SET name = "' . $name . '",
        id_brand = "' . $brand . '",
        normal_price = "' . $normal_price . '",
        sale_price = "' . $sale_price . '"
        WHERE id =' . $id;
    }
    mysqli_query($conn, $sql);
    echo '<script type="text/javascript">swal("Cập nhật thành công!", "Sản phẩm: ' . $name . '", "success");</script>';
  }
}

?>
<div class="mt-4">
  <h3 class=" text-center mb-4">- Cập nhật sản phẩm -</h3>
  <form action="" method="post" enctype="multipart/form-data" style="width:50%;margin-left:20%">

    <div class="form-group row">
      <label class="col-sm-4 col-form-label">Tên sản phẩm: </label>
      <input type="text" name="name" class="form-control col-sm-8" value="<?php if (isset($name)) echo $name ?>">
    </div>
    <?php
    if (!empty($errName))
      echo '
            <div class="form-group row">
              <p class="text-danger col-sm-4"></p>
              <p class="text-danger col-sm-8">' . $errName . '</p>
            </div>
            ';
    ?>

    <div class="form-group row">
      <label class="col-sm-4 col-form-label">Thương hiệu: </label>
      <select name="brand" class="col-sm-8 form-control">
        <option value="">Chọn thương hiệu</option>
        <?php
        while ($row = mysqli_fetch_array($result_brand)) {
          echo '<option value="' . $row['id'] . '"';
          if (isset($brand) && $brand == $row['id']) echo ' selected';
          echo '>' . $row['name'] . '</option>';
        }
        ?>
      </select>
    </div>
    <?php
    if (!empty($errBrand))
      echo '
            <div class="form-group row">
              <p class="text-danger col-sm-4"></p>
              <p class="text-danger col-sm-8">' . $errBrand . '</p>
            </div>
            ';
    ?>

    <div class="form-group row">
      <label class="col-sm-4 col-form-label">Đơn giá: </label>
      <input type="text" name="normal_price" class="form-control col-sm-7" value="<?php if (isset($normal_price)) echo $normal_price ?>">
      <label class="col-sm-1 col-form-label"> VND</label>
    </div>
    <?php
    if (!empty($errNormal_price))
      echo '
            <div class="form-group row">
              <p class="text-danger col-sm-4"></p>
              <p class="text-danger col-sm-8">' . $errNormal_price . '</p>
            </div>
            ';
    ?>

    <div class="form-group row">
      <label class="col-sm-4 col-form-label">Giá khuyến mãi: </label>
      <input type="text" name="sale_price" class="form-control col-sm-7" value="<?php if (isset($sale_price)) echo $sale_price ?>">
      <label class="col-sm-1 col-form-label"> VND</label>
    </div>
    <?php
    if (!empty($errSale_price))
      echo '
            <div class="form-group row">
              <p class="text-danger col-sm-4"></p>
              <p class="text-danger col-sm-8">' . $errSale_price . '</p>
            </div>
            ';
    ?>

    <div class="form-group row">
      <label class="col-sm-4 col-form-label">Ảnh sản phẩm: </label>
      <div class="custom-file col-sm-8">
        <input type="file" class="custom-file-input" name="img" id="img" accept="image/*" onchange="showPreview(event);">
        <label class="custom-file-label" for="inputGroupFile01"><?php if (isset($img)) echo $img;
                                                                else echo "Chọn ảnh sản phẩm"; ?></label>
      </div>
      <!--script de hien thi ten anh-->
      <script>
        $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
      </script>

    </div>
    <?php
    if (!empty($errImg))
      echo '
            <div class="form-group row">
              <p class="text-danger col-sm-4"></p>
              <p class="text-danger col-sm-8">' . $errImg . '</p>
            </div>
            ';
    ?>
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-8"><img id="img_prv" <?php if (isset($img)) echo 'src="../img/' . $img . '"' ?>></div>
    </div>

    <div class="form-group row">
      <p class="col-sm-4"></p>
      <div class="col-sm-8 pl-0 pt-3">
        <input class="btn btn-color" type="submit" name="submit" value="Cập nhật">
        <button class="btn btn-secondary" type="reset">Đặt lại</button>
        <a href="index.php?page=p&pg=1" class="btn btn-danger">Trở Về</a>
      </div>
    </div>

  </form>

</div>
<?php
mysqli_free_result($result_brand);
mysqli_close($conn);
?>