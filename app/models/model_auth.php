<?php
// Перменовать все классы в CamelCase в соответсвии со стандартом psr
class Model_auth extends Model
{

/*
    public function get_data()
    {
        return array(

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
        );
    }*/

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