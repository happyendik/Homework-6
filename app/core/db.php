<?php

class DB
{
    public $dbHost = 'localhost';
    public $dbName = 'Homework_3';
    public $dbUser = 'root';
    public $dbPass = '';

    public $connection;

    public function __construct()
    {
        $this->connection = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
        if ($this->connection->connect_error) {
            die ('Ошибка ' . $this->connection->connect_errno .
                 ' при подключении базы данных.<br>Описание: ' .
                 $this->connection->connect_error);
        }
    }
}