<?php
require '../config/koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: ../views/list.php");
    exit;
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("DELETE FROM tb_pwd WHERE id = ?");
$stmt->bind_param("i", $id);

$stmt->execute();
$stmt->close();

header("Location: ../views/list.php?status=deleted");
exit;