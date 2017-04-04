<?php

class ModelAuth extends Model
{
    public function postHandler()
    {
        if ($_POST['login']) {
            if ($_POST['login'] === '' || $_POST['password'] === '') {
                array_push($this->statusModel, 'Заполните все поля');
            } else {
                array_push($this->statusModel, 'it works!');
                $login = $this->sanitizeString($_POST['login']);
                $password = $this->sanitizeString($_POST['password']);
                $result = $this->queryMysql("SELECT * FROM members WHERE login='$login'");
                if ($result->num_rows) {
                    $password = hash('ripemd128', "$password");
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    if ($row['password'] === $password) {
                        $_SESSION['login'] = $_POST['login'];
                        array_push($this->statusModel, "{$_SESSION['login']} - it is session"); //потом удалить
                        array_push($this->statusModel, "{$_POST['login']} - it is post");    //потом удалить
                        header('Location: /profile/index');
                        exit();
                    }
                } else {
                    array_push($this->statusModel, 'Нет такого пользователя');
                }
            }
        }
    }
}