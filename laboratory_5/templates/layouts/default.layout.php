<?php
/**
 * @var string|false $content
 * @var string $title
 */

use App\Core\Config;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title><?= Config::get('app.name') ?></title>
</head>

<body class="text-gray-950">
<header class="bg-gray-950 text-white p-4 sticky top-0 px-16 flex gap-4 flex-col md:flex-row justify-between md:items-center">
    <a href="/" class="font-bold text-4xl text-blue-300">
        <div><?= Config::get('app.name') ?></div>
    </a>
</header>
<main class="container mx-auto px-4">
    <?php echo $content; ?>
</main>

<footer>
</footer>
</body>

</html>