<?php
$hotels = [
    1 => ['name' => 'Zogart Hotel - Zimbabwe,Harare'],
    2 => ['name' => 'Luxury Hotel - Indonesia, Bali'],
    3 => ['name' => 'Ocean View Hotel - Thailand, Phuket'],
    4 => ['name' => 'Mountain Resort - Japan, Hokkaido'],
];

require_once __DIR__ . '/../classes/Booking.php';
require_once __DIR__ . '/../classes/Hotel.php';
require_once __DIR__ . '/main.php';

$bookingObj = new Booking();
$orders = $bookingObj->getAllBookings();
$no = 1;
?>

<div class="col">
    <div class="card">
        <div class="card-header">Your Order</div>

        <?php if (!empty($orders)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Hotel</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Guests</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $row): ?>
                            <tr
                                class="<?= $row['status'] == 'paid' ? 'table-success' : ($row['status'] == 'pending' ? 'table-warning' : 'table-danger') ?>">
                                <td><?= $no++ ?></td>
                                <td><?= $hotels[$row['hotel_id']]['name'] ?? 'Unknown Hotel' ?></td>
                                <td><?= htmlspecialchars($row['guest_name']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= date('d/m/Y', strtotime($row['checkin'])) ?></td>
                                <td><?= date('d/m/Y', strtotime($row['checkout'])) ?></td>
                                <td><?= (int)$row['guests'] ?></td>
                                <td>Rp <?= number_format((int)$row['total_amount'], 0, ',', '.') ?></td>
                                <td>
                                    <span class="badge bg-<?= $row['status'] == 'paid' ? 'success' : ($row['status'] == 'pending' ? 'warning' : 'danger') ?>">
                                        <?= ucfirst($row['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($row['status'] == 'pending'): ?>
                                        <div class="btn-group btn-group-sm" role="group" style="gap: 0.5rem;">
                                            <a href="process/set_pending.php?id=<?= (int)$row['id'] ?>" class="btn btn-success me-1">
                                                <i class="bi bi-credit-card"></i>
                                            </a>
                                            <a href="process/cancel_booking.php?id=<?= (int)$row['id'] ?>" class="btn btn-danger" onclick="return confirm('Batalkan pesanan ini?')">
                                                <i class="bi bi-x-circle"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <i class="bi bi-inbox"></i> Belum ada history booking. Lakukan booking dulu!
            </div>
        <?php endif; ?>
    </div>
</div>

