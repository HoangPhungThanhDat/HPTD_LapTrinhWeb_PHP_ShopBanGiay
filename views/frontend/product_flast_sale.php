<?php
require_once "Models/Product.php";
$product = new Product();
$limit = 6; // Giới hạn số lượng sản phẩm bạn muốn lấy
$list_product_sale = $product->get_list_product_sale($limit);
?>
<div class="highlight-products">
    <div class="header">
    <h1 class="text-center">Sale Sốc Hôm Nay</h1>
        <div class="countdown">
            <span>Kết thúc sau:</span>
            <div id="countdown-timer">11 : 18 : 31</div>
        </div>
    </div>

    <div class="products-carousel swiper-container">
        <div class="swiper-wrapper">
            <!-- Mỗi sản phẩm là 1 swiper-slide -->
            <?php
            foreach ($list_product_sale as $row_product) {
            ?>
            <div class="swiper-slide product-item">
                <div class="discount-tag">Giảm Sốc</div>
                <a href="index.php?option=product_detail&slug=<?=$row_product['slug'];?>">
                <img src="public/images/product/<?= $row_product['thumbnail']; ?>" alt="<?=$row_product['thumbnail'];?>">
                </a>
                <div class="product-info">
                    <h3><?=$row_product['name']; ?></h3>
                    <div class="sale-card-price"><?=number_format($row_product['pricesale']); ?>đ 
                            <span class="sale-card-discount">-<?=round((($row_product['pricebuy'] - $row_product['pricesale']) / $row_product['pricebuy']) * 100); ?>%</span>
                        </div>
                        <div class="sale-card-old-price"><?=number_format($row_product['pricebuy']); ?>đ</div>
                        
                    <div class="rating">
                        <span>★★★★★</span>
                    </div>
                    <div class="text-end">
                            <button onclick="themgiohang(<?=$row_product['id']; ?>)" class="btn btn-sm btn-success">
                            <i class="fa fa-shopping-cart"></i>
                                Thêm vào giỏ hàng
                            </button>
                        </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<!-- Thư viện Swiper -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    // Thiết lập đồng hồ đếm ngược
    function countdown() {
        var countDownDate = new Date().getTime() + 1000 * 60 * 60 * 24; // Thời gian 1 ngày từ hiện tại
        var x = setInterval(function () {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("countdown-timer").innerHTML = hours + " : " + minutes + " : " + seconds;
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown-timer").innerHTML = "Hết giờ!";
            }
        }, 1000);
    }

    countdown();

    // Cài đặt Swiper
    var swiper = new Swiper('.swiper-container', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        slidesPerView: 4,  // Hiển thị 3 sản phẩm cùng lúc
        spaceBetween: 20,  // Khoảng cách giữa các sản phẩm
        loop: true,        // Cho phép lặp vô tận
        autoplay: {
        delay: 2000,  // Thay đổi sản phẩm sau mỗi 5 giây
        disableOnInteraction: false,  // Tự động tiếp tục khi người dùng tương tác
    },
    });
</script>

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
</script> -->
<style>
    .highlight-products {
        background-color: #ff4a5a;
        padding: 20px;
        border-radius: 10px;
        color: white;
        position: relative;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .header h2 {
        display: flex;
        align-items: center;
        font-size: 24px;
    }

    .header img {
        width: 30px;
        margin-right: 10px;
    }

    .countdown {
        font-size: 18px;
    }

    .products-carousel {
        display: flex;
        align-items: center;
    }

    .swiper-container {
        width: 100%;
        padding: 20px 0;
    }

    .swiper-slide {
        background-color: white;
        color: black;
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        width: 200px;
        position: relative; /* Để thẻ giảm giá hiển thị đúng vị trí */
        transition: box-shadow 0.3s ease, transform 0.3s ease; /* Thêm hiệu ứng chuyển tiếp */
    }

    .swiper-slide:hover {
        box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Thêm bóng khi hover */
        transform: scale(1.05); /* Phóng to sản phẩm khi hover */
    }

    .discount-tag {
        background-color: red;
        color: white;
        padding: 5px;
        border-radius: 5px;
        position: absolute;
        top: 10px;
        left: 10px;
        transition: background-color 0.3s ease, transform 0.3s ease; /* Thêm hiệu ứng chuyển tiếp */
    }

    .discount-tag:hover {
        background-color: darkred; /* Thay đổi màu nền khi hover */
        transform: scale(1.1); /* Phóng to thẻ giảm giá khi hover */
    }

    .product-item img {
        width: 120px; /* Điều chỉnh kích thước hình ảnh nhỏ lại */
        height: auto;
        margin-bottom: 10px;
        transition: transform 0.3s ease, filter 0.3s ease; /* Thêm hiệu ứng chuyển tiếp */
    }

    .product-item img:hover {
        transform: scale(1.05); /* Phóng to hình ảnh khi hover */
        filter: brightness(1.2); /* Tăng độ sáng hình ảnh khi hover */
    }

    .price {
        font-size: 18px;
        color: red;
    }

    .old-price {
        text-decoration: line-through;
        color: gray;
    }

    .rating {
        color: gold;
    }

    .installment {
        color: blue;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: white;
        font-size: 24px;
        background-color: #ff4a5a;
        padding: 10px;
        border-radius: 50%;
        transition: background-color 0.3s ease, transform 0.3s ease; /* Thêm hiệu ứng chuyển tiếp */
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background-color: #ff2a3a; /* Thay đổi màu nền khi hover */
        transform: scale(1.1); /* Phóng to nút khi hover */
    }
</style>
