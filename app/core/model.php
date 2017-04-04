<?php

class Model
{
    public $connect;
    public $statusModel = array();

    // в Конструкторе открываем соединение с БД, в Деструкторе закрываем
    public function __construct()
    {
        $this->connect = new DB();
        array_push($this->statusModel, 'Соединение с БД успешно установлено');
    }

    public function queryMysql($query)
    {
        $result = $this->connect->connection->query($query);
        if (!$result) {
            die ('Ошибка при выполнении запроса -> ' . $this->connect->connection->error);
        }
        return $result;
    }

    public function sanitizeString($var)
    {
        $var = strip_tags($var);
        $var = htmlentities($var);
        $var = stripslashes($var);
        return $this->connect->connection->real_escape_string($var);
    }

    public function __destruct()
    {
        $this->connect->connection->close();
    }


}