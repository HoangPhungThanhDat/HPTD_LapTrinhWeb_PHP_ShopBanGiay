<?php
class Banner extends Database
{
    private $table = 'hptd_banner';   
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
        $sql = "SELECT * FROM $this->table WHERE id = :id";  
        return $this->getOne($sql, ['id' => $id]); 
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
            $strset .= "$f = :$f, ";
        }
        $strset = trim($strset, ', ');

        $sql = "UPDATE $this->table SET $strset WHERE id = :id";
        $data['id'] = $id;
        return $this->updateDB($sql, $data);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        return $this->deleteDB($sql, ['id' => $id]);
    }
    // banner slide frontend
    public function get_list_slide($position = 'slideshow')
    {
        // Sử dụng dấu nháy kép để biến $position được phân tích cú pháp
        $sql = "SELECT * FROM $this->table WHERE position = '$position' AND status = '1' ORDER BY sort_order ASC";
    
        return $this->getAll($sql);
    }
    
}
