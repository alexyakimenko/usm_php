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