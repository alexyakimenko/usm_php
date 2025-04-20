<?php

namespace App\Controllers;

use App\Core\DB\PDODatabase;
use App\Core\Http\Request;
use App\Core\Template;
use App\Core\Validation\InputHandler;
use App\Models\Recipe;

class RecipeController
{
    /**
     * Displays a recipe by its ID.
     *
     * @param Request $request The HTTP request object containing parameters.
     * @return void
     */
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

    /**
     * Renders the recipe creation form.
     *
     * @return void
     */
    public static function create(): void {
        Template::render('create');
    }

    /**
     * Handles the creation of a new recipe.
     *
     * @param Request $request The HTTP request object containing the recipe data.
     * @return void
     */
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

    /**
     * Renders the recipe update form for a specific recipe.
     *
     * @param Request $request The HTTP request object containing the recipe ID.
     * @return void
     */
    public static function update(Request $request): void {
        $id = $request->params['id'] ?? 1;

        $recipe = PDODatabase::Read('recipes', $id);

        Template::render('update', ['recipe' => $recipe]);
    }

    /**
     * Handles the update of an existing recipe.
     *
     * @param Request $request The HTTP request object containing the recipe data and ID.
     * @return void
     */
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

    /**
     * Deletes a recipe by its ID.
     *
     * @param Request $request The HTTP request object containing the recipe ID.
     * @return void
     */
    public static function delete(Request $request): void {
        $id = $request->params['id'];

        PDODatabase::Delete('recipes', $id);

        header("Location: /");
    }
}