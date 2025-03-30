<?php
/**
 * @var string $projectName
 */
?>
<div class="bg-gray-950 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/"><h1 class="font-bold text-2xl"><?= $projectName ?> </h1></a>
        <nav>
            <ul>
                <li class="inline-block mr-4">
                    <a href="/" class="text-gray-300 hover:text-white font-bold">Home</a>
                </li>
                <li class="inline-block mr-4">
                    <a href="/expense/create.php" class="text-gray-300 hover:text-white font-bold">Expense</a>
                </li>
                <li class="inline-block mr-4">
                    <a href="/expense" class="text-gray-300 hover:text-white font-bold">History</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
