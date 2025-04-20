<?php

namespace App\Controllers;

use App\Core\DB\PDODatabase;
use App\Core\Http\Request;
use App\Core\Template;
use App\Core\Validation\InputHandler;
use App\Models\Recipe;

class RecipeController
{
    public static function index(Request $request): void {
        $id = $request->params['id'] ?? 1;

        $recipe = PDODatabase::Read('recipes', $id);
        $category = PDODatabase::Read('categories', $recipe['category']);

        $recipe['category'] = $category['name'];
        $recipe['tags'] = explode(',', $recipe['tags']);
        $recipe['steps'] = explode(',', $recipe['steps']);
        $recipe['ingredients'] = explode(',', $recipe['ingredients']);

        Template::render('recipe', ['recipe' => $recipe]);
    }

    public static function create(): void {
        Template::render('create');
    }

    public static function new_recipe(Request $request): void {
        $recipeDto = $request->body;

        $filtered = InputHandler::filter($recipeDto, Recipe::rules());

        $errors = InputHandler::validate($filtered, Recipe::rules());

        if(empty($errors)) {
            $id = PDODatabase::Create('recipes', $filtered);

            header("Location: /recipe?id=" . $id);
            return;
        }

        Template::render('create', ['errors' => $errors]);
    }

    public static function update(Request $request): void {

        $id = $request->params['id'] ?? 1;

        $recipe = PDODatabase::Read('recipes', $id);

        Template::render('update', ['recipe' => $recipe]);
    }

    public static function update_recipe(Request $request): void {
        $id = $request->params['id'];
        $recipeDto = $request->body;

        $filtered = InputHandler::filter($recipeDto, Recipe::rules());

        $errors = InputHandler::validate($filtered, Recipe::rules());

        if(empty($errors)) {
            PDODatabase::Update('recipes', $id, $filtered);

            header("Location: /recipe?id=" . $id);
            return;
        }

        Template::render('create', ['errors' => $errors]);
    }

    public static function delete(Request $request): void {
        $id = $request->params['id'];

        PDODatabase::Delete('recipes', $id);

        header("Location: /");
    }

}