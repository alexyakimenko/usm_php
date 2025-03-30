<?php
/**
 * @var array $tags
 */
?>
<div class="container mx-auto p-4">
    <h1 class="font-bold text-xl">Доход/Расход</h1>
    <form action="/expense/create.php" method="post">
        <div>
            <label for="name" class="text-gray-500">Название</label>
            <input type="text" name="name" id="name" placeholder="Название" class="border border-gray-300 p-2 mb-4 w-full">
        </div>
        <div>
            <label for="amount" class="text-gray-500">Сумма</label>
            <input type="number" name="amount" id="amount" placeholder="Сумма" class="border border-gray-300 p-2 mb-4 w-full">
        </div>
        <div>
            <label for="type" class="text-gray-500">Тип</label>
            <select name="type" id="type" class="border border-gray-300 p-2 mb-4 w-full">
                <option value="income">Доход</option>
                <option value="expense">Расход</option>
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
</div>
<script src="/js/expense.js" defer></script>
