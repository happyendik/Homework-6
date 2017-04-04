<?php

class ModelReg extends Model
{
    public function postHandler()
    {
        if ($_POST['login']) {
            $login = $this->sanitizeString($_POST['login']);
            $password1 = $this->sanitizeString($_POST['password1']);
            $password2 = $this->sanitizeString($_POST['password2']);
            if ($login == '' || $password1 == '' || $password2 == '') {
                array_push($this->statusModel, 'Данные введены не во все поля. Попробуйте еще раз.<br><br>');
            } elseif ($password1 !== $password2) {
                array_push($this->statusModel, 'Вы ввели разные пароли. Попробуйте еще раз.<br><br>');
            } else {
                $this->result = $this->queryMysql("SELECT * FROM members WHERE login='$login'");
                if ($this->result->num_rows) {
                    array_push($this->statusModel, 'Данный пользователь уже существует.<br><br>');
                } else {
                    $password = hash('ripemd128', "$password1");
                    $this->queryMysql("INSERT INTO members VALUES(0, '$login', '$password');");
                    $_SESSION['login'] = $login;
                    array_push($this->statusModel, 'Данные сохранены.<br>');
                    header('Location: /profile/index');
                    exit();
                }
            }
        }
    }

}