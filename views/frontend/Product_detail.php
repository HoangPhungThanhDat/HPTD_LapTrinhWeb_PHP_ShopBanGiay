<?php 
require_once "Models/Product.php";
require_once "Models/Category.php";

$product = new Product();
$category = new Category();

// Lấy thông tin sản phẩm dựa trên slug
$slug = $_REQUEST['slug'];
$row = $product->getRow($slug);

// Xử lý sản phẩm cùng loại
$catid = $row['category_id'];
$list_cat_id = array();
array_push($list_cat_id, $catid);
$list_category1 = $category->list_category_by_parentid($catid); //lấy danh sach cac danh muc
if (count($list_category1) > 0) {
    foreach ($list_category1 as $row_cat1) {
        array_push($list_cat_id, $row_cat1['id']);
        $list_category2 = $category->list_category_by_parentid($row_cat1['id']);
        if (count($list_category2) > 0) {
            foreach ($list_category2 as $row_cat2) {
                array_push($list_cat_id, $row_cat2['id']);
            }
        }
    }
}

$limit = 6;
$list_product = $product->list_product_other($list_cat_id, $row['id'], $limit);          
?>
<?php require_once "views/frontend/header.php"; ?>
<main>   
        <div class="product-detail">
        <div class="product-images">
        <img class="img-fluid" src="public/images/product/<?=$row['thumbnail'];?>" alt="<?=$row['thumbnail'];?>">
            <div class="thumbnails">
            <!-- Repeat for each thumbnail -->
            <img src="public/images/product/<?=$row['thumbnail'];?>" alt="Thumbnail 1">
            <img src="public/images/product/<?=$row['thumbnail'];?>" alt="Thumbnail 2">
            <img src="public/images/product/<?=$row['thumbnail'];?>" alt="Thumbnail 3">
            </div>
        </div>
        <div class="product-info">
            <h1><?=$row['name'];?></h1>
            <p><?=number_format($row['pricebuy']);?>đ</p>
            <div class="sizes">
            <label for="size-select">CHỌN SIZE GIÀY</label>
            <select id="size-select">
                <option value="42">38</option>
                <option value="42">39</option>
                <option value="42">40</option>
                <option value="42">41</option>
                <option value="42">42</option>
            </select>
            </div>
            <div class="quantity">
            <input type="number" value="1">
            </div>
            <button onclick="themgiohang(<?=$row['id'];?>)" class="btn btn-sm btn-success">
                <i class="fa fa-shopping-cart"></i>
                Thêm vào giỏ hàng
            </button>
            <button class="btn buy-now">Mua ngay</button>
            <div class="contact">
            <p>Hoặc đặt mua: 0909300746 (Tư vấn Miễn phí)</p>
            </div>
            <div class="social-sharing">
            <!-- Icons for social media -->
            <img src="public/image/icontwe.png" alt="Twitter">
            <img src="public/image/iconfb.png" alt="Facebook">
            <img src="public/image/iconptt.png" alt="Pinterest">
            </div>
        </div>
        </div>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Sản Phẩm Liên Quan</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Bình Luận</button>
                </div>
            </nav>
            <!-- lấy ra 4 sản phẩm cùng loại  -->
            <div data-aos="fade-up">
            <div class="row">           
                <?php foreach ($list_product as $row_product): ?>
                    <div class="product-card">
            <div class="product-image">
                <span class="discount-label">New</span>
                <a href="index.php?option=product_detail&slug=<?=$row_product['slug'];?>">
                    <img src="public/images/product/<?= $row_product['thumbnail']; ?>" class="img-fluid product-img" alt="<?=$row_product['thumbnail'];?>">
                </a>
            </div>
            <div class="product-details">
                <div class="product-title">
                    <a href="index.php?option=product_detail&slug=<?= $row_product['slug']; ?>"><?= $row_product['name']; ?></a>
                </div>
                <div class="product-brand">BALENCIAGA</div>
                <div class="product-pricing">
                    <span class="new-price"><?= number_format($row_product['pricebuy']); ?>đ</span>
                </div>
            </div>
        </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    </div>
</main>
<?php require_once "views/frontend/footer.php"; ?>

