<?php

namespace App\Controllers;

use App\Core\Config;
use App\Core\DB\PDODatabase;
use App\Core\Http\Request;
use App\Core\Template;

class MainController
{
    /**
     * Renders the main index view.
     *
     * @return void
     */
    public static function index(Request $request): void {

        $page = $request->params['page'] ?? 0;
        $limit = 4;
        $maxPage = ceil(PDODatabase::Count('recipes') / $limit);

        if(!is_numeric($page) || $page < 0) {
            $page = 0;
        }
        if($page >= $maxPage) {
            $page = $maxPage - 1;
        }

        $offset = $page * $limit;

        $recipes = PDODatabase::Fetch("SELECT * FROM recipes LIMIT $limit OFFSET $offset");

        Template::render('index', ['recipes' => $recipes, 'page' => $page]);
    }
}