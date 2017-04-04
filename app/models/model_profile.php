<?php
//require_once 'app/core/route.php';

class Model_profile extends Model
{
    //проверяем доступ к данной странице. Для незарегистрированного пользователя она закрыта
    public function checkAccess()
    {
        if (!isset($_SESSION['login'])){
            Route::ErrorPage404();
            exit();
        }
    }

    public function showProfileInformation()
    {
            $login = $_SESSION['login'];
            echo '<br>Данные пользователя:';
            $result = $this->queryMysql("SELECT * FROM member_info WHERE member_login='$login'");
            $row = $result->fetch_assoc();
            echo "
                    <table class=\"table table-bordered\">
                         <tr>
                        <td>{$row['name']}</td>
                        <td>{$row['age']}</td>
          <td>{$row['description']}</td>
          <td><img src=\"/photos/{$row['photo']}\" alt=\"\"></td>
    </tr>
    </table>
 ";
    }

    public function checkImageDir()
    {
        if (!file_exists('/photos')) {
            mkdir('photos', 0700);  //TODO проверить, работает это или нет
            echo 'Создана папка photos.<br>';
        }
    }

    function addProfileImage()
    {
        //  например мне может потребоваться валидация изображения
        // и resize в другом месте
        // придеться дублировать еще раз код потому что model profile не будет отвечать моим требование
        // так почему бы нам не выделить этот фукционал в отдельное место
        // трейт например , и подключить его в эту модель и самое главное мы сможем его использывать везде
        // как мысль?
        $this->checkImageDir();
        $login = $_SESSION['login'];
        if ($_FILES) {
            switch ($_FILES['photo']['type']) {
                case 'image/jpeg':
                    $ext = 'jpg';
                    break;
                case 'image/gif':
                    $ext = 'gif';
                    break;
                case 'image/png':
                    $ext = 'png';
                    break;
                default:
                    $ext = '';
                    break;
            }
            if ($ext) {
                $photo = "$login.$ext";
                $saveTo = "photos/$photo";
                move_uploaded_file($_FILES['photo']['tmp_name'], $saveTo);
                switch ($ext) {
                    case 'jpg': $src = imagecreatefromjpeg($saveTo); break;
                    case 'gif': $src = imagecreatefromgif($saveTo); break;
                    case 'png': $src = imagecreatefrompng($saveTo); break;
                }
                list($w, $h) = getimagesize($saveTo);
                $max = 200;
                $tw = $w;
                $th = $h;
                if ($w > $h && $max < $h) {
                    $th = $max / $w * $h;
                    $tw = $max;
                } elseif ($h > $w && $max < $h) {
                    $tw = $max / $h * $w;
                    $th = $max;
                } elseif ($max < $w) {
                    $tw = $th = $max;
                }
                $tmp = imagecreatetruecolor($tw, $th);
                imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
                imagejpeg($tmp, $saveTo);
                imagedestroy($tmp);
                imagedestroy($src);
                //stop
                return $photo;
            } else {
                echo "Неприемлемый файл изображения";
            }
        } else {
            echo "Загрузки фотграфии профиля не произошло";
        }
    }

    public function postHandler()
    {
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
                    $photo = $this->addProfileImage();
                    $this->queryMysql("UPDATE member_info SET name = '$name', age = '$age', description = '$desc', photo = '$photo' WHERE member_login = '$login'");
                } else {
                    $photo = $this->addProfileImage();
                    $this->queryMysql("INSERT INTO member_info VALUES ('$login', '$name', '$age', '$desc', '$photo')");
                }
            }
        }
    }



}