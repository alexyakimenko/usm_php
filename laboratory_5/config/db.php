<?php

return [
    'driver' => 'mysql',
    'host' => 'localhost',
    'port' => 3306,
    'database' => $_ENV['MYSQL_DATABASE'],
    'username' => $_ENV['MYSQL_USER'],
    'password' => $_ENV['MYSQL_PASSWORD'],
    'charset' => 'utf8',
];
