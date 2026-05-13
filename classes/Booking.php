<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Hotel.php';

class Booking {
    // Properties
    private int    $id;
    private int    $hotelId;
    private string $guestName;
    private string $email;
    private string $checkin;
    private string $checkout;
    private int    $guests;
    private int    $totalAmount;
    private string $status;
    private mysqli $connect;

    // Constructor
    public function __construct(
        int    $id          = 0,
        int    $hotelId     = 0,
        string $guestName   = '',
        string $email       = '',
        string $checkin     = '',
        string $checkout    = '',
        int    $guests      = 1,
        int    $totalAmount = 0,
        string $status      = 'pending'
    ) {
        $this->id          = $id;
        $this->hotelId     = $hotelId;
        $this->guestName   = $guestName;
        $this->email       = $email;
        $this->checkin     = $checkin;
        $this->checkout    = $checkout;
        $this->guests      = $guests;
        $this->totalAmount = $totalAmount;
        $this->status      = $status;
        $this->connect     = Database::getInstance()->getConnect();
    }

    // Getter 
    public function getId(): int          { return $this->id; }
    public function getHotelId(): int     { return $this->hotelId; }
    public function getGuestName(): string{ return $this->guestName; }
    public function getEmail(): string    { return $this->email; }
    public function getCheckin(): string  { return $this->checkin; }
    public function getCheckout(): string { return $this->checkout; }
    public function getGuests(): int      { return $this->guests; }
    public function getTotalAmount(): int { return $this->totalAmount; }
    public function getStatus(): string   { return $this->status; }

    // Setter 
    public function setGuestName(string $v): void { $this->guestName = $v; }
    public function setEmail(string $v): void     { $this->email = $v; }
    public function setStatus(string $v): void    { $this->status = $v; }

    // Methods 

    public function calculateTotal(): int {
        $hotel = Hotel::getHotelById($this->hotelId);
        if (!$hotel) return 0;
        $checkinDate  = new DateTime($this->checkin);
        $checkoutDate = new DateTime($this->checkout);
        $nights       = $checkoutDate->diff($checkinDate)->days;
        return $hotel->getPricePerNight() * $this->guests * $nights;
    }

    public function createBooking(): int {
        $hotelId    = $this->hotelId;
        $guestName  = mysqli_real_escape_string($this->connect, $this->guestName);
        $email      = mysqli_real_escape_string($this->connect, $this->email);
        $checkin    = mysqli_real_escape_string($this->connect, $this->checkin);
        $checkout   = mysqli_real_escape_string($this->connect, $this->checkout);
        $guests     = $this->guests;
        $total      = $this->calculateTotal();

        $query = "INSERT INTO tb_booking (hotel_id, guest_name, email, checkin, checkout, guests, total_amount, status, booking_date)
                  VALUES ($hotelId, '$guestName', '$email', '$checkin', '$checkout', $guests, $total, 'pending', NOW())";

        if (mysqli_query($this->connect, $query)) {
            return mysqli_insert_id($this->connect);
        }
        return 0;
    }

    public function cancelBooking(int $bookingId): bool {
        return (bool) mysqli_query($this->connect,
            "UPDATE tb_booking SET status = 'cancelled' WHERE id = $bookingId"
        );
    }

    public function getAllBookings(): array {
        $query  = mysqli_query($this->connect, "SELECT * FROM tb_booking ORDER BY booking_date DESC");
        $result = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
        return $result;
    }

    public function getBookingById(int $id, string $status = 'pending'): ?array {
        $result = mysqli_fetch_assoc(mysqli_query($this->connect,
            "SELECT * FROM tb_booking WHERE id = $id AND status = '$status'"
        ));
        return $result ?: null;
    }
}
?>
