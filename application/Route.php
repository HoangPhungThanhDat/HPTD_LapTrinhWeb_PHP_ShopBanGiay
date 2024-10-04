<?php
class Route{
    //route site
    public static function route_site()
    {
        // Đặt đường dẫn cơ bản đến thư mục views/frontend
        $path = 'views/frontend/';
        
        // Kiểm tra sự tồn tại của tham số 'option'
        if (!isset($_REQUEST['option'])) {
            $path .= 'home.php';  // Nếu không có 'option', nạp trang home.php
        } else {
            $option = basename($_REQUEST['option']); // Lọc tham số để ngăn chặn tấn công directory traversal
    
            // Nếu 'option' là 'cart', nạp trang cart.php
            if ($option === 'cart') {
                $path .= 'cart.php';
            } 
            // Nếu 'option' là 'product', nạp trang product.php
            elseif ($option === 'product') {
                $path .= 'product.php';
            }
            // nạp trang liên hệ
            elseif ($option === 'Contact') {
                $path .= 'Contact.php';
            }

            elseif ($option === 'addcart') {
                $path .= 'addcart.php';
            }


            elseif ($option === 'cartdelete') {
                $path .= 'cart_delete.php';
            }

            elseif ($option === 'capnhatcart') {
                $path .= 'capnhatcart.php';
            }

            elseif ($option === 'checkout') {
                $path .= 'checkout.php';
            }

            elseif ($option === 'post') {
                $path .= 'post.php';
            }

            elseif ($option === 'register') {
                $path .= 'register.php';
            }
            elseif ($option === 'dangnhap') {
                $path .= 'dangnhap.php';
            }
            elseif ($option === 'dangxuat') {
                $path .= 'dangxuat.php';
            }
            elseif ($option === 'product_detail') {
                $path .= 'product_detail.php';
            }
            elseif ($option === 'post_detail') {
                $path .= 'post_detail.php';
            }
            elseif ($option === 'gioithieu') {
                $path .= 'gioithieu.php';
            }
            else {
                // Thêm giá trị của 'option' vào đường dẫn
                $path .= $option;
                
                // Kiểm tra sự tồn tại của tham số 'slug'
                if (!isset($_REQUEST['slug'])) {
                    $path .= '_detail.php';  // Nếu không có 'slug', nạp trang _detail.php
                } else {
                    // Kiểm tra sự tồn tại của tham số 'cat'
                    if (!isset($_REQUEST['cat'])) {
                        $path .= '_category.php';  // Nếu không có 'cat', nạp trang _category.php
                    } else {
                        $path .= '.php';  // Nếu có cả 'slug' và 'cat', nạp trang .php
                    }
                }
            }
        }
    
        // Kiểm tra sự tồn tại của tập tin trước khi yêu cầu
        if (file_exists($path)) {
            require_once $path;
        } else {
            // Có thể hiển thị trang lỗi hoặc trang 404 nếu tập tin không tồn tại
            echo 'File not found';
        }
    }
    
    //route admin

    public static function route_admin()
    {
        $path = '../views/backend/';
        if(!isset($_REQUEST['option'])){
            $path .='dashboard/index.php';
        }else {
                $path .= $_REQUEST['option'] . "/";
                if(isset($_REQUEST['cat'])){
                    $path .=$_REQUEST['cat'] . '.php';
                }else {
                    $path .='index.php';
                } 
        }
        require_once  $path;
    }
}