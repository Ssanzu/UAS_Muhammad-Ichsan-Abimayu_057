<?php
session_start();
if (empty($_SESSION['username_sanzubooking'])) {
    header("Location: login.php");
    exit;
}

$x = isset($_GET['x']) ? $_GET['x'] : 'home';
$allowed = ['home', 'booking', 'order', 'payment', 'user'];

if (in_array($x, $allowed)) {
    $page = 'views/' . $x . '.php';
} else {
    $page = 'views/home.php';
}

require_once __DIR__ . '/view/main.php';
?>