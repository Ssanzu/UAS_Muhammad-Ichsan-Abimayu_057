<?php
require_once '../classes/User.php';
$user = new User();
if (!empty($_POST['input_user_validate'])) {
    if ($user->addUser($_POST['name'], $_POST['username'])) {
        echo "<script>alert('Data user berhasil ditambahkan!');window.location='../index.php?x=user';</script>";
    } else {
        echo "<script>alert('Username sudah digunakan!');window.location='../index.php?x=user';</script>";
    }
}
?>
