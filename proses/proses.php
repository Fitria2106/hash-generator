<?php
session_start();
require '../config/koneksi.php';
require '../fungsi/fungsi.php';

if (isset($_POST['submit'])) {
    $pass = str_replace(' ', '', $_POST['teks']);
    $panjang = strlen($pass);

    if (empty($pass)) {
        $_SESSION['pesan'] = "<p style='color: red;'>⚠️ Teks tidak boleh kosong.</p>";
    } elseif ($panjang > 72) {
        $_SESSION['pesan'] = "<p style='color: orange;'>⚠️ Panjang maksimal 72 karakter.</p>";
    } else {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        if (insertPassword($conn, $pass, $hash)) {
            $_SESSION['pesan'] = "<p style='color: green;'>✔️ Data berhasil ditambahkan.</p>";
        } else {
            $_SESSION['pesan'] = "<p style='color: red;'>❌ Data gagal ditambahkan.</p>";
        }
    }

    // Redirect kembali ke form
    header("Location: ../views/form_input.php");
    exit();
}
?>