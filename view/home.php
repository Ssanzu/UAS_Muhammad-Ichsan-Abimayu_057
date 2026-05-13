<?php
require_once __DIR__ . '/../classes/Hotel.php';
$hotels = Hotel::getAllHotels(); 
?>
<div class="row row-cols-1 row-cols-md-2 g-4">
    <?php foreach ($hotels as $hotel): ?>
    <div class="col">
        <div class="card h-100">
            <img src="<?= htmlspecialchars($hotel->getImage()) ?>" class="card-img-top" alt="<?= htmlspecialchars($hotel->getName()) ?>" style="height:180px;object-fit:cover">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($hotel->getName()) ?></h5>
                <div><?= $hotel->renderStars() ?></div>
                <p class="card-text mt-2"><?= $hotel->formatPrice() ?></p>
            </div>
            <div class="card-footer bg-transparent border-0 pb-3">
                <a href="index.php?x=booking&hotel=<?= $hotel->getId() ?>" class="btn btn-dark w-100">Book Now</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>