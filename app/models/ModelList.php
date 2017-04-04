<?php
class ModelList extends Model
{
    public function showInformationList()
    {
        //$member_login = $_SESSION['login'];
        $result = $this->queryMysql("SELECT * FROM member_info ORDER BY age DESC");
        $arr = [];
        while ($row = $result->fetch_assoc()) {
            array_push($arr, $row);
        }
        return $arr;
    }

    public function deleteUser($delete)
    {
        if  (!empty($delete)) {
            $this->queryMysql("DELETE FROM member_info WHERE member_login='$delete'");
            $this->queryMysql("DELETE FROM members WHERE login='$delete'");
        } else {
            array_push($this->statusModel, 'Пользователя удалить не получилось!');
        }
    }
}
