<?php
require_once("./db_config/db_connect.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4e493b69ac.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Estilos.css" />
    <title>Kính mắt Lily</title>
</head>

<body>
    <?php
    require_once('header.php');
    require_once('slider.php');
    require_once('best_seller.php');
    ?>
    <div id="comment">
        <h2>ĐÁNH GIÁ CỦA KHÁCH HÀNG</h2>
        <div id="comment-body">
            <div class="prev">
                <a href="#">
                    <img src="image/iconback.png" alt="">
                </a>
            </div>
            <ul id="list-comment">
                <li class="item-comment">
                    <div class="avatar">
                        <img src="image/avt1.jpg" alt="">
                    </div>
                    <div class="ten">Đỗ Xuân Trưởng</div>
                    <div class="text-comment">
                        <p>
                            Kính đẹp, chắc chắn lắm. Có cả bao da đựng rất xịn nhé. Cảm ơn shop ạ.Đeo kính vào nhìn đẹp trai hơn hẳn
                        </p>
                    </div>
                </li>
                <li class="item-comment">
                    <div class="avatar">
                        <img src="image/avt2.jpg" alt="">
                    </div>
                    <div class="ten">Vũ Minh Toàn</div>
                    <div class="text-comment">
                        <p>
                            Một sản phẩm tuyệt vời. Rất đáng đồng tiền. Bao bọc kỹ, shop chu đáo. Xin cám ơn rất nhiều
                        </p>
                    </div>
                </li>
                <li class="item-comment">
                    <div class="avatar">
                        <img src="image/avt3.jpg" alt="">
                    </div>
                    <div class="ten">Nguyễn Thế Vinh</div>
                    <div class="text-comment">
                        <p>
                            Shop bán hàng có tâm lắm luôn í , kính xinh lắm , mình mua được với giá siêu hời nhưng so
                            với giá này thì mn cũng trải nghiệm thử nha , lần đầu mua mà thấy hài lòng lắm í shop sẽ ủng
                            hộ shop thêm nhìu nữa
                        </p>
                    </div>
            </ul>
            <div class="next">
                <a href="#">
                    <img src="image/iconforward.png" alt="">
                </a>
            </div>
        </div>
    </div>


    <?php require_once("footer.php") ?>

    <script src="script.js"></script>
    <script src="slider.js"></script>
</body>

</html>