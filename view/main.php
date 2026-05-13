<?php
require_once __DIR__ . '/../classes/User.php';
require_once __DIR__ . '/../index.php';

$userObj   = new User();
$allUsers  = $userObj->getAllUsers();
$loggedIn  = $_SESSION['username_sanzubooking'];

// Cari data user yang sedang login
$currentUser = null;
foreach ($allUsers as $u) {
    if ($u['username'] === $loggedIn) {
        $currentUser = $u;
        break;
    }
}
$displayName = $currentUser ? $currentUser['nama'] : $loggedIn;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sanzu Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body style="margin-bottom:50px">
<?php include __DIR__ . '/navbar.php'; ?>
<div class="container-lg">
    <div class="row">
        <?php include __DIR__ . '/sidebar.php'; ?>
        <div class="col-lg-9 mt-2">
            <?php include __DIR__ . '/' . basename($page); ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>