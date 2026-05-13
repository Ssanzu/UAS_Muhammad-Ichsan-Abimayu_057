<?php
session_start();
if (!empty($_SESSION['username_sanzubooking'])) {
    header("Location: index.php?x=home");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Sanzu Booking — Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body { background: #f8f9fa; }
        .form-signin { width: 100%; max-width: 380px; padding: 15px; margin: auto; }
        .form-signin .form-floating:focus-within { z-index: 2; }
        .form-signin input[type="email"]  { margin-bottom: -1px; border-bottom-right-radius: 0; border-bottom-left-radius: 0; }
        .form-signin input[type="password"] { margin-bottom: 10px; border-top-left-radius: 0; border-top-right-radius: 0; }
    </style>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary" style="min-height:100vh">
<main class="form-signin w-100 m-auto">
    <form action="process/process_login.php" method="post">
        <h1 class="h3 mb-3 fw-normal text-center"><i class="bi bi-building"></i> Sanzu Booking</h1>
        <p class="text-center text-muted mb-4">Please sign in</p>
        <div class="form-floating">
            <input name="username" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
        </div>
        <button class="btn btn-dark w-100 py-2 mt-2" type="submit" name="submit" value="abc">Login</button>
        <p class="mt-4 mb-3 text-center text-body-secondary">&copy; 2025–2026 Sanzu Booking</p>
    </form>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>