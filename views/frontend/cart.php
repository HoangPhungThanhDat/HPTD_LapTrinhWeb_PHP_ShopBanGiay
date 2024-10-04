<?php
session_start();
$cart_content = $_SESSION['cart'] ?? [];


?>

<?php require_once "views/frontend/header.php"; ?>
<main>
    <div class="container my-4">
        <h1 class="fs-3 text-center text-success">Giỏ Hàng Của Tôi</h1>
        <?php if (count($cart_content) == 0): ?>
            <h4 class="text-center my-4">Chưa có sản phẩm nào trong giỏ hàng!</h4>
        <?php else: ?>
            <form action="index.php?option=capnhatcart" method="POST">
                <table class="table table-bordered">
                    <?php $totalMoney = 0; ?>
                    <thead>
                        <tr>
                            <th style="width: 30px" class="text-center">ID</th>
                            <th style="width: 30px" class="text-center">Hình</th>
                            <th>Tên sản phẩm</th>
                            <th class="text-center">Giá</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-center">Thành tiền</th>
                            <th style="width: 90px" class="text-center">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart_content as $item): ?>
                            <?php
                                $item_total = $item['price'] * $item['qty'];
                                $totalMoney += $item_total;
                            ?>
                            <tr>
                                <td class="text-center"><?= htmlspecialchars($item['id']); ?></td>
                                <td class="text-center">
                                    <img class="img-fluid" src="public/images/product/<?= htmlspecialchars($item['thumbnail']); ?>" alt="<?= htmlspecialchars($item['name']); ?>">
                                </td>
                                <td><?= htmlspecialchars($item['name']); ?></td>
                                <td class="text-end"><?= number_format($item['price']); ?>đ</td>
                                <td class="text-center">
                                    <input type="number" name="qty[<?= htmlspecialchars($item['id']); ?>]" style="width:60px" value="<?= htmlspecialchars($item['qty']); ?>" min="1">
                                </td>
                                <td class="text-end"><?= number_format($item_total); ?>đ</td>
                                <td class="text-center">
                                    <a href="index.php?option=cartdelete&id=<?= htmlspecialchars($item['id']); ?>" class="text-danger p-2">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-end">Tổng:</th>
                            <th colspan="2" class="text-end">
                                <strong><?= number_format($totalMoney); ?>đ</strong>
                            </th>
                        </tr>
                    </tfoot>
                </table>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">Cập Nhật Giỏ Hàng</button>
                    <a href="index.php?option=checkout" class="btn btn-success">Thanh Toán</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</main>

<?php require_once "views/frontend/footer.php"; ?>
