<?php
require_once  "../Models/Order.php";
$order = new Order();
$id= $_REQUEST ['id'];
// echo $id;
$row = $order->getRow($id);
if ($row == false){
    set_flash('message', ['type' => 'danger', 'msg' => 'Cập nhật trạng thái không thành công']);
    header("Location: index.php?option=order");
}
else{
    $data=[
        'status'=>$row['status'] ==1 ? 2 : 1,
        'updated_at'=>date('y-m-d H:i:s'),
        'updated_by'=>1,
    ];
    $order->update($data,$id);
    set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật trạng thái thành công']);
    header("Location: index.php?option=order");
}

