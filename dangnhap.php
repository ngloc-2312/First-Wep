<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4e493b69ac.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Login Form</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f1f1f1;
        }

        .wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        form h1 {
            text-align: center;
            color: #333;
        }

        .input-field {
            margin-top: 20px;
        }

        .password-field {
            position: relative;
        }

        .eye {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            margin-right: 30px;
        }

        .input-box {
            position: relative;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        i {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 10px;
            color: #555;
        }

        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #2980b9;
        }

        .remember-forgot {

            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me label {
            margin-left: 5px;
            /* Thêm một khoảng cách giữa checkbox và chữ Nhớ */
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .remember-me input {
            margin-right: 5px;
        }

        .forgot-password a {
            color: #3498db;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #3498db;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;

        }
    </style>
</head>

<body>
    <div class="wrapper">
        <form action="admin/permission.php" method="POST">
            <h1>Login</h1>
            <div class="input-field">
                <div class="input-box">
                    <input type="text" placeholder="Username" name="username" required>
                </div>
                <div class="input-box password-field" style="display: flex;">
                    <input type="password" name="password" placeholder="Password" required>
                    <div class="eye">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>
            </div>
            <button type="submit">Đăng nhập</button>
            <div class="remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Nhớ mật khẩu</label>
                </div>
                <div class="forgot-password">
                    <a href="#">Quên mật khẩu</a>
                </div>
            </div>
            <div class="register-link">
                <p>Don't have an account?
                    <a href="dangki.php">Đăng kí</a>
                </p>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            $('.eye').click(function(){
                $(this).toggleClass('open');
                $(this).children('i').toggleClass('fa-eye-slash fa-eye');
                if($(this).hasClass('open')){
                    $(this).prev().attr('type','text');
                }else{
                    $(this).prev().attr('type','password');
                }
            });
        });
    </script>
</body>

</html>