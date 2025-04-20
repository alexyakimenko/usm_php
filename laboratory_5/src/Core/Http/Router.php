<?php

namespace App\Core\Http;

use App\Core\Config;

class Router
{
    /**
     * Loads the routes from the configuration and merges them with the existing routes.
     *
     * @return void
     */
    public static function load(): void {
        $config_routes = Config::get('routes');
        Route::setRoutes(
            array_merge_recursive(Route::getRoutes(), $config_routes)
        );
    }
}