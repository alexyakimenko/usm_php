<?php

require_once '../../src/helpers/config.php';

configLoad('app.php');

$projectName = configGet('app.name');
$pageName = 'Expense';

?>

<?php require_once ROOT_DIR . 'src/layout/header.php' ?>

<?php require_once ROOT_DIR . 'src/pages/expense.php' ?>

<?php require_once ROOT_DIR . 'src/layout/footer.php' ?>