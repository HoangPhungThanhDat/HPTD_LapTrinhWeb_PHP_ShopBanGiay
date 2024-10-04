<?php
require_once "../Models/Order.php";
$order = new Order();
$id = $_REQUEST['id'];
$row = $order->getRow($id);
if ($row == false) {
set_flash('message', ['type' => 'danger', 'msg' => 'Thông tin không hợp lệ!']);
 header("Location:index.php?option=order");
} else {

$order->delete($id);
set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
 header("Location:index.php?option=order&cat=trash");
}