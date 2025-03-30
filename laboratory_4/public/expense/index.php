<?php

require_once '../../src/helpers/config.php';
require_once ROOT_DIR . 'src/helpers/json_db.php';

configLoad('app.php');

$projectName = configGet('app.name');
$pageName = 'History';

$transactions = jsonDbLoad('expenses.json');

$page = $_GET['page'] ?? 0;
if(!is_numeric($page) || $page < 0) {
    $page = 0;
}
if($page >= ceil(count($transactions) / 5)) {
    $page = ceil(count($transactions) / 5) - 1;
}
$limit = 5;

$transactions = array_slice($transactions, $page * $limit, $limit);

?>

<?php require_once ROOT_DIR . 'src/layout/header.php' ?>

<?php require_once ROOT_DIR . 'src/pages/history.php' ?>

<?php require_once ROOT_DIR . 'src/layout/footer.php' ?>