<?php
if (!isset($_SESSION['pending_booking_id'])) {
    header('Location: index.php?x=home');
    exit;
}

require_once __DIR__ . '/../classes/Booking.php';
require_once __DIR__ . '/../classes/Hotel.php';

$bookingId  = $_SESSION['pending_booking_id'];
$bookingObj = new Booking();
$booking    = $bookingObj->getBookingById($bookingId, 'pending');

if (!$booking) {
    unset($_SESSION['pending_booking_id']);
    header('Location: index.php?x=home');
    exit;
}

$hotel  = Hotel::getHotelById($booking['hotel_id']);
$nights = (new DateTime($booking['checkout']))->diff(new DateTime($booking['checkin']))->days;
?>
<div class="container mt-2">
    <h4>Payment — <?= htmlspecialchars($hotel ? $hotel->getName() : 'Hotel') ?></h4>
    <div class="row mt-3">
        <?php if ($hotel): ?>
        <div class="col-md-5">
            <img src="<?= htmlspecialchars($hotel->getImage()) ?>" class="img-fluid rounded" alt="">
        </div>
        <?php endif; ?>
        <div class="col-md-7">
            <h5>Booking Summary</h5>
            <table class="table table-borderless table-sm">
                <tr><td>Guest</td><td><?= htmlspecialchars($booking['guest_name']) ?></td></tr>
                <tr><td>Email</td><td><?= htmlspecialchars($booking['email']) ?></td></tr>
                <tr><td>Check-in</td><td><?= date('d/m/Y', strtotime($booking['checkin'])) ?></td></tr>
                <tr><td>Check-out</td><td><?= date('d/m/Y', strtotime($booking['checkout'])) ?></td></tr>
                <tr><td>Nights</td><td><?= $nights ?></td></tr>
                <tr><td>Guests</td><td><?= $booking['guests'] ?></td></tr>
                <tr><th>Total</th><th>Rp <?= number_format($booking['total_amount'], 0, ',', '.') ?></th></tr>
            </table>
            <div class="d-flex gap-2 mt-3">
                <form action="process/process_payment.php" method="POST" class="flex-fill">
                    <input type="hidden" name="booking_id" value="<?= $bookingId ?>">
                    <button type="submit" class="btn btn-success w-100">Pay Now</button>
                </form>
                <a href="index.php?x=order" class="btn btn-secondary flex-fill">Back to Order</a>
            </div>
        </div>
    </div>
</div>