<main>
    <div class="container mx-auto max-w-3xl mt-12">
        <h1 class="font-bold text-3xl">Cats in my Basement</h1>
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3 mx-auto my-8">
            <?php foreach ($paths as $path) : ?>
                <img class="w-full aspect-square object-cover hover:scale-125 transition transition-transform duration-150 ease-in-out cursor-pointer" src="<?= $path ?>" alt="">
            <?php endforeach; ?>
        </div>
    </div>
</main>