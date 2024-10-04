<?php
session_start();
require_once 'application/Database.php'; // Bao gồm file chứa lớp Database

// Tạo đối tượng của lớp Database
$db = new Database();

$response = [];
if (isset($_POST['name'], $_POST['email'], $_POST['content'], $_POST['phone'], $_POST['title'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $title = $_POST['title']; // Đảm bảo form có tên tiêu đề
    $content = $_POST['content'];
    $phone = $_POST['phone'];

    // Câu lệnh SQL để thêm thông tin liên hệ
    $sql = "INSERT INTO `hptd_contact` (name, email, title, content, phone) VALUES (?, ?, ?, ?, ?)";

    // Dữ liệu cần chèn vào
    $data = [$name, $email, $title, $content, $phone];

    try {
        // Thực hiện truy vấn chèn dữ liệu vào cơ sở dữ liệu
        $db->insertDB($sql, $data);

        // Phản hồi thành công
        $response['success'] = true;
        $response['message'] = 'Cảm ơn bạn! Thông tin liên hệ của bạn đã được gửi thành công. Chúng tôi sẽ sớm liên hệ lại với bạn.';
    } catch (PDOException $e) {
        // Xử lý lỗi PDOException
        $response['success'] = false;
        $response['message'] = 'Có lỗi xảy ra: ' . $e->getMessage();
    }

    echo json_encode($response);
    exit();
}
?>
<?php require_once "views/frontend/header.php";?>
<style>
    /* General Styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
        color: #333;
    }

    .container {
        margin-top: 50px;
    }

    /* Header Styles */
    header h1.contact-title {
        font-size: 36px;
        color: #007bff;
        font-weight: bold;
    }

    header p {
        font-size: 18px;
        color: #555;
        margin-top: 10px;
    }

    /* Contact Information Styles */
    .contact-info {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .contact-info h2.contact-title {
        font-size: 30px;
        color: #333;
    }

    .contact-info h4 {
        font-size: 18px;
        color: #555;
        margin-bottom: 8px;
    }

    .contact-info p {
        font-size: 16px;
        color: #777;
    }

    .contact-info a {
        color: #007bff;
        text-decoration: none;
    }

    .contact-info a:hover {
        text-decoration: underline;
    }

    /* Contact Form Styles */
    .contact-form {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .contact-form h2.contact-title {
        font-size: 30px;
        color: #333;
    }

    .contact-form .form-group {
        margin-bottom: 20px;
    }

    .contact-form .form-control {
        border-radius: 5px;
        padding: 10px;
        font-size: 16px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .contact-form .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .contact-form button.btn {
        width: 100%;
        border-radius: 5px;
        padding: 10px;
        font-size: 18px;
        background-color: #007bff;
        color: #fff;
        border: none;
        transition: background-color 0.3s ease;
    }

    .contact-form button.btn:hover {
        background-color: #0056b3;
    }

    /* Icon Styles */
    .contact-info i {
        color: #007bff;
        font-size: 20px;
        margin-right: 10px;
    }

    .contact-info h4.d-flex {
        align-items: center;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .contact-info, .contact-form {
            margin-bottom: 30px;
        }

        header h1.contact-title {
            font-size: 28px;
        }

        header p {
            font-size: 16px;
        }
    }
</style>
<body>
    <div class="container">
        <!-- Header -->
        <header class="text-center mb-5">
            <h1 class="contact-title">Liên Hệ Chúng Tôi</h1>
            <p>Chúng tôi luôn sẵn sàng hỗ trợ bạn. Vui lòng để lại thông tin và chúng tôi sẽ liên hệ với bạn sớm nhất có thể.</p>
        </header>
        
        <!-- Contact Information -->
        <div class="row">
            <div class="col-md-6">
                <div class="contact-info p-4 shadow-sm rounded bg-light">
                    <h2 class="contact-title mb-4">Thông Tin Liên Hệ</h2>
                    <div class="contact-address mb-4">
                        <h4 class="d-flex align-items-center"><i class="fas fa-map-marker-alt me-2"></i>Địa Chỉ</h4>
                        <p>123 Đường 22, Quận 9, Thành phố HCM, Việt Nam</p>
                    </div>
                    <div class="contact-email mb-4">
                        <h4 class="d-flex align-items-center"><i class="fas fa-envelope me-2"></i>Email</h4>
                        <p><a href="mailto:dat147714@gmail.com">dat147714@gmail.com</a></p>
                    </div>
                    <div class="contact-phone">
                        <h4 class="d-flex align-items-center"><i class="fas fa-phone me-2"></i>Số Điện Thoại</h4>
                        <p><a href="tel:+84123456789">+84 123 456 789</a></p>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="col-md-6">
                <div class="contact-form p-4 shadow-sm rounded bg-light">
                    <h2 class="contact-title mb-4">Gửi Tin Nhắn</h2>
                    <div id="response-message"></div>
                    <form id="contact-form" action="index.php?option=Contact" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề</label>
                            <input type="text" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Điện thoại</label>
                            <input type="phone" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Tin nhắn</label>
                            <textarea class="form-control" id="content" name="content" rows="2" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Gửi Liên Hệ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require_once "views/frontend/footer.php";?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#contact-form').on('submit', function(event) {
        event.preventDefault(); // Ngăn chặn hành vi gửi form mặc định

        $.ajax({
            url: $(this).attr('action'), // Lấy URL từ thuộc tính action của form
            type: 'POST',
            data: $(this).serialize(), // Serialize form data
            dataType: 'json',
            success: function(response) {
                let messageHtml;
                if (response.success) {
                    messageHtml = '<div class="alert alert-success">' + response.message + '</div>';
                } else {
                    messageHtml = '<div class="alert alert-danger">' + response.message + '</div>';
                }
                $('#response-message').html(messageHtml); // Hiển thị thông báo
                $('#contact-form')[0].reset(); // Reset form sau khi gửi
            },
            error: function(xhr, status, error) {
                $('#response-message').html('<div class="alert alert-danger">Có lỗi xảy ra, vui lòng thử lại sau!</div>');
            }
        });
    });
});
</script>
</body>
