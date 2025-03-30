<?php

require_once ROOT_DIR . 'src/helpers/json_db.php';
const rules = [
    'name' => [
        'required' => true,
        'type' => 'string',
        'min' => 3,
        'max' => 255,
    ],
    'amount' => [
        'required' => true,
        'type' => 'integer',
        'min' => 0,
    ],
    'type' => [
        'required' => true,
        'type' => 'string',
        'in' => ['income', 'expense'],
    ],
    'tags' => [
        'required' => false,
        'type' => 'array',
    ],
    'description' => [
        'required' => false,
        'type' => 'string',
        'max' => 1000,
    ],
    'people' => [
        'required' => false,
        'type' => 'array',
    ],
];

/**
 * Validate a field against a set of rules.
 *
 * @param mixed $value The value of the field.
 * @param array $rules The validation rules for the field.
 * @return string|null The error message if validation fails, or null if validation passes.
 */
function validate_field(mixed $value, array $rules): ?string {
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
 * Handle an expense entry.
 *
 * @param array $expense The expense data to handle.
 * @return array|null An array of errors if validation fails, or null if successful.
 */
function handle_expense(array $expense): ?array {
    $errors = [];
    foreach ($expense as $field => $value) {
        if (isset(rules[$field])) {
            if (rules[$field]['type'] === 'integer') {
                $value = (int)$value;
            }
            $error = validate_field($value, rules[$field]);
            if ($error) {
                $errors[$field] = $error;
            }
        }
    }

    if (!empty($errors)) {
        return $errors;
    }

    // handle success
    jsonDbAppend('expenses.json', $expense);
    return null;
}
