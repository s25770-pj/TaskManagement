<?php
class Database {
    private $connection;

    public function __construct($host, $username, $password, $database) {
        $this->connection = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public function getConnection() {
        return $this->connection;
    }
}
$db = new Database('localhost', 'root', '', 'taskmanagement');