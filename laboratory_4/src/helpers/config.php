<?php

const ROOT_DIR = __DIR__ . '/../../';
const CONFIG_DIR = ROOT_DIR . '/config/';

/**
 * @var array $config
 */
$config = [];

/**
 * Load configuration from a file.
 *
 * @param string $filename The name of the configuration file to load.
 * @return void
 */
function configLoad(string $filename): void {
    global $config;
    $key = pathinfo($filename, PATHINFO_FILENAME);
    $config[$key] = require CONFIG_DIR . $filename;
}

/**
 * Get a configuration value.
 *
 * @param string $key The key of the configuration value to get.
 * @return mixed The configuration value, or null if not found.
 */
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