<script>
function themgiohang(productid) {
    $.ajax({
        url: "index.php?option=addcart", // URL của file PHP xử lý thêm vào giỏ hàng
        data: { id: productid }, // Gửi ID sản phẩm để xử lý
        type: 'GET',
        success: function(result) {
            var showcartElement = document.getElementById("showcart");
            if (showcartElement) {
                showcartElement.innerHTML = result;
            }
            alert("Sản phẩm đã được thêm vào giỏ hàng!");
        },
        error: function(xhr, status, error) {
            alert("Có lỗi xảy ra: " + error);
        }
    });
}
</script>
<style>
    .view-all-btn {
        display: inline-block;
        padding: 10px 20px;
        border: 1px solid #000;
        border-radius: 20px;
        font-size: 16px;
        color: #000;
        text-decoration: none;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .view-all-btn:hover {
        background-color: #000;
        color: #fff;
    }

    .product-card {
        border: 1px solid #000;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin: 10px;
        width: 200px;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
    }

    .product-image img {
        width: 100%;
        height: auto;
    }

    .discount-label {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: #000;
        color: #fff;
        padding: 5px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 3px;
    }

    .product-details {
        padding: 15px;
        text-align: left;
    }

    .product-title {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    .product-title a {
        text-decoration: none;
        color: inherit;
        transition: color 0.3s ease;
    }

    .product-title a:hover {
        color: #e53935;
    }

    .product-brand {
        font-size: 14px;
        color: #555;
        margin-bottom: 10px;
    }

    .product-pricing {
        font-size: 14px;
        color: #333;
    }

    .new-price {
        font-weight: bold;
        color: #e53935;
    }

    .product-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    @media (max-width: 768px) {
        .product-card {
            width: 48%;
        }
    }

    @media (max-width: 480px) {
        .product-card {
            width: 100%;
        }
    }
</style>



















<div class="product-detail">
  <div class="product-images">
    <img src="path/to/main-image.jpg" alt="Main Product Image" class="main-image">
    <div class="thumbnails">
      <!-- Repeat for each thumbnail -->
      <img src="path/to/thumbnail1.jpg" alt="Thumbnail 1">
      <img src="path/to/thumbnail2.jpg" alt="Thumbnail 2">
      <img src="path/to/thumbnail3.jpg" alt="Thumbnail 3">
    </div>
  </div>
  <div class="product-info">
    <h1>NIKE AIR MAX EXCEE</h1>
    <p class="price">2,900,000 đ</p>
    <div class="sizes">
      <label for="size-select">CHỌN SIZE GIÀY</label>
      <select id="size-select">
        <option value="42">42</option>
      </select>
    </div>
    <div class="quantity">
      <button class="quantity-btn">-</button>
      <input type="number" value="1">
      <button class="quantity-btn">+</button>
    </div>
    <button class="btn add-to-cart">Thêm vào giỏ</button>
    <button class="btn buy-now">Mua ngay</button>
    <div class="contact">
      <p>Hoặc đặt mua: 0909300746 (Tư vấn Miễn phí)</p>
    </div>
    <div class="social-sharing">
      <!-- Icons for social media -->
      <img src="path/to/twitter-icon.svg" alt="Twitter">
      <img src="path/to/facebook-icon.svg" alt="Facebook">
      <img src="path/to/pinterest-icon.svg" alt="Pinterest">
    </div>
  </div>
</div>
<style>
    .product-detail {
  display: flex;
  padding: 20px;
}

.product-images {
  width: 50%;
}

.main-image {
  width: 100%;
  height: auto;
}

.thumbnails img {
  width: 20%;
  margin-right: 5px;
  cursor: pointer;
}

.product-info {
  width: 50%;
  padding-left: 20px;
}

.product-info h1 {
  font-size: 24px;
  margin-bottom: 10px;
}

.price {
  font-size: 20px;
  color: red;
  margin-bottom: 20px;
}

.sizes, .quantity {
  margin-bottom: 10px;
}

.btn {
  padding: 10px 20px;
  margin-right: 10px;
  border: 2px solid gray; /* Viền màu sám */
  background-color: yellow;
  cursor: pointer;
  border-radius: 10px; /* Bo tròn góc */
  transition: background-color 0.3s, border-color 0.3s, transform 0.3s; /* Hiệu ứng chuyển đổi mượt mà */
}

.btn:hover {
  background-color: #f8d568; /* Màu sáng hơn khi hover */
  border-color: darkgray; /* Viền đậm hơn khi hover */
  transform: scale(1.1); /* Phóng to khi hover */
}

.btn.buy-now {
  background-color: red;
  color: white;
}

.btn.buy-now:hover {
  background-color: #ff6347; /* Màu đỏ tươi khi hover */
}

.social-sharing img {
  width: 30px;
  margin-right: 5px;
}

.quantity-btn {
  background-color: transparent;
  border: none;
  font-size: 16px;
  padding: 0 10px;
}

</style>