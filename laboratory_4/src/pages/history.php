<?php
/**
 * @var array $transactions
 * @var int $page
 */
?>
<div class="container mx-auto p-4">
    <h1 class="font-bold text-xl py-8">История</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 p-2">Название</th>
                    <th class="border border-gray-300 p-2">Сумма</th>
                    <th class="border border-gray-300 p-2">Тип</th>
                    <th class="border border-gray-300 p-2">Теги</th>
                    <th class="border border-gray-300 p-2">Описание</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td class="border border-gray-300 p-2"><?= $transaction['name'] ?></td>
                        <td class="border border-gray-300 p-2"><?= $transaction['amount'] ?></td>
                        <td class="border border-gray-300 p-2"><?= $transaction['type'] ?></td>
                        <td class="border border-gray-300 p-2"><?= implode(', ', $transaction['tags'] ?? []) ?></td>
                        <td class="border border-gray-300 p-2"><?= $transaction['description'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div>
            <div class="flex justify-between mt-4">
                <a href="?page=<?= max(0, $page - 1) ?>" class="border-1 border-gray-500 rounded px-4 py-2 cursor-pointer hover:bg-white hover:text-gray-900">Назад</a>
                <a href="?page=<?= $page + 1 ?>" class="border-1 border-gray-500 rounded px-4 py-2 cursor-pointer hover:bg-white hover:text-gray-900">Вперед</a>
            </div>
        </div>
    </div>
</div>
