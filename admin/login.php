<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/admin.css">
    <title>HỆ THỐNG ĐĂNG NHÂP</title>
</head>
<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
require_once '../application/Database.php';
require_once '../Models/User.php';

$user = new User();

if (isset($_POST['LOGIN'])) {
    // Kiểm tra và xử lý tên người dùng hoặc email
    $username = trim($_POST['username']);
    $password = sha1(trim($_POST['password'])); // Đảm bảo mật khẩu được mã hóa đúng cách

    $data = [
        'password' => $password,
        'roles' => 1,
        'status' => 1
    ];

    // Xác định xem người dùng nhập email hay tên người dùng
    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $data['email'] = $username;
    } else {
        $data['username'] = $username;
    }

    // Gọi phương thức getLogin và truyền dữ liệu vào đó
    $row_user = $user->getLogin($data);

    if ($row_user) {
        // Lưu thông tin người dùng vào session
        $_SESSION['user_id'] = $row_user['id'];
        $_SESSION['user_name'] = $row_user['name'];
        $_SESSION['user_thumbnail'] = $row_user['thumbnail'];
      
        header("Location: index.php");
        exit();
    } else {
        $error = "Tài Khoản Đăng Nhập Không Hợp Lệ ! ";
    }
}
?>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="login.php" method="post">
                    <h2>ĐĂNG NHẬP</h2>
                    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
                    <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                        <input type="text" name="username" placeholder="Username" required />
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" placeholder="Password" required />
                        <label for="">Password</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox">Remember Me</label>
                    </div>
                    <button type="submit" name="LOGIN">Đăng Nhập</button>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>

