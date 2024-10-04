<?php
session_start();
require_once 'application/Database.php'; // Kết nối tới cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST['username']; // Người dùng có thể nhập email hoặc username
    $password = $_POST['password'];

    try {
        // Kết nối
        $db = new Database();
        $conn = $db->getConnection();

        // Kiểm tra xem input là email hay username
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            // Nếu là email
            $stmt = $conn->prepare("SELECT * FROM hptd_user WHERE email = ?");
        } else {
            // Nếu là username
            $stmt = $conn->prepare("SELECT * FROM hptd_user WHERE username = ?");
        }
        
        $stmt->execute([$input]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra mật khẩu
        if ($user && password_verify($password, $user['password'])) {
            // Lưu tên người dùng vào session
            $_SESSION['username'] = $user['username'];

            // Lưu tên người dùng vào cookie (tồn tại trong 30 ngày)
            setcookie("username", $user['username'], time() + (86400 * 30), "/");

            // Chuyển hướng đến trang chính
            header("Location: http://localhost/HoangPhungThanhDat_ltwed/");
            exit();
        } else {
            $error = "Tên đăng nhập hoặc mật khẩu không đúng";
        }
    } catch (PDOException $e) {
        $error = "Lỗi: " . $e->getMessage();
    }
}

?>
<section>
    <div class="form-box">
        <div class="form-value">
            <form action="index.php?option=dangnhap" method="post">
                <h2>ĐĂNG NHẬP</h2>
                <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="text" name="username" placeholder="Username" required />
                    <label for="username">Username</label>
                </div>
                <div class="inputbox">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="password" placeholder="Password" required />
                    <label for="password">Password</label>
                </div>
                <div class="forget">
                    <label for="remember"><input type="checkbox" name="remember">Remember Me</label>
                </div>
                <button type="submit" name="LOGIN">Đăng Nhập</button>
            </form>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        <?php if (isset($error)): ?>
            alert('<?php echo $error; ?>');
        <?php endif; ?>
    });
</script>

<style>
    /* CSS giữ nguyên như bạn đã cung cấp */
    * {
        margin: 0;
        padding: 0;
        font-family: 'poppins', sans-serif;
    }
    
    section {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        width: 100%;
        background: url("public/image/h1.png"); 
        background-position: center;
        background-size: cover;
    }
    
    .form-box {
        position: relative;
        width: 400px;
        height: 450px;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, 0.5);
        border-radius: 20px;
        backdrop-filter: blur(15px);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    h2 {
        font-size: 2em;
        color: #fff;
        text-align: center;
    }
    
    .inputbox {
        position: relative;
        margin: 30px 0;
        width: 310px;
    }
    
    .inputbox label {
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-50%);
        color: #fff;
        font-size: 1em;
        pointer-events: none;
        transition: .5s;
    }
    
    input:focus ~ label,
    input:valid ~ label,
    input:not(:placeholder-shown) ~ label {
        top: -5px;
        font-size: 0.8em;
    }
    
    .inputbox input {
        width: 90%;
        height: 50px;
        background: transparent;
        border: none;
        outline: none;
        font-size: 1em;
        padding: 0 35px 0 5px;
        color: #fff;
        border-bottom: 2px solid #fff;
    }
    
    .inputbox ion-icon {
        position: absolute;
        right: 8px;
        color: #fff;
        font-size: 1.2em;
        top: 20px;
    }
    
    .forget {
        margin: -15px 0 15px;
        font-size: .9em;
        color: #fff;
        display: flex;
        justify-content: space-between;
    }
    
    .forget label input {
        margin-right: 3px;
    }
    
    .forget label a {
        color: #fff;
        text-decoration: none;
    }
    
    .forget label a:hover {
        text-decoration: underline;
    }
    
    button {
        width: 100%;
        height: 40px;
        border-radius: 40px;
        background: #fff;
        border: none;
        outline: none;
        cursor: pointer;
        font-size: 1em;
        font-weight: 600;
    }
    
    .register {
        font-size: .9em;
        color: #fff;
        text-align: center;
        margin: 25px 0 10px;
    }
    
    .register p a {
        text-decoration: none;
        color: #fff;
        font-weight: 600;
    }
    
    .register p a:hover {
        text-decoration: underline;
    }
</style>
