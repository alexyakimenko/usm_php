<?php

namespace App\Core\Validation;

class InputHandler
{
    public static function filterField(mixed $value, array $rules): mixed {
        if(isset($rules['type'])) {
            return match($rules['type']) {
                'integer' => (int)$value,
                'string' => htmlspecialchars(trim($value)),
                default => $value,
            };
        }
        return null;
    }

    public static function validateField(mixed $value, array $rules): ?string {
        if (isset($rules['required']) && $rules['required'] && empty($value)) {
            return 'Поле обязательно для заполнения';
        }
        if (isset($rules['type']) && gettype($value) !== $rules['type']) {
            return 'Неверный тип данных';
        }
        if (isset($rules['min']) && strlen($value) < $rules['min']) {
            return 'Минимальная длина ' . $rules['min'];
        }
        if (isset($rules['max']) && strlen($value) > $rules['max']) {
            return 'Максимальная длина ' . $rules['max'];
        }
        if (isset($rules['in']) && !in_array($value, $rules['in'])) {
            return 'Недопустимое значение';
        }
        return null;
    }

    public static function validate(array $data, array $rules): ?array {
        $errors = [];
        foreach ($data as $key => $value) {
            if(isset($rules[$key])) {
                $error = self::validateField($value, $rules[$key]);
                if($error !== null) {
                    $errors[$key] = $error;
                }
            }
        }

        if(!empty($errors)) {
            return $errors;
        }

        return null;
    }

    public static function filter(array $data, array $rules): array {
        $result = [];
        foreach ($data as $key => $value) {
            if(isset($rules[$key])) {
                $filtered = self::filterField($value, $rules[$key]);
                if($filtered !== null) {
                    $result[$key] = $filtered;
                }
            }
        }

        return $result;
    }
}