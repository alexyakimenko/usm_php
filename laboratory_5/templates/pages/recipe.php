<?php
/**
 * @var array $recipe
 */
?>
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
        <div class="relative">
            <img src="https://superherocooks.com/_next/image?url=https%3A%2F%2Fsuper-hero-cooks.s3.us-east-2.amazonaws.com%2Frecipe-images%2F1729058746414.webp&w=1080&q=75" alt="Margherita Pizza" class="w-full h-64 object-cover">
            <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black to-transparent w-full p-6">
                <div class="inline-block bg-yellow-500 text-white px-3 py-1 text-sm font-semibold rounded-full mb-2"><?= $recipe['category'] ?></div>
                <h1 class="text-3xl font-bold text-white"><?= $recipe['title'] ?></h1>
                <a href="/recipe/update?id=<?= $recipe['id'] ?>" class="bg-blue-600 text-white px-2 py-1 rounded cursor-pointer inline-block mt-2">Update</a>
                <a href="/recipe/delete?id=<?= $recipe['id'] ?>" class="bg-red-600 text-white px-2 py-1 rounded cursor-pointer inline-block mt-2">Delete</a>
            </div>
        </div>

        <div class="p-6">
            <div class="flex items-center text-gray-600 text-sm mb-4">
                <div class="flex items-center mr-6">
                    <i class="far fa-clock mr-2"></i>
                    <span>Prep: <?= round(rand(10, 120), -1) ?> mins</span>
                </div>
                <div class="flex items-center mr-6">
                    <i class="far fa-clock mr-2"></i>
                    <span>Cook: <?= round(rand(10, 120), -1) ?> mins</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-user-friends mr-2"></i>
                    <span>Serves: <?= rand(1, 7) ?></span>
                </div>
            </div>

            <p class="text-gray-700 mb-4">
                <?= $recipe['description'] ?>
            </p>

        <div class="flex flex-wrap gap-2 mb-4">
            <?php foreach ($recipe['tags'] as $tag): ?>
                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded"><?= $tag ?>></span>
            <?php endforeach; ?>
        </div>

        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        <div class="md:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Ingredients</h2>
                <ul class="space-y-2">
                    <?php foreach ($recipe['ingredients'] as $ingredient): ?>
                        <li class="flex items-center">
                            <label>
                                <input type="checkbox" class="h-4 w-4 text-blue-600 mr-2">
                            </label>
                            <span><?= $ingredient ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="md:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Instructions</h2>
                <ol class="list-decimal list-inside space-y-4">
                    <?php foreach ($recipe['steps'] as $step): ?>
                        <li class="text-gray-700">
                            <?= $step ?>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </div>

    <div class="mt-6 text-center text-gray-500 text-sm">
        <p>Recipe added on April 15, 2025 • Recipe ID: 42</p>
    </div>
</div>