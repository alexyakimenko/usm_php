<?php

namespace App\Models;

class Recipe {
    /**
     * Returns the validation rules for the Recipe model.
     *
     * @return array The validation rules for each field in the recipe.
     */
    public static function rules(): array {
        return [
            'title' => [
                'required' => true,
                'type' => 'string',
                'min' => 3,
                'max' => 255,
            ],
            'description' => [
                'required' => false,
                'type' => 'string',
                'min' => 3,
                'max' => 512,
            ],
            'ingredients' => [
                'required' => false,
                'type' => 'string',
                'min' => 3,
                'max' => 255,
            ],
            'tags' => [
                'required' => false,
                'type' => 'string',
                'min' => 3,
                'max' => 255,
            ],
            'steps' => [
                'required' => true,
                'type' => 'string',
                'min' => 3,
                'max' => 255,
            ],
            'category' => [
                'required' => true,
                'type' => 'integer',
                'min' => 0,
            ]
        ];
    }
}
