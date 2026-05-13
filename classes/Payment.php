<?php
require_once __DIR__ . '/Booking.php';
class Payment extends Booking {

    // Constructor 
    public function __construct() {
        parent::__construct();
    }

    // Methods 
    public function processPayment(int $bookingId): bool {
        $booking = $this->getBookingById($bookingId, 'pending');
        if (!$booking) return false;

        $connect = Database::getInstance()->getConnect();
        return (bool) mysqli_query($connect,
            "UPDATE tb_booking SET status = 'paid' WHERE id = $bookingId AND status = 'pending'"
        );
    }
}
?>
