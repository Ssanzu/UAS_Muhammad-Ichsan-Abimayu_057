<?php $x = isset($_GET['x']) ? $_GET['x'] : 'home'; ?>
<div class="col-lg-3">
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded border mt-2">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarCanvas">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" id="sidebarCanvas">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav nav-tabs flex-column flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link <?= ($x == 'home' || $x == '') ? 'active' : '' ?>" href="index.php?x=home">
                                <i class="bi bi-house"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $x == 'order' ? 'active' : '' ?>" href="index.php?x=order">
                                <i class="bi bi-receipt"></i> Your Order
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $x == 'user' ? 'active' : '' ?>" href="index.php?x=user">
                                <i class="bi bi-people"></i> User
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>