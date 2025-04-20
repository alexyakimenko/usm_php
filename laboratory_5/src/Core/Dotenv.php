<?php

namespace App\Core;

class Dotenv
{
    /**
     * @var string The directory where the `.env` file is located.
     */
    private static string $envDir = Config::rootDir;

    /**
     * Loads environment variables from the `.env` file.
     *
     * @return void
     */
    public static function load(): void {
        \Dotenv\Dotenv::createImmutable(self::$envDir)->load();
    }
}