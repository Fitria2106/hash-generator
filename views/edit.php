<?php
require '../fungsi/fungsi.php';
require '../config/koneksi.php';

$teks_lama = '';
$id = null;

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $stmt = $conn->prepare("SELECT password_text FROM tb_pwd WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $teks_lama = $row['password_text'];
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Plain Text</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/edit_matrix.css">
</head>
<body>

<canvas id="matrix"></canvas>

<div class="matrix-wrapper">
    <div class="matrix-card">
        <h1>EDIT PLAIN TEXT</h1>

        <div class="nav-links">
            <a href="./">Home</a> |
            <a href="list.php">Hash List</a> |
            <a href="form_input.php">Generate Hash</a>
        </div>

        <form method="post" action="../proses/proses_edit.php">
            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="mb-3">
                <label class="form-label">Edit teks</label>
                <input type="text"
                       name="teks_baru"
                       class="form-control"
                       value="<?= htmlspecialchars($teks_lama); ?>"
                       required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-matrix">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MATRIX SCRIPT -->
<script src="../assets/js/edit_matrix.js"></script>

</body>
</html>
