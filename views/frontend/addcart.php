<?php
require_once "Models/Product.php";
// Bắt đầu session
session_start();
$product = new Product();
// Kiểm tra sự tồn tại và hợp lệ của tham số 'id'
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $product_row = $product->getRow($id);

    // Cấu trúc mảng 1 chiều
    $cart_item = [
        'id' => $id,
        'name' => $product_row['name'],
        'thumbnail' => $product_row['thumbnail'],
        'price' => ($product_row['pricesale'] > 0) ? $product_row['pricesale'] : $product_row['pricebuy'],
        'qty' => 1 // Đã sửa dấu nháy đơn cho khóa 'qty'
    ];

    // Lấy giỏ hàng từ session (hoặc mảng rỗng nếu chưa có)
    $cart = $_SESSION['cart'] ?? [];

    // Kiểm tra và cập nhật giỏ hàng
    if (count($cart) == 0) {
        array_push($cart, $cart_item);
    } else {
        if (check_cart_productid($cart, $id)) {
            update_cart_qty($cart, $id);
        } else {
            array_push($cart, $cart_item);
        }
    }

    // Lưu giỏ hàng vào session
    $_SESSION['cart'] = $cart;

    // In ra số lượng sản phẩm trong giỏ hàng
    echo count($_SESSION['cart']) ?? 0;
} else {
    echo "Invalid product ID.";
}


