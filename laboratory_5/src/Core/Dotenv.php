<?php

namespace App\Core;

class Dotenv
{
    private static string $envDir = Config::rootDir;
    public static function load(): void {
        \Dotenv\Dotenv::createImmutable(self::$envDir)->load();
    }
}