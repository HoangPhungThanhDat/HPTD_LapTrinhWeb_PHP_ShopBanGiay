<?php
require_once 'application/Database.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Kiểm tra mật khẩu xác nhận
    if ($password !== $confirm_password) {
        $error = "Mật khẩu không khớp!";
    } else {
        // Xử lý hình ảnh tải lên
        $profile_picture = null;
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
            $fileName = $_FILES['profile_picture']['name'];
            $fileSize = $_FILES['profile_picture']['size'];
            $fileType = $_FILES['profile_picture']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            
            // Cấu hình cho phép các định dạng hình ảnh
            $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
            
            if (in_array($fileExtension, $allowedExtensions)) {
                $uploadFileDir = 'public/images/user/';
                $dest_path = $uploadFileDir . $fileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $profile_picture = $fileName;
                } else {
                    $error = "Có lỗi xảy ra khi tải lên hình ảnh.";
                }
            } else {
                $error = "Định dạng hình ảnh không hợp lệ.";
            }
        }

        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            // kết nối
            $db = new Database();
            $conn = $db->getConnection();

            // thực hiện truy vấn
            $stmt = $conn->prepare("INSERT INTO hptd_user (name, username, phone, email, password, thumbnail) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $username, $phone, $email, $hashed_password, $profile_picture]);

            $success = "Đăng ký thành công!";
        } catch (PDOException $e) {
            $error = "Lỗi: " . $e->getMessage();
        }
    }
}
?>
<?php require_once "views/frontend/header.php";?>
<style>
    body {
        background-color: #f8f9fa;
    }
    .register-container {
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .register-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    .form-group input {
        height: 40px;
        margin-bottom: 15px;
        border-radius: 5px;
        width: 100%;
    }
    .btn-primary {
        width: 100%;
        height: 45px;
        border-radius: 5px;
    }
    .alert {
        display: none;
    }
</style>
</head>
<body>
    <div class="register-container">
        <h2>Tạo Tài Khoản</h2>
        <form action="index.php?option=register" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Họ và tên</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ tên" required>
            </div>
            <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
            </div>
            <div class="form-group">
                <label for="phone">Điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Xác nhận mật khẩu</label>
                <input type="password" class="form-control" id="confirm-password" name="confirm_password" placeholder="Nhập lại mật khẩu" required>
            </div>
            <div class="form-group">
                <label for="profile-picture">Ảnh đại diện</label>
                <input type="file" class="form-control" id="profile-picture" name="profile_picture" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Đăng ký</button>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (isset($success)): ?>
                        <?php echo $success; ?>
                    <?php elseif (isset($error)): ?>
                        <?php echo $error; ?>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

<?php require_once "views/frontend/footer.php";?>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        <?php if (isset($success) || isset($error)): ?>
            $('#notificationModal').modal('show');
        <?php endif; ?>
    });
</script>
</body>
</html>
