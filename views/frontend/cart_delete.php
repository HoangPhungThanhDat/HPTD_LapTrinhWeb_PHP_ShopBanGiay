<?php
session_start();
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy giỏ hàng từ session
    $cart = $_SESSION['cart'] ?? [];

    // Tìm và xóa sản phẩm có ID tương ứng
    foreach ($cart as $key => $item) {
        if ($item['id'] == $id) {
            unset($cart[$key]);
            break;
        }
    }

    // Cập nhật giỏ hàng trong session
    $_SESSION['cart'] = array_values($cart); // array_values để đảm bảo không còn khóa array không liên tục

    // Chuyển hướng người dùng trở lại trang giỏ hàng
    header('Location: index.php?option=cart'); // Đảm bảo thay đổi đường dẫn cho phù hợp
    exit();
} else {
    echo "Lỗi.";
}
?>
