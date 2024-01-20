<?php 
  require_once('../db_config/db_connect.php');
  $errName = $errCountry = $errImg = "";
  if(isset($_POST['submit']))
  {
    //Kiem Tra name
    if(isset($_POST['name']))
    {
      $name = $_POST['name'];
      if($name =="")
        $errName = "Chưa nhập tên thương hiệu";
      elseif(!preg_match('/[a-zA-Z ]/', $name))
        $errName = "Dữ liệu không hợp lệ";
    }
    //Kiem Tra country
    if(isset($_POST['country']))
    {
      $country = $_POST['country'];
      if($country =="")
        $errCountry = "Chưa nhập xuất xứ";
      elseif(!preg_match('/[a-zA-Z ]/', $country))
        $errCountry = "Dữ liệu không hợp lệ";
    }
    //Kiem Tra img
    if(isset($_FILES['img']))
    {
        $img = $_FILES['img']['name'];
        $target_dir = "../img/";
        $target_file = $target_dir . basename($img);
        move_uploaded_file($_FILES['img']['tmp_name'],$target_file);
    }
    //add new
    if(empty($errName) && empty($errCountry))
    {
      if(empty($img)) $img = "noimg.png";
      $sql = 'insert into brand(name,image,country)
              values("'.$name.'","'.$img.'","'.$country.'")';
      $result = mysqli_query($conn, $sql);
      echo '<script type="text/javascript">swal("Thêm thành công!", "Thương hiệu mới: '.$name.'", "success");</script>';
    }
  }

?>
<div class="mt-4">
    <h3 class=" text-center mb-4">- Thêm thương hiệu -</h3>

    <form action="" method="post" enctype="multipart/form-data" style="width:50%;margin-left:20%">
    
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Tên thương hiệu: </label>
          <input type="text" name="name" class="form-control col-sm-8" value="<?php if(isset($name)) echo $name ?>">
        </div>
        <?php 
          if(!empty($errName))
            echo '
            <div class="form-group row">
              <p class="text-danger col-sm-4"></p>
              <p class="text-danger col-sm-8">'.$errName.'</p>
            </div>
            ';
        ?>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Xuất xứ: </label>
          <input type="text" name="country" class="form-control col-sm-8" value="<?php if(isset($country)) echo $country ?>">
        </div>
        <?php 
          if(!empty($errCountry))
            echo '
            <div class="form-group row">
              <p class="text-danger col-sm-4"></p>
              <p class="text-danger col-sm-8">'.$errCountry.'</p>
            </div>
            ';
        ?>
       
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Logo thương hiệu: </label>
          <div class="custom-file col-sm-8">
            <input type="file" class="custom-file-input" name="img" id="img" accept="image/*" onchange="showPreview(event);">
            <label class="custom-file-label" for="inputGroupFile01">Chọn ảnh</label>
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
          if(!empty($errImg))
            echo '
            <div class="form-group row">
              <p class="text-danger col-sm-4"></p>
              <p class="text-danger col-sm-8">'.$errImg.'</p>
            </div>
            ';
        ?>
        <div class="row">
          <div class="col-sm-4"></div>
          <div class="col-sm-8"><img id="img_prv"></div>
        </div>
        
        <div class="form-group row">
        <p class="col-sm-4"></p>
          <div class="col-sm-8 pl-0 pt-3">
            <input class="btn btn-color" type="submit" name="submit" value="Thêm">
            <button class="btn btn-secondary" type="reset">Đặt lại</button>
            <a href="index.php?page=b&pg=1" class="btn btn-danger">Trở Về</a>
          </div>
        </div>

    </form> 

    </div>
<?php 

?>