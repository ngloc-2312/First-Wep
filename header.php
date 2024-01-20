<?php
function getName($chuoi)
{
   $mangTu = explode(" ", $chuoi);
   $phanTuCuoiCung = end($mangTu);
   return $phanTuCuoiCung;
}

?>
<header>
   <div class="logo">
      <a href="index.php"><img src="image/logo1.png" alt=""></a>
   </div>
   <div class="menu">
      <li><a href="">Sản phẩm</a>
         <ul class="sub-menu">
            <li class="sub-menu-item">
               <h4 class="sub-menu-title"><a href="gong_kinh_can.php">Gọng Kính</a></h4>
               <div>
                  <ul>
                     <li><a href="" class="sub-menu-link">Nhựa</a></li>
                     <li><a href="" class="sub-menu-link">Kim Loại</a></li>
                     <li><a href="" class="sub-menu-link">Nhựa Mix Kim Loại</a></li>
                  </ul>
               </div>
            </li>
            <li class="sub-menu-item">
               <div>
                  <h4 class="sub-menu-title"><a href="">Tròng Kính</a></h4>
               </div>
               <div>
                  <ul>
                     <li><a href="" class="sub-menu-link">Mắt Chống Ánh Sáng Xanh</a></li>
                     <li><a href="" class="sub-menu-link">Mắt Đổi Màu Chống Ánh Sáng Xanh</a></li>
                     <li><a href="" class="sub-menu-link">Mắt Đổi Màu</a></li>
                     <li><a href="" class="sub-menu-link">Mắt Chống Tia UV</a></li>
                     <li><a href="" class="sub-menu-link">Mắt Râm Cận</a></li>
                     <li><a href="" class="sub-menu-link">Mắt Thường</a></li>
                  </ul>
               </div>
            </li>
            <li class="sub-menu-item">
               <div>
                  <h4 class="sub-menu-title"><a href="">Phụ Kiện</a></h4>
               </div>
               <div>
                  <ul>
                     <li><a href="" class="sub-menu-link">Hộp Kính</a></li>
                     <li><a href="" class="sub-menu-link">Túi Tote</a></li>
                     <li><a href="" class="sub-menu-link">Khăn Nano</a></li>
                     <li><a href="" class="sub-menu-link">Mắt Chống Tia UV</a></li>
                     <li><a href="" class="sub-menu-link">Set Phụ Kiện</a></li>
                     <li><a href="" class="sub-menu-link">Dây Đeo Kính</a></li>
                  </ul>
               </div>
            </li>
         </ul>
      </li>
      <li><a href="">Super combo</a></li>
      <li><a href="">Dịch vụ</a>
         <ul class="sub-menu sub-menu-small">
            <li class="sub-menu-item">
               <div>
                  <ul>
                     <li><a href="" class="sub-menu-link"><a href="baohanh.php">Chính sách bảo hành</a></li>
                     <li><a href="" class="sub-menu-link"><a href="doitra.php">Đổi cũ trả mới trong 30 ngày</a></li>
                  </ul>
               </div>
            </li>
         </ul>
      </li>
      <li><a href="">Ưu đãi</a></li>
      <li><a href="">Góc chia sẻ</a>
         <ul class="sub-menu sub-menu-small">
            <li class="sub-menu-item">
               <div>
                  <ul>
                     <li><a href="" class="sub-menu-link">Bảo vệ mắt</a></li>
                     <li><a href="" class="sub-menu-link">Kiến thức</a></li>
                     <li><a href="" class="sub-menu-link">Sức khỏe</a></li>
                  </ul>
               </div>
            </li>
         </ul>
      </li>
      <li><a href="">Khách hành</a></li>
      <li><a href="donhang.php">Tra cứu đơn</a></li>

   </div>
   <div class="other">
      <ul>
         <li>
            <input id="search-input" placeholder="Bạn cần tìm gì?" type="text">
            <div id="search-icon" onclick="searchProducts()">
               <i class="fa fa-search"></i>
            </div>
            <script>
               function searchProducts() {
                  // Lấy giá trị nhập vào từ ô tìm kiếm
                  var searchTerm = document.getElementById('search-input').value;

                  // Chuyển hướng đến trang tìm kiếm với tham số 'search'
                  window.location.href = "trangtimkiem.php?search=" + encodeURIComponent(searchTerm);
               }
            </script>
         </li>


         <li>
         <li>
            <div id="cart-icon" onclick="goToCheckout()">
               <i class="fas fa-shopping-cart"></i>
            </div>

            <!-- Đặt mã JavaScript để chuyển hướng -->
            <script>
               function goToCheckout() {
                  window.location.href = "cart.php";
               }
            </script>
         </li>
         <li>
            <!-- Thêm biểu tượng người dùng và gán sự kiện onclick -->
            <?php if (!isset($_SESSION['userID'])) { ?>
               <div id="user-icon" onclick="goToLoginPage()">
                  <i class="fas fa-user"></i>
               </div>

               <!-- Đặt mã JavaScript để chuyển hướng -->
               <script>
                  function goToLoginPage() {
                     window.location.href = "dangnhap.php";
                  }
               </script>
            <?php } else { ?>
               <div style="display: flex;flex-direction: column;align-items: center; gap: 3px; width: 100%;">
                  <div style="width: 30px; height: 30px;">
                     <img src="img/<?= $_SESSION['userAvatar'] ?>"
                        style="width: 100%; height: 100%; object-fit: cover; border-radius: 100vh; flex-shrink: 0;">
                  </div>
                  <p class="overflow-ellipsis" style="font-size: 12px;">
                     <?= getName($_SESSION['userName']) ?>
                  </p>
               </div>
               <a href="logout.php" style="display: inline-block; margin-left: 5px;">
                  <i class="fa-solid fa-right-from-bracket"></i>
               </a>
            <?php } ?>
         </li>
         </li>
      </ul>
   </div>
</header>