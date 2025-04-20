<?php
/**
* @var array $recipes
 * @var int $page
 */
?>
<header class="bg-white shadow">
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">Culinary Delights</h1>
            <div class="flex items-center space-x-4">
                <a href="/recipe/create">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                        Add Recipe
                    </button>
                </a>
            </div>
        </div>
    </div>
</header>

<div class="container mx-auto px-4 py-8">
    <!-- Recipes Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php foreach($recipes as $recipe): ?>
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
            <a href="/recipe?id=<?= $recipe['id'] ?>">
                <div class="relative">
                    <img src="https://picsum.photos/800?random=<?= $recipe['id'] ?>" alt="Margherita Pizza" class="w-full h-48 object-cover">
                    <div class="absolute top-2 right-2 bg-yellow-500 text-white px-2 py-1 text-xs font-semibold rounded">Italian</div>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-bold text-gray-800 mb-2"><?= $recipe['title'] ?></h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2"><?= $recipe['description'] ?></p>
                    <div class="flex justify-between items-center text-sm text-gray-500">
                            <span class="flex items-center">
                                <i class="far fa-clock mr-1"></i> 45 mins
                            </span>
                        <span>Apr 15, 2025</span>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>



    <!-- Pagination -->
    <div class="mt-8 flex justify-center w-full">
        <nav class="flex items-center justify-between w-full">
            <a href="/?page=<?= $page - 1 ?>" class="px-3 py-2 rounded-md text-gray-500 hover:bg-gray-200">
                Prev
            </a>
            <a href="/?page=<?= $page + 1 ?>" class="px-3 py-2 rounded-md text-gray-500 hover:bg-gray-200">
                Next
            </a>
        </nav>
    </div>
</div>
