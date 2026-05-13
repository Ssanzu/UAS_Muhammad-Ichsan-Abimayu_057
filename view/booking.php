<?php
require_once __DIR__ . '/../classes/Hotel.php';

$hotelId      = isset($_GET['hotel']) ? (int)$_GET['hotel'] : 1;
$selectedHotel = Hotel::getHotelById($hotelId) ?? Hotel::getHotelById(1);
?>
<div class="container mt-2">
    <h4>Booking — <?= htmlspecialchars($selectedHotel->getName()) ?></h4>
    <div class="row mt-3">
        <div class="col-md-5">
            <img src="<?= htmlspecialchars($selectedHotel->getImage()) ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($selectedHotel->getName()) ?>">
            <div class="mt-2"><?= $selectedHotel->renderStars() ?></div>
            <p class="mt-1 fw-semibold"><?= $selectedHotel->formatPrice() ?></p>
        </div>
        <div class="col-md-7">
            <form action="process/book_hotel.php" method="POST">
                <input type="hidden" name="hotel_id" value="<?= $selectedHotel->getId() ?>">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="guest_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Check-in</label>
                    <input type="date" class="form-control" name="checkin" id="checkin" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Check-out</label>
                    <input type="date" class="form-control" name="checkout" id="checkout" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Number of Guests</label>
                    <select class="form-select" name="guests" required>
                        <option value="">Select...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Confirm Booking</button>
                <a href="index.php?x=home" class="btn btn-secondary ms-2">Back</a>
            </form>
        </div>
    </div>
</div>
<script>
document.querySelector('form').addEventListener('submit', function(e) {
    const ci = new Date(document.getElementById('checkin').value);
    const co = new Date(document.getElementById('checkout').value);
    if (co <= ci) { e.preventDefault(); alert('Check-out harus setelah check-in.'); }
});
</script>