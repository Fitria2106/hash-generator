<?php
session_start();  // Pastikan ada di atas!

// Ambil pesan dari session, lalu hapus agar tidak muncul lagi setelah refresh
$pesan = '';
if (isset($_SESSION['pesan'])) {
    $pesan = $_SESSION['pesan'];
    unset($_SESSION['pesan']);  // Hapus agar hanya muncul sekali
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Generate Password Hash</title>

	<!-- MATRIX THEME -->
	<link rel="stylesheet" href="../assets/css/gen_matrix.css">
</head>
<body>

<!-- MATRIX BACKGROUND -->
<canvas id="matrix"></canvas>

<!-- CONTENT -->
<div class="matrix-wrapper">
	<div class="matrix-card">

		<h2>GENERATE</h2>

		<div class="matrix-nav">
			<a href="./">Home</a> |
			<a href="list.php">List</a>
		</div>

		<div class="matrix-info">
			Panjang karakter minimal 1, maksimal 72.<br>
			Spasi akan dihapus.
		</div>

		<form action="../proses/proses.php" method="post">
			<input type="text"
			       name="teks"
			       id="teks"
			       placeholder="Masukan Teks"
			       required>
			<button type="submit" name="submit">Generate</button>
		</form>

		<!-- STATUS -->
		<?php if (!empty($pesan)): ?>
		    <div class="status-pesan" id="autoCopy">
		        <?= $pesan ?>
		    </div>
		<?php endif; ?>

	</div>
</div>

<!-- MATRIX SCRIPT -->
<script src="../assets/js/gen_matrix.js"></script>

</body>
</html>
