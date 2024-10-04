<?php
require_once "../Models/Contact.php";
$contact = new Contact();
$id = $_REQUEST['id'];
$row = $contact->getRow($id);
if ($row == false) {
set_flash('message', ['type' => 'danger', 'msg' => 'Thông tin không hợp lệ!']);
 header("Location:index.php?option=contact");
} else {
if (file_exists('../public/images/contact/' .$row['thumbnail'])) 
{ unlink('../public/images/contact/'.$row['thumbnail']);
}
$contact->delete($id);
set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
 header("Location:index.php?option=contact&cat=trash");
}