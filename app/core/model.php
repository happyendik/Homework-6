<?php


class Model
{
    /*  почему-то не получилось установить соединение через константы
    const DB_HOST = '127.0.0.1::3306';
    const DB_NAME = 'Homework_3';
    const DB_USER = 'root';
    const DB_PASS = '';
    */
    public $db_host = 'localhost';
    public $db_name = 'Homework_3';
    public $db_user = 'root';
    public $db_pass = '';
    // вынести коныигурационные данные в отдельный файл
    public $connection;

    public $statusModel = array();

    // в конструкторе открываем соединение с БД, в дестректоре закрываем
    public function __construct()
    {
        $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        if ($this->connection->connect_error) {
            die ('Ошибка ' . $this->connection->connect_errno .
                ' при подключении базы данных.<br>Описание: ' .
                $this->connection->connect_error);
        } else {
            array_push($this->statusModel, 'Соединение с БД успешно установлено');
        }
    }

    // зачем мертвый метод?
    public function get_data()
    {
    }

    public function queryMysql($query)
    {
        $result = $this->connection->query($query);
        if (!$result) {
            die ('Ошибка при выполнении запроса -> ' . $this->connection->error);
        }
        return $result;
    }

    public function sanitizeString($var)
    {
        $var = strip_tags($var);
        $var = htmlentities($var);
        $var = stripslashes($var);
        return $this->connection->real_escape_string($var);
    }

    public function __destruct()
    {
        $this->connection->close();
    }


}