<?php
class Brand extends Database
{
    private $table = 'hptd_brand';   
    function __construct()
    {
        parent::__construct(); //database
    }

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
                $sql .= " WHERE status = :status";
                break;
            }
        }
        $sql .= " ORDER BY created_at DESC";
        return $this->getAll($sql, ['status' => $status]); 
    }

    public function getRow($id)
    {
        if(is_numeric($id))
        {
            $sql = "SELECT * FROM $this->table WHERE id = '$id'";  
        }
        else{
            $sql = "SELECT * FROM $this->table WHERE slug = '$id'";  
        }
        return $this->getOne($sql); 
    }

    public function insert($data)
{
    $strf = implode(",", array_keys($data));
    $strv = ":" . implode(", :", array_keys($data));

    $sql = "INSERT INTO $this->table($strf) VALUES($strv)";
    return $this->insertDB($sql, $data);
}


    public function update($data, $id)
    {
        $strset = '';
        foreach ($data as $f => $v) {
            $strset .= $f . "='$v', ";
        }
        $strset = trim(trim($strset), ', ');

        $sql = "UPDATE $this->table SET $strset WHERE id = '$id'";
       
        return $this->updateDB($sql);
    }
//xoa
    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        return $this->deleteDB($sql, ['id' => $id]);
    }
    //---list_category_by_parent_id
    function list_category_by_parentid($parentid=0)
    {
        $sql = "SELECT * FROM $this->table WHERE parent_id = '$parentid' AND status='1' 
        ORDER BY sort_order ASC ";
        return $this->getAll($sql);
    }





    public function list_brand_all() {
        $sql = "SELECT * FROM hptd_brand"; // Sửa lại theo tên bảng thực tế của bạn
        return $this->getAll($sql);
    }

    // // Hàm lấy thương hiệu theo ID cha
    // public function list_brand_by_parentid($parentid) {
    //     $sql = "SELECT * FROM hptd_brand WHERE parent_id = :parentid"; // Sửa lại theo tên cột thực tế của bạn
    //     $this->db->setQuery($sql);
    //     return $this->loadAllRows(['parentid' => $parentid]);
    // }
    function list_brand_by_parentid($parentid=0)
    {
        $sql = "SELECT * FROM $this->table WHERE  status='1' 
        ORDER BY sort_order ASC ";
        return $this->getAll($sql);
    }

}
