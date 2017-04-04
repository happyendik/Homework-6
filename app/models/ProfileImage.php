<?php
trait ProfileImage
{
    public function addProfileImage($login)
    {
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
    /////////////////////////////////////////////////////////
    public function checkProfileImage()
    {
        $result = $this->queryMysql("SELECT * FROM member_info");
        while ($row = $result->fetch_assoc()) {
            $photo = $row['photo'];
            if ($row['photo'] === null) {
                $this->queryMysql("UPDATE member_info SET photo = '1.jpg' WHERE member_login='$photo'");
            }
        }
    }
///////////////////////////////////////////////////////////
}