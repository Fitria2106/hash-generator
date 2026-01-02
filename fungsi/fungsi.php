<?php
// Fungsi untuk insert data password
function insertPassword($koneksi, $teks, $hash) {
    $stmt = $koneksi->prepare(
    	"INSERT INTO tb_pwd (password_text, password_hash) VALUES (?, ?)"
    );

    if (!$stmt) {
        return false; // jika prepare gagal
    }

    $stmt->bind_param("ss", $teks, $hash);
    
    if ($stmt->execute()) {
        $result = $stmt->affected_rows > 0;
    } else {
        $result = false;
    }

    $stmt->close();
    return $result;
}

function editPassword($koneksi, $id, $teks, $hash) {
    $stmt = $koneksi->prepare(
        "UPDATE tb_pwd 
         SET password_text = ?, password_hash = ?
         WHERE id = ?"
    );

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("ssi", $teks, $hash, $id);

    $result = $stmt->execute() && $stmt->affected_rows > 0;

    $stmt->close();
    return $result;
}


// Fungsi untuk membaca semua data password
function bacaSemuaData($koneksi) {
    $query = "SELECT * FROM tb_pwd";
    $result = $koneksi->query($query);

    if ($result && $result->num_rows > 0) {
        // Mengembalikan array asosiatif
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    } else {
        return []; // kosong jika tidak ada data atau query gagal
    }
}

function cariData($conn, $keyword) {
    $stmt = $conn->prepare(
        "SELECT * FROM tb_pwd 
         WHERE password_text LIKE ?
         ORDER BY id DESC"
    );

    $param = "%" . $keyword . "%";
    $stmt->bind_param("s", $param);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();
    return $data;
}


// // Fungsi untuk membaca data berdasarkan ID
// function getPasswordById($koneksi, $id) {
//     $stmt = $koneksi->prepare("SELECT id, password_text, password_hash FROM tb_pwd WHERE id = ?");
//     if (!$stmt) {
//         return null;
//     }

//     $stmt->bind_param("i", $id);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if ($result->num_rows > 0) {
//         $data = $result->fetch_assoc();
//         $stmt->close();
//         return $data;
//     } else {
//         $stmt->close();
//         return null; // tidak ditemukan
//     }
// }
?>