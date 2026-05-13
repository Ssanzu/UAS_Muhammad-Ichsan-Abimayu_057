<?php
require_once __DIR__ . '/Database.php';

class Hotel {
    // ─── Properties ──────────────────────────────────────────────────────
    private int    $id;
    private string $name;
    private string $image;
    private int    $pricePerNight;
    private int    $stars;

    // Constructor 
    public function __construct(int $id, string $name, string $image, int $pricePerNight, int $stars) {
        $this->id            = $id;
        $this->name          = $name;
        $this->image         = $image;
        $this->pricePerNight = $pricePerNight;
        $this->stars         = $stars;
    }

    // Getter 
    public function getId(): int            { return $this->id; }
    public function getName(): string       { return $this->name; }
    public function getImage(): string      { return $this->image; }
    public function getPricePerNight(): int { return $this->pricePerNight; }
    public function getStars(): int         { return $this->stars; }

    // ─── Setter ──────────────────────────────────────────────────────────
    public function setName(string $name): void               { $this->name = $name; }
    public function setPricePerNight(int $price): void        { $this->pricePerNight = $price; }
    public function setStars(int $stars): void                { $this->stars = $stars; }

    // ─── Methods ─────────────────────────────────────────────────────────

    /**
     * getAllHotels(): mengembalikan array objek Hotel dari data statis.
     * Digunakan oleh home.php dan booking.php.
     * @return Hotel[]
     */
    public static function getAllHotels(): array {
        return [
            new Hotel(1, 'Zogart Hotel - Zimbabwe, Harare',       'img/hotel 1.jpg', 128000, 3),
            new Hotel(2, 'Kitul Hotel - Indonesia, Banjarbaru',   'img/hotel 2.jpg', 254000, 4),
            new Hotel(3, 'Best Hotel - Greenland, Nuuk',          'img/hotel 3.jpg', 436000, 5),
            new Hotel(4, 'Tambuk Resort - Indonesia, Banjarmasin','img/hotel 4.jpg', 189000, 4),
        ];
    }

    /**
     * getHotelById(): mengembalikan objek Hotel berdasarkan ID, atau null jika tidak ada.
     */
    public static function getHotelById(int $id): ?Hotel {
        foreach (self::getAllHotels() as $hotel) {
            if ($hotel->getId() === $id) return $hotel;
        }
        return null;
    }

    /**
     * formatPrice(): mengembalikan harga dalam format rupiah (Rp 128.000/pax).
     */
    public function formatPrice(): string {
        return 'Rp ' . number_format($this->pricePerNight, 0, ',', '.') . '/pax';
    }

    /**
     * renderStars(): mengembalikan HTML bintang (filled/outline) sesuai rating.
     */
    public function renderStars(): string {
        $html = '';
        for ($i = 1; $i <= 5; $i++) {
            $html .= '<i class="bi bi-star' . ($i <= $this->stars ? '-fill' : '') . ' text-warning"></i>';
        }
        return $html;
    }
}
?>
