<?php

class DB
{
    /*
    public $dbHost = 'localhost';
    public $dbName = 'Homework_3';
    public $dbUser = 'root';
    public $dbPass = '';
*/
    const DBHOST = 'localhost';
    const DBNAME = 'Homework_3';
    const DBUSER = 'root';
    const DBPASS = 'y2uDk7L3IP';

    public $connection;

    public function __construct()
    {
        $this->connection = new mysqli(self::DBHOST, self::DBUSER, self::DBPASS, self::DBNAME);
        if ($this->connection->connect_error) {
            die ('Ошибка ' . $this->connection->connect_errno .
                 ' при подключении базы данных.<br>Описание: ' .
                 $this->connection->connect_error);
        }
    }
}