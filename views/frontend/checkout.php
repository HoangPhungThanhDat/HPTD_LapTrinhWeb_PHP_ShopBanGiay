<?php
session_start();
require_once 'application/Database.php'; // Bao gồm file chứa lớp Database
// Tạo đối tượng của lớp Database
$db = new Database();
// Tính tổng tiền trong giỏ hàng
$totalMoney = 0;
$cart_content = $_SESSION['cart'] ?? [];

foreach ($cart_content as $item) {
    $totalMoney += $item['price'] * $item['qty'];
}

$response = [];
if (isset($_POST['name'], $_POST['email'], $_POST['address'], $_POST['phone'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $created_at = date('Y-m-d H:i:s'); 

    // Câu lệnh SQL để thêm đơn hàng
    $sql = "INSERT INTO `hptd_order` (name, email, address, phone, created_at) VALUES (?, ?, ?, ?, ?)";

    // Dữ liệu cần chèn vào
    $data = [$name, $email, $address, $phone, $created_at];

    try {
        // Thực hiện truy vấn chèn dữ liệu vào cơ sở dữ liệu
        $orderId = $db->insertDB($sql, $data);

        // Xóa giỏ hàng sau khi lưu đơn hàng
        unset($_SESSION['cart']);

        // Phản hồi thành công
        $response['success'] = true;
        $response['message'] = 'Cảm ơn bạn! Đơn hàng của bạn đã được đặt thành công. Chúng tôi sẽ sớm gửi đơn hàng đến bạn.';
    } catch (PDOException $e) {
        // Xử lý lỗi PDOException
        $response['success'] = false;
        $response['message'] = 'Có lỗi xảy ra: ' . $e->getMessage();
    }

    echo json_encode($response);
    exit();
}
?>
<?php require_once "views/frontend/header.php"; ?>

<main>
    <div class="container my-4">
        <h1 class="fs-3 text-center text-success">Đặt Hàng</h1>
        <div class="row">
            <div class="col-md-6">
                <h4>Thông tin đơn hàng</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-end">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart_content as $item): ?>
                            <?php
                            $item_total = $item['price'] * $item['qty'];
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($item['name']); ?></td>
                                <td class="text-center"><?= htmlspecialchars($item['qty']); ?></td>
                                <td class="text-end"><?= number_format($item_total); ?>đ</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-end">Tổng:</th>
                            <th class="text-end"><?= number_format($totalMoney); ?>đ</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-6">
                <h4>Nhập thông tin Đặt Hàng</h4>
                <form id="checkout-form" method="POST">
                    <input type="hidden" name="total_amount" value="<?= htmlspecialchars($totalMoney); ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <button type="submit" class="btn btn-success">Đặt Hàng</button>
                </form>
                <div id="response-message" class="mt-3"></div>
            </div>
        </div>
    </div>
</main>

<?php require_once "views/frontend/footer.php"; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#checkout-form').on('submit', function(event) {
        event.preventDefault(); // Ngăn chặn hành vi gửi form mặc định

        $.ajax({
            url: 'index.php?option=checkout', // Đảm bảo đúng đường dẫn đến file xử lý
            type: 'POST',
            data: $(this).serialize(), // Serialize form data
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#response-message').html('<div class="alert alert-success">' + response.message + '</div>');
                    $('#checkout-form').trigger('reset'); // Xóa dữ liệu trong form nếu cần
                } else {
                    $('#response-message').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function() {
                $('#response-message').html('<div class="alert alert-danger">Có lỗi xảy ra, vui lòng thử lại sau.</div>');
            }
        });
    });
});
</script>
