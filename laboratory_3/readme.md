# Лабораторная работа №3. Массивы и Функции

## Цель работы

Освоить работу с массивами в PHP, применяя различные операции: создание, добавление, удаление, сортировка и поиск. Закрепить навыки работы с функциями, включая передачу аргументов, возвращаемые значения и анонимные функции.

## Условие

### Задание 1. Работа с массивами

Разработать систему управления банковскими транзакциями с возможностью:

- добавления новых транзакций;
- удаления транзакций;
- сортировки транзакций по дате или сумме;
- поиска транзакций по описанию.

#### Задание 1.1. Подготовка среды

1. Убедитесь, что у вас установлен PHP 8+.
2. Создайте новый PHP-файл `index.php`.
3. В начале файла включите строгую типизацию:

#### Задание 1.2. Создание массива студентов

Создайте массив `$transactions`, содержащий информацию о банковских транзакциях. Каждая транзакция представлена в виде ассоциативного массива с полями:

- `id` – уникальный идентификатор транзакции;
- `date` – дата совершения транзакции (YYYY-MM-DD);
- `amount` – сумма транзакции;
- `description` – описание назначения платежа;
- `merchant` – название организации, получившей платеж.

#### Задание 1.3. Вывод списка транзакций

1. Используйте `foreach`, чтобы вывести список студентов в HTML-таблице.

#### Задание 1.4. Реализация функций

Создайте и используйте следующие функции:

1. Создайте функцию `calculateTotalAmount(array $transactions): float`, которая вычисляет общую сумму всех транзакций.
   - Выведите сумму всех транзакций в конце таблицы.
2. Создайте функцию `findTransactionByDescription(string $descriptionPart)`, которая ищет транзакцию по части описания.
3. Создайте функцию `findTransactionById(int $id)`, которая ищет транзакцию по идентификатору.
   - Реализуйте данную функцию с помощью обычного цикла `foreach`.
   - Реализуйте данную функцию с помощью функции `array_filter` (на высшую оценку).
4. Создайте функцию `daysSinceTransaction(string $date): int`, которая возвращает количество дней между датой транзакции и текущим днем.
   - Добавьте в таблицу столбец с количеством дней с момента транзакции.
5. Создайте функцию `addTransaction(int $id, string $date, float $amount, string $description, string $merchant): void` для добавления новой транзакции.
   - Примите во внимание, что массив `$transactions` должен быть доступен внутри функции как глобальная переменная.

#### Задание 1.5. Сортировка транзакций

1. Отсортируйте транзакции по дате с использованием `usort()`.
2. Отсортируйте транзакции по сумме (по убыванию).

### Задание 2. Работа с файловой системой

1. Создайте директорию `"image"`, в которой сохраните не менее 20-30 изображений с расширением .jpg.
2. Затем создайте файл `index.php`, в котором определите веб-страницу с хедером, меню, контентом и футером.
3. Выведите изображения из директории `"image"` на веб-страницу в виде галереи.

## Выполнение задания

### Задание 1

Создаю файл `index.php` и устанавливаю парвило строгих типов, которое отключает автоматическое преобразование типов данных

```php
<?php

declare(strict_types=1);
```

Создаю массив студентов и записываю его в отдельный `php` файл `transactions.php` для ясности

В отдельной папке `templates` создаю `layout.php` для базовой разметки, а также `table.php` для отображения таблицы транзакций

*`layout.php`*

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Transactions</title>
</head>
<body>
    <?php require_once 'table.php' ?>
    <div>
        <strong>Общая сумма:</strong>
        <span><?= calculateTotalAmount($transactions) ?></span>
    </div>
