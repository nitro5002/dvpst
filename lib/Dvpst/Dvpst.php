<?php

namespace Dvpst;

use \Database\Database as Db;
use \Logger\Logger;

class Dvpst {

    public function __construct(Logger $logger) {
        $this->db = new Db();
        $this->logger = $logger;
    }

    public function getUsers() {
        return $this->db->getUsers();
    }
}