<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Booking.php';

if (!isset($_GET['id'])) {
    header('Location: ../index.php?x=order');
    exit;
}

$bookingId = (int)$_GET['id'];

$connect = Database::getInstance()->getConnect();
$ok = (bool)mysqli_query($connect, "UPDATE tb_booking SET status = 'pending' WHERE id = $bookingId");



if ($ok) {
    // Untuk halaman payment (view/payment.php) butuh ini
    $_SESSION['pending_booking_id'] = $bookingId;
    header('Location: ../index.php?x=payment');
    exit;
}

header('Location: ../index.php?x=order');
exit;

?>


