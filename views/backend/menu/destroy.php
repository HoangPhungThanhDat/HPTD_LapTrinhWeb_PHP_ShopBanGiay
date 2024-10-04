<?php
require_once "../Models/Menu.php";
$menu = new Menu();
$id = $_REQUEST['id'];
$row = $menu->getRow($id);
if ($row == false) {
set_flash('message', ['type' => 'danger', 'msg' => 'Thông tin không hợp lệ!']);
 header("Location:index.php?option=menu");
} else {
if (file_exists('../public/images/menu/' .$row['thumbnail'])) 
{ unlink('../public/images/menu/'.$row['thumbnail']);
}
$menu->delete($id);
set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
 header("Location:index.php?option=menu&cat=trash");
}