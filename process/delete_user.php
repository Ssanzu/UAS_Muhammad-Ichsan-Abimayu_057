<?php
require_once '../classes/User.php';
$user = new User();
if (!empty($_POST['delete_user_validate'])) {
    if ($user->deleteUser((int)$_POST['id'])) {
        echo "<script>alert('Data user berhasil dihapus!');window.location='../index.php?x=user';</script>";
    } else {
        echo "<script>alert('Gagal menghapus user!');window.location='../index.php?x=user';</script>";
    }
}
?>
