<?php 
require '../config/koneksi.php';
require '../fungsi/fungsi.php';

if (isset($_GET['teks']) && $_GET['teks'] !== '') {
    $keyword = trim($_GET['teks']);
    $data = cariData($conn, $keyword);
} else {
    $data = bacaSemuaData($conn);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hash List</title>

	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../assets/css/list_matrix.css">
</head>
<body>

<canvas id="matrix"></canvas>

<div class="container matrix-container">
	<h1>HASH LIST</h1>

	<div class="nav-links">
		<a href="./">Home</a> |
		<a href="form_input.php">Generate Hash</a>
	</div>

	<!-- SEARCH -->
	<div class="search-box">
		<form method="get">
			<label class="mb-1">Search Plain Text</label>
			<div class="input-group">
				<input type="text"
				       name="teks"
				       class="form-control"
				       placeholder="Cari teks..."
				       value="<?= htmlspecialchars($_GET['teks'] ?? '') ?>">
				<button class="btn btn-matrix">Search</button>
			</div>
		</form>
	</div>

	<!-- TABLE -->
	<div class="table-responsive">
		<table class="table table-matrix table-hover align-middle text-center">
			<thead>
				<tr>
					<th>No</th>
					<th>Teks</th>
					<th>Hash</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; ?>
				<?php foreach ($data as $dt): ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= htmlspecialchars($dt['password_text']); ?></td>
					<td class="text-break"><?= htmlspecialchars($dt['password_hash']); ?></td>
					<td>
						<a href="edit.php?id=<?= $dt['id']; ?>" class="btn btn-sm btn-matrix">Edit</a>
						<a href="../proses/delete.php?id=<?= $dt['id']; ?>" 
						   class="btn btn-sm btn-matrix"
						   onclick="return confirm('Yakin hapus data?')">Hapus</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- MATRIX SCRIPT -->
<script src="../assets/js/list_matrix.js"></script>

</body>
</html>