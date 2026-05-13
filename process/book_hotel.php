<?php
session_start();
require_once '../classes/Booking.php';

if ($_POST) {
    $booking = new Booking(
        0,
        (int)$_POST['hotel_id'],
        $_POST['guest_name'],
        $_POST['email'],
        $_POST['checkin'],
        $_POST['checkout'],
        (int)$_POST['guests']
    );

    $bookingId = $booking->createBooking();

    if ($bookingId > 0) {
        $_SESSION['pending_booking_id'] = $bookingId;
        header('Location: ../index.php?x=payment');
        exit;
    } else {
        echo "Error membuat booking.";
    }
} else {
    header('Location: ../index.php?x=booking');
}
?>
