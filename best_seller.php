<?php
$sql = "select glasses.*, brand.name as brand_name 
from glasses
left join brand on brand.id = glasses.id_brand
order by id asc limit 4";
$result = mysqli_query($conn, $sql);

?>
<section class="app-container">
   <section id="best-seller">
      <div class="aspect-ratio-168">
         <img src="image/bs.jpg">
      </div>
      <div id="wp-products">
         <span class="text">
            DANH MỤC SẢN PHẨM
         </span>
         <ul id="list-products" class="bodys">
            <?php while ($row = mysqli_fetch_array($result)) { ?>
               <div class="item product-shadow">
                  <a href="product.php?id=<?= $row['id']  ?>" style="width: 100%; display: block; cursor: pointer;">
                     <img src="img/<?= $row['image'] ?>" style="height: 250px; object-fit: cover;">
                  </a>
                  <div class="name"><?= $row['brand_name'] ?></div>
                  <a href="product.php?id=<?= $row['id']  ?>" class="desc" style="width: 100%; display: block; cursor: pointer;"><?= $row['name'] ?></a>
                  <div class="price"><?= number_format($row['normal_price'], 0, ',', '.') ?> VNĐ</div>
                  <div class="hover-image" style="background-image: url('image/prd2.jpeg');"></div>
               </div>
            <?php } ?>
            <div class="text-center">
               <div class="center-button">
                  <a href="gong_kinh_can.php" class="custom-button">Xem thêm >></a>
               </div>
            </div>
         </ul>
      </div>
   </section>
</section>