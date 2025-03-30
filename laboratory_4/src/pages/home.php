<?php
/**
* @var string $projectName
 */
?>
<div>
    <div class="text-center mt-10 text-4xl font-bold">
        <h1>Welcome to the <span class="text-red-300"><?= $projectName ?></span></h1>
    </div>
    <div class="text-center mt-4 text-xl">
        <p>Это приложение для учета доходов и расходов.</p>
        <p>Вы можете добавлять свои транзакции, а также просматривать историю.</p>
    </div>
    <div class="container mx-auto p-4">
        <h1 class="font-bold text-xl py-8">Последние 2 транзакции</h1>
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
        </div>
    </div>
</div>
