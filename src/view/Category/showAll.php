<ul>
    <?php foreach ($categories as $category) : ?>
        <li>Catégorie : <?= $category->getName() . ' , id = ' . $category->getId() ?></li>
    <?php endforeach; ?>
</ul>