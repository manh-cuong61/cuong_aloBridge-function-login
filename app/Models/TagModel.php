<?php
namespace App\Models;


class TagModel extends BaseModel
{
    public function get(){
        $sql = "SELECT id, name FROM tags LIMIT 5";
        $stmt = $this->excuteSql($sql)['stmt'];
        $result = $stmt->fetchAll();

        return $result;
    }
}
