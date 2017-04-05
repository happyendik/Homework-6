<?php
require_once 'app/models/ProfileImage.php';

class ModelProfile extends Model
{
    use ProfileImage;
    //проверяем доступ к данной странице. Для незарегистрированного пользователя она закрыта

    public function showProfileInformation()
    {
        $login = $_SESSION['login'];
        $result = $this->queryMysql("SELECT * FROM member_info WHERE member_login='$login'");
        if ($row = $result->fetch_assoc()) {
echo <<<_EOF
            <br>Данные пользователя:
                    <table class="table table-bordered">
                         <tr>
                        <td>{$row['name']}</td>
                        <td>{$row['age']}</td>
          <td>{$row['description']}</td>
          <td><img src="/photos/{$row['photo']}" alt=""></td>
    </tr>
    </table>
_EOF;
        }
    }

    public function checkImageDir()
    {
        if (!file_exists('photos/')) {
            mkdir('photos/', 0777);
            echo 'Создана папка photos.<br>';
        }
    }

    public function postHandler()
    {
        $this->checkImageDir(); // проверка наличия папки
        if ($_POST['name']) {
            if ($_POST['name'] == '' ||
                $_POST['age'] == '' ||
                $_POST['desc'] == ''
            ) {
                array_push($this->statusModel, 'Введите все данные');
            } elseif (!preg_match('/[0-9]+/', $_POST['age'])) {
                array_push($this->statusModel, "Возраст должен принимать числовое значениею У вас - {$_POST['age']}");
            } else {
                $name = $this->sanitizeString($_POST['name']);
                $age = $this->sanitizeString($_POST['age']);
                $desc = $this->sanitizeString($_POST['desc']);
                $login = $_SESSION['login'];
                if ($age >= 18) {
                    array_push($this->statusModel, "Вы совершеннолетний.");
                } elseif ($age <= 0) {
                    array_push($this->statusModel, "Вы еще не родились.");
                } else {
                    array_push($this->statusModel, "Вы несовершеннолетний.");
                }
                $result = $this->queryMysql("SELECT * FROM member_info WHERE member_login = '$login'");
                if ($result->num_rows) {
                    $photo = $this->addProfileImage($login);
                    $this->queryMysql("UPDATE member_info SET name = '$name', age = '$age', description = '$desc', photo = '$photo' WHERE member_login = '$login'");
                } else {
                    $photo = $this->addProfileImage($login);
                    $this->queryMysql("INSERT INTO member_info VALUES ('$login', '$name', '$age', '$desc', '$photo')");
                }
            }
        }
    }



}