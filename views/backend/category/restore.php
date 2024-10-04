<?php
require_once  "../Models/Category.php";
$category = new Category();
$id= $_REQUEST ['id'];
// echo $id;
$row = $category->getRow($id);
if ($row == false){
    set_flash('message', ['type' => 'danger', 'msg' => 'Thông tin không hợp lệ !']);
    header("Location: index.php?option=category");
}
else{
    $data=[
        'status'=>2,
        'updated_at'=>date('y-m-d H:i:s'),
        'updated_by'=> $_SESSION['user_id']??1,
    ];
    $category->update($data,$id);
    set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật khôi phục thành công']);
    header("Location: index.php?option=category");
}


