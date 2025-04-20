<?php

namespace App\Controllers;

use App\Core\Config;
use App\Core\Template;

class MainController
{
    /**
     * Renders the main index view.
     *
     * @return void
     */
    public static function index(): void {
        Template::render('index');
    }
}