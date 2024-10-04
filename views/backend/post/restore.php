<?php
require_once  "../Models/Post.php";
$post = new Post();
$id= $_REQUEST ['id'];
// echo $id;
$row = $post->getRow($id);
if ($row == false){
    set_flash('message', ['type' => 'danger', 'msg' => 'Thông tin không hợp lệ !']);
    header("Location: index.php?option=post");
}
else{
    $data=[
        'status'=>2,
        'updated_at'=>date('y-m-d H:i:s'),
        'updated_by'=> $_SESSION['user_id']??1,
    ];
    $post->update($data,$id);
    set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật khôi phục thành công']);
    header("Location: index.php?option=post");
}


