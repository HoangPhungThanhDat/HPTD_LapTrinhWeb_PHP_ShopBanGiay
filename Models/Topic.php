<?php
class Topic extends Database
{
    private $table = 'hptd_topic';   
    function __construct()
    {
        parent::__construct(); //database
    }

    // Lấy tất cả sản phẩm
    public function getList($status)
    {
        $sql = "SELECT * FROM $this->table";
        switch ($status) {
            case 'index': {
                $sql .= " WHERE status != '0'";
                break;
            }
            case 'trash': {
                $sql .= " WHERE status = '0'";
                break;
            }
            default: {
                $sql .= " WHERE status = '$status'";
                break;
            }
        }
        $sql .= " ORDER BY created_at DESC";
        return $this->getAll($sql); 
    }

    public function getRow($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = '$id'";  
        return $this->getOne($sql); 
    }

    
     // Thêm 
     public function insert($data)
     {
         $strf = implode(",", array_keys($data));
         $strv = ":" . implode(", :", array_keys($data));
 
         $sql = "INSERT INTO $this->table($strf) VALUES($strv)";
         return $this->insertDB($sql, $data);
     }

    // Cập nhật
    public function update($data, $id)
    {
        $strset = '';
        foreach ($data as $f => $v) {
            $strset .= $f . "='" . $v . "', ";
        }
        $strset = trim($strset, ', ');

        $sql = "UPDATE $this->table SET $strset WHERE id='$id'";
        return $this->updateDB($sql);
    }

    // Xóa
    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        return $this->deleteDB($sql, ['id' => $id]);
    }


    //lấy chủ đề bài viết 
    public function list_topic_by_name()
    {
        $sql = "SELECT * FROM $this->table WHERE status='1' ORDER BY name ASC";
        return $this->getAll($sql);
    }

    function list_category_by_parentid($parentid=0)
    {
        $sql = "SELECT * FROM $this->table WHERE parent_id = '$parentid' AND status='1' 
        ORDER BY sort_order ASC ";
        return $this->getAll($sql);
    }

    function list_topic_by_parentid()
    {
    $sql = "SELECT * FROM $this->table WHERE  status='1' ORDER BY
    sort_order ASC";
    return $this->getAll($sql);
    }

}
?>
