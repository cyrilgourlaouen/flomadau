<?php

require_once __DIR__ . '/load_env.php';

define('DB_INFOS', [
    'host' => $_ENV['DB_HOST'],
    'port' => $_ENV['DB_PORT'],
    'dbname' => $_ENV['DB_NAME'],
    'schema' => $_ENV['DB_SCHEMA'],
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD']
]);
