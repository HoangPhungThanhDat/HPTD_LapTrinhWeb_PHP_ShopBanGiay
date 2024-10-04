<?php
class Category extends Database
{
    private $table = 'hptd_category';   
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
    //---list_category_by_parent_id lấy danh sách các danh mục 
    function list_category_by_parentid($parentid=0)
    {
        $sql = "SELECT * FROM $this->table WHERE parent_id = '$parentid' AND status='1' 
        ORDER BY sort_order ASC ";
        return $this->getAll($sql);
    }
    

    public function count_categories_by_parentid($parentid = 0)
{
    // Xây dựng câu lệnh SQL để đếm số lượng danh mục theo parent_id và trạng thái
    $sql = "SELECT COUNT(*) AS total FROM $this->table WHERE parent_id = :parentid AND status = '1'";
    
    // Chuẩn bị câu lệnh SQL
    $stmt = $this->table->getConnection()->prepare($sql);
    
    // Gán giá trị cho tham số :parentid
    $stmt->bindValue(':parentid', $parentid, PDO::PARAM_INT);
    
    // Thực thi câu lệnh SQL
    $stmt->execute();
    
    // Trả về tổng số danh mục
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

}
