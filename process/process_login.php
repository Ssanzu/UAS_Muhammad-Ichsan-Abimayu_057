<?php
session_start();
require_once '../classes/User.php';

if (!empty($_POST['submit'])) {
    $user = new User();

    $hasil = $user->login($_POST['username'], $_POST['password']);

    if ($hasil) {
        $_SESSION['username_sanzubooking'] = $hasil['username'];
        header("Location: ../index.php?x=home");
    } else { ?>
        <script>
            alert("Login Gagal, pastikan username dan password benar!");
            window.location='../login.php';
        </script>
    <?php }
}
?>