</body>
</html>
```

*`table.php`*

```php
<table border="1" width="100%" cellspacing="0" cellpadding="4">
    <thead>
        <tr>
            <th>Дата</th>
            <th>Прошло дней</th>
            <th>Количество</th>
            <th>Описание</th>
            <th>Продавец</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactions as $transaction) : ?>
            <tr>
                    <td><?= $transaction['date'] ?></td>
                    <td><?= daysSinceTransaction($transaction['date']); ?></td>
                    <td><?= $transaction['amount'] ?></td>
                    <td><?= $transaction['description'] ?></td>
                    <td><?= $transaction['merchant'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
```

При помощи `foreach` я перебираю все элементы массива

Создаю файл `transaction_functions.php` чтобы все нужные функции для лабы хранить там

#### CalculateTotalAmount

При помощи `array_reduce` я могу перебрать массив с накопительной переменной и посчитать общую сумму

```php
function calculateTotalAmount(array $transactions): float {
    return array_reduce($transactions, function($carry, $item) {
        return $carry + $item['amount'];
    }, 0);
}
```

#### FindTransactionByDescription

При помощи `array_find` я могу передать `callback` функцию которая будет решать условие нахождения и при помощи `use` я предоставляю ей видимость к внешней переменной `$descriptionPart`

При помощи функции `strpos` я могу определить позицию подстроки, однако в моем случаем мне важно чтобы она просто была

```php
function findTransactionByDescription(string $descriptionPart) {
    global $transactions;
    return array_find($transactions, function($value) use ($descriptionPart) {
        return strpos($value['description'], $descriptionPart) !== false;
    });
}
```

#### findTransactionById

Ее я реализовал тремя способами

1. `array_find`

    ```php
    function findTransactionById(int $id) {
        global $transactions;
        return array_find($transactions, function($value) use ($id) {
            return $value['id'] === $id;
        });
    }
    ```

    Тоже самое, что и предыдущая функция, но теперь с параметром `id`

2. `foreach`

    ```php
    function findTransactionById(int $id) {
        global $transactions;
        foreach ($transactions as $transaction) {
            if($transaction['id'] === $id) {
                return $transaction;
            }
        }
    }
    ```

    При помощи `foreach` нахожу необходимую транзакцию и возвращаю её

3. `array_filter`

    ```php
    function findTransactionById(int $id) {
    global $transactions;
    return array_filter($transactions, function($value) use ($id) {
        return $value['id'] === $id;
    })[0];
    }
    ```

    Поскольку `array_filter` в лабораторной дает высшую оценку, однако фильтрует массив и по итогу возвращает массив, при этом параметр `id` уникален, то по завершению фильтрации необходимо взять первый элемент массива

#### DaysSinceTransaction

```php
function daysSinceTransaction(string $date): int {
    $startDate = new DateTime($date);
    $endDate = new DateTime();
    $interval = $startDate->diff($endDate);
    return $interval->days;
}
```

При помощи класс `DateTime` получаю дату по строке и текущую дату, затем нахожу разницу при помощи метода `diff`, результат которого имеет поле `days` что я и возвращаю

#### AddTransaction

```php
function addTransaction(int $id, string $date, float $amount, string $description, string $merchant): void {
    global $transactions;
    $transactions[] = [
        'id' => $id,
        'date' => $date,
        'amount' => $amount,
        'description' => $description,
        'merchant' => $merchant
    ];
}
```

Имея доступ к глобальной переменной `$transactions` я могу добавить, новый элемент в массив

#### SortTransactionsByDate

```php
function sortTransactionsByDate(): true {
    global $transactions;
    return usort($transactions, function ($a, $b) {
        $dateA = new DateTime($a['date']);
        $dateB = new DateTime($b['date']);
        return $dateA > $dateB ? -1 : 1;
    });
}
```

При помощи `usort` сравниваю две даты, которые в итоге сортируются после сравнения

#### SortTransactionsByAmount

```php
function sortTransactionsByAmount(): bool {
    global $transactions;
    return usort($transactions, function ($a, $b) {
        return $b['amount'] - $a['amount'];
    });
}
```

Тоже самое, но с общим количеством
В зависимости от того какая переменная идет первой в операции вычитания решается порядок сортироваки (убывание/возрастание)

### Задание 2

Создаю директорию `image` и поскольку я не хочу скачивать вручную 30 фотографий, то дополнительно скачиваю расширение `Download All Images` которая за меня скачает все изображения на сайте и положит их в архив

Создаю файл `index.php`, а также `images.php` в которой я буду находить все изображения в папке

```php
<?php

$dir = 'image/';

$files = scandir($dir);
$paths = [];

if ($files === false) {
   return;
}

for ($i = 0; $i < count($files); $i++) {
   if (($files[$i] != ".") && ($files[$i] != "..")) {
       $paths[] = $dir . $files[$i];
   }
}
```

Нахожу все изображения и записываю их пути в массив `$paths`

Затем создаю папку `templates` в которой создаю файл `layout.php` в котором пишу базовую разметку

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Cats Gallery</title>
</head>
<body class="bg-gray-950 text-white">
    <?php require_once 'components/header.php' ?>
    <?php require_once 'components/main.php' ?>
    <?php require_once 'components/footer.php' ?>
</body>
</html>
```

Также в папке `components` создаю три файла

- `header.php`
- `main.php`
- `footer.php`

Отображать картинки я буду в файле `main.php` при помощи `foreach`

```php
<main>
    <div class="container mx-auto max-w-3xl mt-12">
        <h1 class="font-bold text-3xl">Cats in my Basement</h1>
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3 mx-auto my-8">
            <?php foreach ($paths as $path) : ?>
                <img class="w-full aspect-square object-cover hover:scale-125 transition transition-transform duration-150 ease-in-out cursor-pointer" src="<?= $path ?>" alt="cat">
            <?php endforeach; ?>
        </div>
    </div>
</main>
```

## Контрольные вопросы

> **Q:** Что такое массивы в PHP?  
> **A:** Масивы это структура данных, которая может содержать ***массив*** (набор) значений под одним именем

---

> **Q:** Каким образом можно создать массив в PHP?  
> **A:** Два способа
>
> 1. Используя `array(...)`
> 2. Используя `[...]`
>
> Однако стоит отметить что массивы в php являются ассоциативными, что значит что любому элементу можно задать ключ, иначе ключем будет индекс

---

> **Q:** Для чего используется цикл foreach?  
> **A:** Для удобного перебора массива, где не нужно обращаться по индексу, а можно на прямую работать со значением
>
> Также стоит отметить что его легче использовать с ассоциативными массивами, поскольку в каждой итерации можно получить ключ
