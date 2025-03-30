<?php

require_once '../../src/helpers/config.php';

configLoad('app.php');

$projectName = configGet('app.name');
$pageName = 'History';

?>

<?php require_once ROOT_DIR . 'src/layout/header.php' ?>

<?php require_once ROOT_DIR . 'src/pages/history.php' ?>

<?php require_once ROOT_DIR . 'src/layout/footer.php' ?>