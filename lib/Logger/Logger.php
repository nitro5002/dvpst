<?php

namespace Logger;

use \Monolog\Logger as LoggerMonolog;
use \Monolog\Handler\StreamHandler;

class Logger extends LoggerMonolog {

    public function __construct($name) {
        parent::__construct($name);
        $this->pushHandler(new StreamHandler(LOGS_PATH . DIRECTORY_SEPARATOR . $name, Logger::WARNING));
    }

}