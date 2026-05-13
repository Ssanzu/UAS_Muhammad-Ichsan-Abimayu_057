<?php
session_start();
require_once '../classes/Booking.php';

if (isset($_GET['id'])) {
    $booking = new Booking(); 
    if ($booking->cancelBooking((int)$_GET['id'])) { 
        header('Location: ../index.php?x=order');
        exit;
    }
}
header('Location: ../index.php?x=order');
?>
