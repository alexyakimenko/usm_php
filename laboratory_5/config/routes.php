<?php

use App\Controllers\MainController;
use App\Controllers\RecipeController;

return [
    'get' => [MainController::class, 'index'],
    'recipe' => [
        'get' => [RecipeController::class, 'index'],
        'create' => [
            'get' => [RecipeController::class, 'create'],
            'post' => [RecipeController::class, 'new_recipe'],
        ],
        'update' => [
            'get' => [RecipeController::class, 'update'],
            'post' => [RecipeController::class, 'update_recipe'],
        ],
        'delete' => [
            'get' => [RecipeController::class, 'delete'],
        ]
    ]
];