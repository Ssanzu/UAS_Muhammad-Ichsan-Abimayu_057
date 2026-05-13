<?php
require_once '../classes/User.php';
$user = new User();
if (!empty($_POST['edit_user_validate'])) {
    if ($user->editUser((int)$_POST['id'], $_POST['name'], $_POST['username'])) {
        echo "<script>alert('Data user berhasil diubah!');window.location='../index.php?x=user';</script>";
    } else {
        echo "<script>alert('Username sudah digunakan!');window.location='../index.php?x=user';</script>";
    }
}
?>
