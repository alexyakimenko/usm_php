<?php

namespace App\Core;

use App\Core\Http\Route;
use App\Core\Http\Router;

class Application {
    /**
     * Runs the application by loading the configuration and router,
     * and serving the routes.
     *
     * @return void
     */
    public function run(): void {
        Config::load();
        Router::load();

        Route::serve(function () {
            Template::render('404');
        });
    }
}