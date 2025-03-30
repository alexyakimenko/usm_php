<?php

require_once '../../src/helpers/config.php';

configLoad('app.php');
configLoad('expense.php');

$projectName = configGet('app.name');
$pageName = 'Expense';

$tags = configGet('expense.tags');

?>

<?php require_once ROOT_DIR . 'src/layout/header.php' ?>

<?php require_once ROOT_DIR . 'src/pages/expense.php' ?>

<?php require_once ROOT_DIR . 'src/layout/footer.php' ?>