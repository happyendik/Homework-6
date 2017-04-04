<!DOCTYPE html>
<html>
<head>
    <title>Настройка базы данных</title>
</head>
<body>

<h3>Настройка...</h3>

<?php
// если ты вынес зачем это осталось? этот файл тоже должен использывать настройки из конфигурационного файла
$db_host = 'localhost';
$db_name = 'Homework_3';
$db_user = '';
$db_pass = '';
function queryMysql($query)
{
    global $connection;
    $result = $connection->query($query);
    if (!$result) {
        die ('Ошибка при выполнении запроса -> '. $connection->error);
    }
    return $result;
}
function createDATABASE($name)
{
    queryMysql("CREATE DATABASE IF NOT EXISTS $name CHARACTER SET utf8 COLLATE utf8_unicode_ci");
    echo "База данных '$name' создана или уже существовала<br>";
}
function createTable($name, $query)
{
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query) ENGINE MyISAM");
    echo "Таблица '$name' создана или уже существовала<br>";
}

$connection = new mysqli($db_host, $db_user, $db_pass);
if ($connection->connect_error) {
    die ('Ошибка ' . $connection->connect_errno . ' при подключении базы данных.<br>Описание: '. $connection->connect_error);
}
createDATABASE($db_name);
$connection->close();
?>

<br>...Этап создания БД завершен!<br><br>

<?php
$connection = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($connection->connect_error) {
    die ('Ошибка ' . $connection->connect_errno . ' при подключении базы данных.<br>Описание: '. $connection->connect_error);
}
createTable('members', 'id INT UNSIGNED AUTO_INCREMENT KEY,
                        login VARCHAR(16),
                        password VARCHAR(32) NOT NULL');
createTable('member_info', 'member_login VARCHAR(16),
                            name VARCHAR(32),
                            age INT(3) UNSIGNED,
                            description TEXT(100),
                            photo VARCHAR(32)');
$connection->close();
?>

<br>...Этап создания таблицы завершен!

</body>
</html>