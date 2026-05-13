<?php
session_start();
require_once '../classes/Payment.php';

if ($_POST) {
    $bookingId = (int)$_POST['booking_id'];

    $payment = new Payment();

    if ($payment->processPayment($bookingId)) {
        unset($_SESSION['pending_booking_id']);
        $_SESSION['payment_success'] = 'Pembayaran berhasil! Booking dikonfirmasi.';
        header('Location: ../index.php?x=order');
    } else {
        $_SESSION['payment_error'] = 'Pembayaran gagal. Silakan coba lagi.';
        header('Location: ../index.php?x=payment');
    }
    exit;
} else {
    header('Location: ../index.php?x=payment');
    exit;
}
?>
