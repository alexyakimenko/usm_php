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