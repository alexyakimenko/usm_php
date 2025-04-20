<?php

$env = getenv();

return [
    'driver' => 'mysql',
    'host' => 'localhost',
    'port' => 3306,
    'database' => $env['MYSQL_DATABASE'],
    'username' => $env['MYSQL_USER'],
    'password' => $env['MYSQL_PASSWORD'],
    'charset' => 'utf8',
];
