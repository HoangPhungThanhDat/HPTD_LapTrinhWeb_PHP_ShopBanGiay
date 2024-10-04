<?php
session_start();
// Xóa cookie bằng cách thiết lập thời gian hết hạn trong quá khứ
if (isset($_COOKIE['username'])) {
    setcookie('username', '', time() - 3600, '/');
}
// Xóa thông tin đăng nhập trong session 
session_unset();
session_destroy();
// Chuyển hướng về trang chính hoặc trang đăng nhập
header("Location:http://localhost/HoangPhungThanhDat_ltwed/");
exit();
?>
