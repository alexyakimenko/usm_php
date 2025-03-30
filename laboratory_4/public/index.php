<?php

require_once '../src/helpers/config.php';
require_once ROOT_DIR . 'src/helpers/json_db.php';

configLoad('app.php');

$projectName = configGet('app.name');
$pageName = 'Home';

// last two transactions
$transactions = jsonDbLoad('expenses.json');
$transactions = array_reverse(array_slice($transactions, -2, 2));

?>

<?php require_once ROOT_DIR . 'src/layout/header.php' ?>

<?php require_once ROOT_DIR . 'src/pages/home.php' ?>

<?php require_once ROOT_DIR . 'src/layout/footer.php' ?>
