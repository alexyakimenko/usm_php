<?php
/**
 * @var array $recipe
 */
?>
<div class="container mx-auto px-4 py-8 max-w-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Update New Recipe</h1>

    <form action="/recipe/update?id=<?= $recipe['id'] ?>" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                Recipe Title
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   id="title" name="title" type="text" placeholder="Enter recipe title" value="<?= $recipe['title'] ?>" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                Category
            </label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="category" name="category" required>
                <option value="">Select a category</option>
                <option value="1" <?= $recipe['category'] == 1 ? "selected" : "" ?>>Breakfast</option>
                <option value="2" <?= $recipe['category'] == 2 ? "selected" : "" ?>>Lunch</option>
                <option value="3" <?= $recipe['category'] == 3 ? "selected" : "" ?>>Dinner</option>
                <option value="4" <?= $recipe['category'] == 4 ? "selected" : "" ?>>Dessert</option>
                <option value="5" <?= $recipe['category'] == 5 ? "selected" : "" ?>>Snacks</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="ingredients">
                Ingredients
            </label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      id="ingredients" name="ingredients" placeholder="Enter ingredients (one per line)" rows="5"><?= $recipe['ingredients'] ?></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Description
            </label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      id="description" name="description" placeholder="Enter a brief description" rows="3"><?= $recipe['description'] ?></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="tags">
                Tags
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   id="tags" name="tags" type="text" placeholder="Enter tags separated by commas" value="<?= $recipe['tags'] ?>">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="steps">
                Preparation Steps
            </label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      id="steps" name="steps" placeholder="Enter preparation steps" rows="6"><?= $recipe['steps'] ?></textarea>
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                Save Recipe
            </button>
            <button class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="reset">
                Reset
            </button>
        </div>
    </form>
</div>