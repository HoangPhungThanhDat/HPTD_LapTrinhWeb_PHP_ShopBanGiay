<?php
require_once  "../Models/Post.php";
$post = new Post();
$id= $_REQUEST ['id'];
// echo $id;
$row = $post->getRow($id);



if ($row == false){
    set_flash('message', ['type' => 'danger', 'msg' => 'Thông tin không hợp lệ  !']);
    header("Location: index.php?option=post");
}
else{

    if(file_exists('../public/images/post/' .$row['thumbnail']))
    {
        unlink('../public/images/post/' .$row['thumbnail']);
    }
    
    $post->delete($id);
    
    set_flash('message', ['type' => 'success', 'msg' => 'Bạn dã xóa vĩnh viễn thành công']);
    header("Location: index.php?option=post&cat=trash");
} 

