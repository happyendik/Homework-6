<?php

class Model_reg extends Model
{
    public function get_data()
    {
        /*return array(

            array(
                'Year' => '2012',
                'Site' => 'http://DunkelBeer.ru',
                'Description' => 'Промо-сайт темного пива Dunkel от немецкого производителя Löwenbraü выпускаемого в России пивоваренной компанией "CАН ИнБев".'
            ),
            array(
                'Year' => '2012',
                'Site' => 'http://ZopoMobile.ru',
                'Description' => 'Русскоязычный каталог китайских телефонов компании Zopo на базе Android OS и аксессуаров к ним.'
            ),
            // todo
        );*/
    }

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
                    array_push($this->statusModel, 'Данные должны записаться<br>');
                    header('Location: /profile/index');
                    exit();
                }
            }
        }
    }

}