<div class="home">
    <h1>WELCOME TO ADMIN !</h1>
    
    <div class="home_adm">
        <?php
        // Kiểm tra xem biến session 'image' có tồn tại không và không phải là null
        if (isset($_SESSION['img']) && $_SESSION['img'] !== null) {
            // Sử dụng biến session 'image' để hiển thị ảnh
            echo '<img class="avt_home" src="../img/' . $_SESSION['img'] . '">';
        } else {
            // Xử lý trường hợp không có giá trị hợp lệ cho 'image'
            
        }
        ?>
    </div>
</div>