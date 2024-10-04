<?php
require_once "Models/Category.php";
$category = new Category();
$list_category = $category->list_category_by_parentid(0);
?>
<?php require_once "views/frontend/header.php";?>

<div data-aos="fade-up">
    <!-- Hiển thị sản phẩm -->
    <?php require_once "views/frontend/product_flast_sale.php";?>
    <?php require_once "views/frontend/mod_product_new.php";?>
    <?php require_once "views/frontend/mod_product_category.php";?>
    <div data-aos="fade-up">
<div class="container">
    <!-- Introduction Section -->
    <div class="section">
        <h2 class="section-title text-center">Giới Thiệu Giày Sneaker </h2>
        <div class="row">
            <div class="col-md-6">
                <img src="public/image/gn3.png" alt="Giày Sneaker " class="product-image">
            </div>
            <div class="col-md-6">
                <div class="section-content">
                    <h3>Giới Thiệu Chung</h3>
                    <p>Giày Sneaker XYZ là sự kết hợp hoàn hảo giữa thiết kế hiện đại và tính năng tiện ích. Được làm từ chất liệu vải thoáng khí và đế cao su chống trượt, giày cung cấp sự thoải mái tối đa cho đôi chân của bạn suốt cả ngày dài.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="section">
        <h2 class="section-title text-center">Đặc Điểm Nổi Bật</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="section-content feature-item">
                    <h5>Chất Liệu Cao Cấp</h5>
                    <p>Vải thoáng khí giúp chân luôn khô ráo và thoải mái, phù hợp cho mọi hoạt động.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="section-content feature-item">
                    <h5>Đế Cao Su Chống Trượt</h5>
                    <p>Đảm bảo độ bám và an toàn trên mọi bề mặt, giúp bạn di chuyển tự tin hơn.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="section-content feature-item">
                    <h5>Thiết Kế Hiện Đại</h5>
                    <p>Phù hợp với nhiều trang phục và dịp khác nhau, giúp bạn luôn nổi bật.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
</div>
<div class="banner">
    <img src="public/image/banner34.webp" alt="" style="width: 1520px; margin-top:10px; height: 400px;" data-aos="fade-in">
</div>
</div>
    <?php require_once "views/frontend/mod_post_new.php";?>

    <div class="banner">
    <img src="public/image/banner35.webp" alt="" style="width: 1520px; margin-top:10px; height: 400px;" data-aos="fade-in">
</div>
    
    <div class="container my-5">
        <h2 class="text-center mb-4">Chính sách tại Hoàng Đạt Snacker</h2>
        <p class="text-center mb-5">Với cam kết mang đến sự hài lòng tuyệt đối cho khách hàng, Hoàng Đạt Snacker chú trọng vào chất lượng sản phẩm và dịch vụ tốt nhất. Chúng tôi cam kết chỉ bán các sản phẩm chất lượng tốt nhất đến quý khách.</p>
        <div class="row text-center">
            <div class="col-md-3">
                <div class="policy-item">
                    <i class="fas fa-shipping-fast policy-icon"></i>
                    <h5 class="policy-title">Miễn phí vận chuyển</h5>
                    <p class="policy-description">Cho tất cả đơn hàng trong nội thành Hồ Chí Minh</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="policy-item">
                    <i class="fas fa-exchange-alt policy-icon"></i>
                    <h5 class="policy-title">Miễn phí đổi - trả</h5>
                    <p class="policy-description">Đối với sản phẩm lỗi sản xuất hoặc vận chuyển</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="policy-item">
                    <i class="fas fa-headset policy-icon"></i>
                    <h5 class="policy-title">Hỗ trợ nhanh chóng</h5>
                    <p class="policy-description">Gọi Hotline: 19006750 để được hỗ trợ ngay lập tức</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="policy-item">
                    <i class="fas fa-gift policy-icon"></i>
                    <h5 class="policy-title">Ưu đãi thành viên</h5>
                    <p class="policy-description">Đăng ký thành viên để được nhận được nhiều khuyến mãi</p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Include Social Icons -->
<div class="social-icons">
    <a href="https://zalo.me/your-zalo-id" target="_blank" class="social-icon">
        <img src="public/image/zalo.webp" alt="Zalo">
    </a>
    <a href="https://m.me/your-facebook-id" target="_blank" class="social-icon">
        <img src="public/image/iconmess.webp" alt="Messenger">
    </a>
</div>
<!-- Include Footer -->
<?php require_once "views/frontend/footer.php";?>

<!-- Include AOS Script -->
<!-- SCRIPT ĐỂ CHO KHI LƯỚT XUỐNG NỘI DUNG SẼ HIỆN RA -->
<script>
    AOS.init({
        duration: 1200, 
        once: true,    
    });
</script>

<!-- CSS CỦA NÚT ZALO VÀ MESS -->
<style>
    /* styles.css */

/* styles.css */

body {
    margin: 0;
    padding: 0;
}

.social-icons {
    position: fixed;
    bottom: 20px;
    right: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.social-icon {
    display: block;
}

.social-icon img {
    width: 40px; /* Adjust size as needed */
    height: auto;
    display: block;
    border-radius: 50%; /* Optional: round icons */
    transition: opacity 0.3s;
    animation: shake 3s infinite; /* Apply the shake animation */
}

/* Hover effect */
.social-icon img:hover {
    opacity: 0.7; /* Optional: add hover effect */
}

/* Keyframes for shake animation */
@keyframes shake {
    0%, 100% {
        transform: rotate(0deg);
    }
    10%, 30%, 50%, 70%, 90% {
        transform: rotate(-10deg);
    }
    20%, 40%, 60%, 80% {
        transform: rotate(10deg);
    }
}


</style>