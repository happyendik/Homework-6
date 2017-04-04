<?php
class ModelFilelist extends Model
{
    public function showInformationList()
    {
        //$member_login = $_SESSION['login'];
        $result = $this->queryMysql("SELECT * FROM member_info");
        $arr = [];
        while ($row = $result->fetch_assoc()) {
            array_push($arr, $row);
        }
        return $arr;
    }

    public function deleteUser($delete)
    {
        if  (!empty($delete)) {
            $this->queryMysql("UPDATE member_info SET photo = NULL WHERE photo='$delete'");
        } else {
            array_push($this->statusModel, 'Картинку удалить не получилось!');
        }
    }
}
