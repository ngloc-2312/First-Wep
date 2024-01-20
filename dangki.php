<?php
session_start();

// Kiểm tra xem có dữ liệu đã nhập được gửi từ trang process_signup.php không
if (isset($_SESSION['data'])) {
  $signupData = $_SESSION['data'];

  // Gán giá trị từ session vào các biến tương ứng (hoặc sử dụng trực tiếp $_SESSION['data']['fullname'], $_SESSION['data']['username'], ...)
  $fullname = $signupData['fullname'];
  $username = $signupData['username'];
  $phone = $signupData['phone'];
  $address = $signupData['address'];
  $password = $signupData['password'];

  // Xóa dữ liệu đã lưu trữ trong session
  unset($_SESSION['data']);
} else {
  // Khởi tạo các biến với giá trị mặc định
  $fullname = '';
  $username = '';
  $phone = '';
  $address = '';
  $password = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $_SESSION['data'] = $_POST;
  header("Location: xuly_dangki.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="password"],
        .form-group input[type="tel"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input[type="file"] {
            padding: 5px 0;
        }

        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 14px;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h2>Đăng ký</h2>
        <form action="xuly_dangki.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="ho_ten">Họ và Tên:</label>
                <input type="text" id="ho_ten" name="ho_ten"  value="<?php echo $fullname ?>"  required>
                <?php if (isset($_SESSION['error_fullname'])) : ?>
                <p class="error"><?= $_SESSION['error_fullname'] ?></p>
                <?php endif; ?>
                <?php unset($_SESSION['error_fullname']) ?>
            </div>
            <div class="form-group">
                <label for="ten_dang_nhap">Tên đăng nhập:</label>
                <input type="text" id="ten_dang_nhap" name="ten_dang_nhap" value="<?php echo $username ?>" required>
                <?php if (isset($_SESSION['error_username'])) : ?>
                <p class="error"><?= $_SESSION['error_username'] ?></p>
                <?php endif; ?>
                <?php unset($_SESSION['error_username']) ?>
            </div>
            <div class="form-group">
                <label for="mat_khau">Mật khẩu:</label>
                <input type="password" id="mat_khau" name="mat_khau"  value="<?php echo $password ?>" required>
                <?php if (isset($_SESSION['error_password'])) : ?>
                <span class="input-error"><?= $_SESSION['error_password'] ?></span>
                <?php endif; ?>
                <?php unset($_SESSION['error_password']) ?>
            </div>
            <div class="form-group">
                <label for="so_dien_thoai">Số điện thoại:</label>
                <input type="tel" id="so_dien_thoai" name="so_dien_thoai" pattern="[0-9]{10}" value="<?php echo $phone ?>" required>
                <?php if (isset($_SESSION['error_phone'])) : ?>
                <span class="input-error"><?= $_SESSION['error_phone'] ?></span>
                <?php endif; ?>
                <?php unset($_SESSION['error_phone']) ?>
            </div>
            <div class="form-group">
                <label for="dia_chi">Địa chỉ:</label>
                <input type="text" id="dia_chi" name="dia_chi" value="<?php echo $address ?>" required>
                <?php if (isset($_SESSION['error_address'])) : ?>
                <span class="input-error"><?= $_SESSION['error_address'] ?></span>
                <?php endif; ?>
                <?php unset($_SESSION['error_address']) ?>
            </div>
            <div class="form-group">
                <input type="submit" name="user_signup" value="Đăng ký">
            </div>
        </form>
    </div>
</body>
</html>