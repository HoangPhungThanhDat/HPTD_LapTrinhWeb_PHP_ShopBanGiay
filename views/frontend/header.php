<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/fontawesome-free-6.5.2-web/css/all.min.css">
    <link rel="stylesheet" href="public/css/layoutsize.css">
    <link rel="stylesheet" href="public/bootstrap/css/sanpham.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="public/bootstrap/css/menuDoc.css"> 

    <!-- Thêm CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
    <script src="public/jquery/jquery-3.7.1.min.js"></script>
    <title>Giao Diện</title>
    <style>
        .navbar {
            font-size: 16px;
        }
        .navbar-brand img {
            border-radius: 5px;
        }
        .nav-link {
            padding-left: 20px;
            padding-right: 20px;
            transition: color 0.3s ease, background-color 0.3s ease;
        }
        .nav-link:hover, .nav-link:focus {
            color: white; /* Chữ chuyển thành màu trắng khi rê chuột */
            background-color: yellow; /* Nền vàng cho hiệu ứng hover */
            border-radius: 20px; /* Viền tròn */
        }
        .dropdown-menu {
            min-width: 150px;
            display: none; /* Ẩn menu dropdown mặc định */
            opacity: 0; /* Bắt đầu với độ mờ là 0 */
            transition: opacity 0.3s ease; /* Hiệu ứng chuyển đổi cho menu */
        }
        .dropdown-menu.show {
            display: block; /* Hiển thị menu dropdown khi có lớp show */
            opacity: 1; /* Menu hiển thị với độ mờ 1 */
        }
        .nav-item:hover .dropdown-menu {
            display: block; /* Hiển thị menu khi rê chuột vào nav-item */
            opacity: 1; /* Đảm bảo menu không bị mờ */
        }
        .form-control {
            width: 250px;
            transition: width 0.4s ease-in-out;
        }
        .form-control:focus {
            width: 350px;
        }
        .btn-outline-success {
            border-color: #198754;
            color: #198754;
        }
        .btn-outline-success:hover {
            background-color: #198754;
            color: white;
        }
        .nav-item .nav-link.active {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="banner">
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="public/image/logo.png" alt="Logo" width="110" height="40" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsupportedcontent" aria-controls="navbarsupportedcontent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarsupportedcontent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="http://localhost/HoangPhungThanhDat_ltwed/"><i class="fa-solid fa-house"></i> <strong>Trang Chủ</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?option=cart"><i class="fa-sharp fa-solid fa-cart-shopping"></i> <strong>Giỏ hàng</strong></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardropdown" role="button" aria-expanded="false">
                               <strong>Chính sách</strong>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbardropdown">
                                <li><a class="dropdown-item" href="#"><strong>Chính sách đổi trả</strong></a></li>
                                <li><a class="dropdown-item" href="#"><strong>Chính sách bảo hành </strong></a></li>
                                <li><a class="dropdown-item" href="#"><strong>Chính sách mua hàng</strong></a></li>
                                <li><a class="dropdown-item" href="#"><strong>Chính sách vận chuyển</strong></a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardropdown" role="button" aria-expanded="false">
                                <i class="fa-solid fa-location-dot"></i> <strong>Shop</strong>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbardropdown">
                                <li><a class="dropdown-item" href="index.php?option=product"><strong>Tất cả sản phẩm</strong></a></li>
                                <li><a class="dropdown-item" href="index.php?option=post"><strong>Tất cả bài viết</strong></a></li>                              
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?option=Contact"><strong><i class="fa-solid fa-phone-volume"></i> Liên Hệ</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?option=gioithieu"><strong>Giới Thiệu</strong></a>
                        </li>
                        <a class="nav-link active ms-3" href="index.php?option=register"> <i class="fa-regular fa-user"></i> <strong>Đăng Ký</strong></a>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2 rounded-pill" type="search" placeholder="Tìm kiếm sản phẩm..." aria-label="Search">
                        <button class="btn btn-outline-success rounded-pill" type="submit">Tìm kiếm</button>
                    </form>
                    <a class="nav-link active ms-3" href="">
                        <i class="fa-solid fa-user"></i> 
                        <strong>
                            <?php if (isset($_COOKIE['username'])): ?>
                                <p>Chào, <?php echo htmlspecialchars($_COOKIE['username']); ?>!</p>
                                <a href="index.php?option=dangxuat">Đăng xuất</a>
                            <?php else: ?>
                                <a href="index.php?option=dangnhap">Đăng nhập</a>
                            <?php endif; ?>
                        </strong>
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <div class="banner">
        <img src="public/image/h1.webp" alt="" style="width: 1520px; margin-top:10px; height: 550px;" data-aos="fade-in">
    </div>

    <!-- BANNER SLIDER -->
    <?php require_once "views/frontend/mod_slider.php";?>

    <!-- Thêm JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 2500, // Thời gian hiệu ứng (ms)
            once: true,     // Chạy hiệu ứng một lần khi cuộn tới phần tử
        });
    </script>
</body>
</html>
