# Лабораторная работа №4. Обработка и валидация форм

## Цель работы
Освоить основные принципы работы с HTML-формами в PHP, включая отправку данных на сервер и их обработку, включая валидацию данных.

Данная работа станет основой для дальнейшего изучения разработки веб-приложений. Дальнейшие лабораторные работы будут основываться на данной.

## Условие
Студенты должны выбрать тему проекта для лабораторной работы, которая будет развиваться на протяжении курса.

Выбранная тема: Expense Tracker (Счетчик расходов)

## Задание 1. Создание проекта

1. Создаю корневую директорию проекта 
2. Организую файловую структуру проекта.
    ```
       laboratory_4/
       ├── config/
       ├── public/                        
       │   ├── index.php
       │   ├── js/
       │   └── expense/                    
       │       ├── create.php              
       │       └── index.php            
       ├── src/                            
       │   ├── handlers/     
       │   ├── layout/
       │   ├── pages/
       │   └── helpers/            
       ├── storage/                        
       │   └── expenses.json             
       └── readme.md 
    ```
   
## Задание 2. Создание формы добавления рецепта

1. Создаю файл `expense.php` в директории `src/pages/` и записываю в него код HTML-формы.
```php
<form action="/expense/create.php" method="post">
        <div>
            <label for="name" class="text-gray-500">Название</label>
            <input type="text" name="name" id="name" placeholder="Название" class="border border-gray-300 p-2 mb-4 w-full" value="<?= $_POST['name'] ?? '' ?>">
        </div>
        <div>
            <label for="amount" class="text-gray-500">Сумма</label>
            <input type="number" name="amount" id="amount" placeholder="Сумма" class="border border-gray-300 p-2 mb-4 w-full" value="<?= $_POST['amount'] ?? '' ?>">
        </div>
        <div>
            <label for="type" class="text-gray-500">Тип</label>
            <select name="type" id="type" class="border border-gray-300 p-2 mb-4 w-full">
                <option value="expense">Расход</option>
                <option value="income" <?= $_POST['type'] == 'income' ? 'selected' : '' ?>>Доход</option>
            </select>
        </div>
        <div>
            <label for="tags" class="text-gray-500">Теги</label>
            <select name="tags[]" id="tags" multiple class="border border-gray-300 p-2 mb-4 w-full">
                <?php foreach ($tags as $tag => $name): ?>
                    <option value="<?= $tag ?>"><?= $name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="description" class="text-gray-500">Описание</label>
            <textarea name="description" id="description" placeholder="Описание" class="border border-gray-300 p-2 mb-4 w-full"></textarea>
        </div>
        <div class="flex gap-4 items-end">
            <button class="border-1 border-gray-500 rounded px-4 py-2 cursor-pointer hover:bg-white hover:text-gray-900 flex-shrink-0" id="add-person">Добавить участника</button>
            <div class="w-full flex flex-col gap-4" id="people">

            </div>
        </div>
        <button type="submit" class="border-1 border-gray-500 rounded px-4 py-2 cursor-pointer hover:bg-white hover:text-gray-900 mt-8">Добавить</button>
    </form>
```

Все необходимы переменные определяются в `public/expense/create.php` где вызывается `src/pages/expense.php`.

Формы содержит следующие поля:
- Название (name) - текстовое поле
- Сумма (amount) - числовое поле
- Тип (type) - выпадающий список с двумя значениями: "Расход" и "Доход"
- Теги (tags) - выпадающий список с несколькими значениями, которые можно выбрать
- Описание (description) - текстовое поле
- Кнопка "Добавить участника" - добавляет поле для ввода имени участника
- Кнопка "Добавить" - отправляет форму на сервер для обработки

Для динамического добавления полей для ввода имени участника используется скрипт `JavaScript` в папке `public/js`.

```javascript
const addPersonBtn = document.querySelector("#add-person")
const people = document.querySelector("#people")

addPersonBtn.addEventListener('click', (e) => {
    e.preventDefault()
    const label = document.createElement("label")
    label.innerHTML = `<input class="border border-gray-300 p-2 w-full" type="text" name="people[]" placeholder="Имя участника">`

    people.appendChild(label)
})
```

## Задание 3. Обработка формы

1. Создаю в директории handlers файл, который будет обрабатывать данные формы.
2. В него записываю правила валидации данных формы.
    ```php
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
    ```
   
3. Создаю функцию `validate_field` для валидации данных поля.
    ```php
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
    ```

4. Создаю функцию `handle_expense` для обработки запроса на добавление расхода.
    ```php
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
    ```
   
5. Функции для работы с файлом json создаю в файле `src/helpers/json_db.php`
6. В файле `public/expense/create.php` подключаю файл с функциями и вызываю функцию `handle_expense`.
    ```php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once ROOT_DIR . 'src/handlers/handle_expense.php';
    
        $errors = handle_expense($_POST);
        if(empty($errors)) {
            header('Location: /');
            exit();
        }
    }
    ```
    В случае успешной обработки формы происходит редирект на главную страницу. В случае ошибки, ошибки отображаются в форме.

## Задание 4. Отображение рецептов

1. На главной странице создаю таблицу для отображения последних 2-х расходов.
    ```php
    // last two transactions
    $transactions = jsonDbLoad('expenses.json');
    $transactions = array_reverse(array_slice($transactions, -2, 2));
    ```
   
2. В файле `public/expense/index.php` отображаю все траты из файла `storage/expenses.json`.

### Дополнительное задание

Ввожу переменную `$page` для определения текущей страницы. В зависимости от значения переменной, отображаю разные страницы.

```php
$page = $_GET['page'] ?? 0;
if(!is_numeric($page) || $page < 0) {
    $page = 0;
}
if($page >= ceil(count($transactions) / 5)) {
    $page = ceil(count($transactions) / 5) - 1;
}
$limit = 5;

$transactions = array_slice($transactions, $page * $limit, $limit);
```

Определяю лимит и сдвиг для пагинации. В зависимости от значения переменной `$page` отображаю разные страницы. В случае, если значение переменной `$page` больше количества страниц, то устанавливаю значение переменной `$page` равным количеству страниц минус 1.

## Контрольные вопросы

> **Q:** Какие методы HTTP применяются для отправки данных формы?  
> **A:** POST, GET

> **Q:** Что такое валидация данных, и чем она отличается от фильтрации?  
> **A:** Валидация данных - это процесс проверки данных на соответствие определенным правилам и требованиям. Фильтрация - это процесс удаления нежелательных данных или символов из входных данных. Валидация проверяет, правильные ли данные, а фильтрация удаляет лишние данные.

> **Q:** Какие функции PHP используются для фильтрации данных?  
> **A:** htmlspecialchars, strip_tags, filter_var, htmlentities, trim