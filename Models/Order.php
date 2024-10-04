<?php
class Order extends Database
{
    private $table = 'hptd_order';   
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
        $strf = '';
        $strv = '';
        foreach ($data as $f => $v) {
            $strf .= "$f,";
            $strv .= "'" . $v . "', ";
        }
        $strf = trim($strf, ',');
        $strv = trim($strv, ', ');

        $sql = "INSERT INTO $this->table($strf) VALUES($strv)";
        return $this->insertDB($sql);
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
}
?>
