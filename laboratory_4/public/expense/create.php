<?php

require_once '../../src/helpers/config.php';

configLoad('app.php');
configLoad('expense.php');

$projectName = configGet('app.name');
$pageName = 'Expense';

$tags = configGet('expense.tags');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once ROOT_DIR . 'src/handlers/handle_expense.php';

    $errors = handle_expense($_POST);
    if(empty($errors)) {
        header('Location: /');
        exit();
    }
}

?>

<?php require_once ROOT_DIR . 'src/layout/header.php' ?>

<?php require_once ROOT_DIR . 'src/pages/expense.php' ?>

<?php require_once ROOT_DIR . 'src/layout/footer.php' ?>