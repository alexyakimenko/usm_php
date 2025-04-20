<?php

namespace App\Core\Validation;

class InputHandler
{
    /**
     * Filters a single field based on the provided rules.
     *
     * @param mixed $value The value to be filtered.
     * @param array $rules The rules to apply for filtering.
     * @return mixed The filtered value or null if no rules are applied.
     */
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

    /**
     * Validates a single field based on the provided rules.
     *
     * @param mixed $value The value to be validated.
     * @param array $rules The rules to apply for validation.
     * @return string|null An error message if validation fails, or null if it passes.
     */
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

    /**
     * Validates an array of data based on the provided rules.
     *
     * @param array $data The data to be validated.
     * @param array $rules The validation rules for each field.
     * @return array|null An array of errors if validation fails, or null if it passes.
     */
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

    /**
     * Filters an array of data based on the provided rules.
     *
     * @param array $data The data to be filtered.
     * @param array $rules The filtering rules for each field.
     * @return array The filtered data.
     */
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