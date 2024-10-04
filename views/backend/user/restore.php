<?php
require_once  "../Models/User.php";
$user = new User();
$id= $_REQUEST ['id'];
// echo $id;
$row = $user->getRow($id);
if ($row == false){
    set_flash('message', ['type' => 'danger', 'msg' => 'Thông tin không hợp lệ !']);
    header("Location: index.php?option=user");
}
else{
    $data=[
        'status'=>2,
        'updated_at'=>date('y-m-d H:i:s'),
        'updated_by'=> $_SESSION['user_id']??1,
    ];
    $user->update($data,$id);
    set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật khôi phục thành công']);
    header("Location: index.php?option=user");
}


