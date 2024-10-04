<?php
require_once  "../Models/User.php";
$user = new User();
$id= $_REQUEST ['id'];
// echo $id;
$row = $user->getRow($id);

if ($row == false){
    set_flash('message', ['type' => 'danger', 'msg' => 'Thông tin không hợp lệ  !']);
    header("Location: index.php?option=user");
}
else{

    if(file_exists('../public/images/user/' .$row['thumbnail']))
    {
        unlink('../public/images/user/' .$row['thumbnail']);
    }
    
    $user->delete($id);
    
    set_flash('message', ['type' => 'success', 'msg' => 'Bạn dã xóa vĩnh viễn thành công']);
    header("Location: index.php?option=user&cat=trash");
} 

