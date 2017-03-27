<?php

$defineFromEnv = function ($name, $default = '') {
    if (defined($name)) {
        return;
    }

    if (empty(getenv($name))) {
        define($name, $default);
    } else {
        define($name, getenv($name));
    }
};

$define = function($name, $value) {
    if (defined($name)) {
        return;
    }

    define($name, $value);
};

# paths
$define('BASE_PATH', __DIR__ . '/..');
$define('LIB_PATH', BASE_PATH . '/lib');
$define('LOGS_PATH', BASE_PATH . '/logs');

# environment
$defineFromEnv('ENVIRONMENT', 'development');
$define('DEBUG', ENVIRONMENT === 'development');

# database
$defineFromEnv('DB_DBNAME', 'tests');
$defineFromEnv('DB_HOST', 'db');
$defineFromEnv('DB_USER', 'test');
$defineFromEnv('DB_PASS', 'test');
$defineFromEnv('DB_PORT', 3306);

# main autoloader
require_once BASE_PATH . '/vendor/autoload.php';