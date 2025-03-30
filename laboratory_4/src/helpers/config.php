<?php

const ROOT_DIR = __DIR__ . '/../../';
const CONFIG_DIR = ROOT_DIR . '/config/';

$config = [];
function configLoad(string $filename): void {
    global $config;
    $key = pathinfo($filename, PATHINFO_FILENAME);
    $config[$key] = require CONFIG_DIR . $filename;
}

function configGet(string $key): mixed {
    global $config;
    $keys = explode('.', $key);
    $value = $config;

    foreach ($keys as $k) {
        if (isset($value[$k])) {
            $value = $value[$k];
        } else {
            return null;
        }
    }

    return $value;
}