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
 * @param string $field The name of the field.
 * @param mixed $value The value of the field.
 * @param array $rule The validation rules for the field.
 * @return string|null The error message if validation fails, or null if validation passes.
 */
function validate_field($field, $value, $rule): ?string {
    if (isset($rule['required']) && $rule['required'] && empty($value)) {
        return 'Поле обязательно для заполнения';
    }
    if (isset($rule['type']) && gettype($value) !== $rule['type']) {
        return 'Неверный тип данных';
    }
    if (isset($rule['min']) && strlen($value) < $rule['min']) {
        return 'Минимальная длина ' . $rule['min'];
    }
    if (isset($rule['max']) && strlen($value) > $rule['max']) {
        return 'Максимальная длина ' . $rule['max'];
    }
    if (isset($rule['in']) && !in_array($value, $rule['in'])) {
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
    global $tags;

    $errors = [];
    foreach ($expense as $field => $value) {
        if (isset(rules[$field])) {
            if (rules[$field]['type'] === 'integer') {
                $value = (int)$value;
            }
            $error = validate_field($field, $value, rules[$field]);
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
