<?php
require '../config/koneksi.php';
require '../fungsi/fungsi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../views/list.php");
    exit;
}

$id        = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$teks_baru = trim($_POST['teks_baru'] ?? '');

if ($id <= 0 || $teks_baru === '') {
    echo "Data tidak valid.";
    exit;
}

/* HASH ULANG (wajib, karena plaintext berubah) */
$hash_baru = password_hash($teks_baru, PASSWORD_DEFAULT);

/* UPDATE */
if (editPassword($conn, $id, $teks_baru, $hash_baru)) {
    header("Location: ../views/list.php?status=success");
} else {
    header("Location: ../views/list.php?status=failed");
}
exit;