<?php

namespace Database;


class Database {

    public function __construct() {
        $dsn = sprintf("mysql:dbname=%s;host=%s;port=%u", DB_DBNAME, DB_HOST, DB_PORT);
        $this->db = new \PDO($dsn, DB_USER, DB_PASS);
    }

    public function getUsers() {
        $sql = sprintf("SELECT * FROM `%s`.users", DB_DBNAME);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}