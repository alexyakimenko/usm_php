<?php

const STORAGE_DIR = __DIR__ . '/../../storage/';

/**
 * Load data from a JSON file.
 *
 * @param string $filename The name of the file to load.
 * @return array The data loaded from the file.
 */
function jsonDbLoad(string $filename): array {
    $filePath = STORAGE_DIR . $filename;

    if (!file_exists($filePath)) {
        return [];
    }

    $json = file_get_contents($filePath);
    return json_decode($json, true);
}

/**
 * Save data to a JSON file.
 *
 * @param string $filename The name of the file to save.
 * @param array $data The data to save.
 * @return void
 */
function jsonDbSave(string $filename, array $data): void {
    $filePath = STORAGE_DIR . $filename;

    file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));
}

/**
 * Append data to a JSON file.
 *
 * @param string $filename The name of the file to append to.
 * @param array $data The data to append.
 * @return void
 */
function jsonDbAppend(string $filename, array $data): void {
    $filePath = STORAGE_DIR . $filename;

    if (!file_exists($filePath)) {
        jsonDbSave($filename, []);
    }

    $existingData = jsonDbLoad($filename);
    $existingData[] = $data;
    jsonDbSave($filename, $existingData);
}

