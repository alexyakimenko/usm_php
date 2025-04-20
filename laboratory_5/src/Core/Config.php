<?php

namespace App\Core;

class Config {
    /**
     * The directory separator for the current operating system.
     */
    public const string sep = DIRECTORY_SEPARATOR;

    /**
     * The root directory of the application.
     */
    public const string rootDir = __DIR__ . self::sep . '..' . self::sep . '..';

    private const string configDir = self::rootDir . self::sep . 'config';

    /**
     * The directory where the templates are stored.
     */
    public const string templateDir = self::rootDir . self::sep . 'templates';

    /**
     * The directory where the templates are stored.
     */
    public const string dataDir = self::rootDir . self::sep . 'data';

    private static array $config = [];

    /**
     * Loads configuration files from the config directory.
     *
     * @return void
     */
    public static function load(): void {
        $configFiles = array_diff(scandir(self::configDir), ['.', '..']);

        foreach ($configFiles as $file) {
            $key = pathinfo($file, PATHINFO_FILENAME);
            self::$config[$key] = require_once self::configDir . self::sep . $file;
        }
    }

   /**
    * Retrieves a configuration value using a dot notation key.
    *
    * @param string $key The dot notation key to retrieve the configuration value.
    * @return mixed The configuration value.
    */
   public static function get(string $key): mixed {
       $keys = explode('.', $key);

       $config = self::$config;

       foreach ($keys as $key) {
           $config = $config[$key];
       }

       return $config;
   }
}