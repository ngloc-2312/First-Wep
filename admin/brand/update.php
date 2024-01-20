<?php
require_once('../db_config/db_connect.php');

if (isset($_GET['id']))
  $id = $_GET['id'];

$sql_brand = 'SELECT * FROM brand WHERE id = ' . $id;
$result_brand = mysqli_query($conn, $sql_brand);
$row = mysqli_fetch_array($result_brand);

$name = $row['name'];
$country = $row['country'];
$img = $row['image'];

$errName = $errCountry = $errImg = "";
if (isset($_POST['submit'])) {
  //Kiem Tra name
  if (isset($_POST['name'])) {
    $name = $_POST['name'];
    if ($name == "")
      $errName = "Chưa nhập tên thương hiệu";
    elseif (!is_string($name))
      $errName = "Dữ liệu không hợp lệ";
  }
  //Kiem Tra country
  if (isset($_POST['country'])) {
    $country = $_POST['country'];
    if ($country == "")
      $errCountry = "Chưa nhập xuất xứ";
    elseif (!is_string($country))
      $errCountry = "Dữ liệu không hợp lệ";
  }
  // //Kiem Tra img
  // if (isset($_FILES['img'])) {
  //   $img = $_FILES['img']['name'];
  //   $target_dir = "../img/";
  //   $target_file = $target_dir . basename($img);
  //   move_uploaded_file($_FILES['img']['tmp_name'], $target_file);
  // }


  if (empty($errName) && empty($errCountry)) {
    if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
      // Xử lý và lưu ảnh mới vào thư mục
      $img = time() . '_' . $img;
      move_uploaded_file($_FILES['img']['tmp_name'], '../img/' . $img);
      // Xóa ảnh cũ nếu tồn tại
      $sql = "select * from brand where id = '$id'";
      $query = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_array($query)) {
        // Kiểm tra nếu có ảnh cũ, thì xóa ảnh cũ trước khi cập nhật ảnh mới
        if (!empty($row['image'])) {
          unlink('../img/' . $row['image']);
        }
      }
      $sql = "update brand set name = '$name', image = '$img', country = '$country' where id = '$id'";
    } else {
      $sql = "update brand set name = '$name', country = '$country' where id = '$id'";
    }

    // die($sql);
    $result = mysqli_query($conn, $sql);
    echo '<script type="text/javascript">swal("Cập nhật thành công!", "Thương hiệu: ' . $name . '", "success");</script>';
  }
}

?>
<div class="mt-4">
  <h3 class=" text-center mb-4">- Cập nhật thương hiệu -</h3>

  <form action="" method="post" enctype="multipart/form-data" style="width:50%;margin-left:20%">

    <div class="form-group row">
      <label class="col-sm-4 col-form-label">Tên thương hiệu: </label>
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
      <label class="col-sm-4 col-form-label">Xuất xứ: </label>
      <input type="text" name="country" class="form-control col-sm-8" value="<?php if (isset($country)) echo $country ?>">
    </div>
    <?php
    if (!empty($errCountry))
      echo '
            <div class="form-group row">
              <p class="text-danger col-sm-4"></p>
              <p class="text-danger col-sm-8">' . $errCountry . '</p>
            </div>
            ';
    ?>

    <div class="form-group row">
      <label class="col-sm-4 col-form-label">Logo thương hiệu: </label>
      <div class="custom-file col-sm-8">
        <input type="file" class="custom-file-input" name="img" id="img" accept="image/*" onchange="showPreview(event);">
        <label class="custom-file-label" for="inputGroupFile01"><?php if (isset($img)) echo $img;
                                                                else echo "Chọn ảnh thương hiệu"; ?></label>
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
        <a href="index.php?page=b&pg=1" class="btn btn-danger">Trở Về</a>
      </div>
    </div>

  </form>

</div>
<?php

?>