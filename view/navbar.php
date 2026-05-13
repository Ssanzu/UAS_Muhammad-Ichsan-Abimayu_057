<?php
require_once __DIR__ . '/../classes/User.php';
require_once __DIR__ . '/main.php';
$userObj   = new User();
?>


<nav class="navbar navbar-expand navbar-dark bg-dark sticky-top">
    <div class="container-lg">
        <a class="navbar-brand" href="index.php?x=home"><i class="bi bi-building"></i> Sanzu Booking</a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <?php echo htmlspecialchars($displayName); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li><a class="dropdown-item" href="process/process_logout.php"><i class="bi bi-box-arrow-in-left"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>