<?php
session_start();

if (isset($_GET['option']) && $_GET['option'] == 'capnhatcart') {
    if (isset($_POST['qty']) && is_array($_POST['qty'])) {
        foreach ($_POST['qty'] as $id => $qty) {
            // Lặp qua từng sản phẩm trong giỏ hàng
            foreach ($_SESSION['cart'] as $index => $item) {
                if ($item['id'] == $id) {
                    // Cập nhật lại số lượng cho sản phẩm tương ứng
                    $_SESSION['cart'][$index]['qty'] = max(1, (int)$qty);
                    break;
                }
            }
        }
        // Cập nhật lại $cart_content sau khi thay đổi số lượng
        $cart_content = $_SESSION['cart'];
    }
    header('Location: index.php?option=cart');
}
?>
