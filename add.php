<?php
include 'db.php';

// Proses tambah data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $id_jurusan = $_POST['id_jurusan'];

    $sql = "INSERT INTO mahasiswa (nama, id_jurusan) VALUES ('$nama', '$id_jurusan')";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo 'Error: ' . $conn->error;
    }
}

// Ambil data jurusan untuk dropdown
$jurusan = $conn->query("SELECT * FROM jurusan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
    <h1>Tambah Mahasiswa</h1>
    <form method="POST">
        <label for="nama">Nama Mahasiswa:</label>
        <input type="text" id="nama" name="nama" required>

        <label for="id_jurusan">Jurusan:</label>
        <select id="id_jurusan" name="id_jurusan" required>
            <option value="">Pilih Jurusan</option>
            <?php while ($row = $jurusan->fetch_assoc()): ?>
                <option value="<?= $row['id_jurusan'] ?>"><?= $row['nama_jurusan'] ?></option>
            <?php endwhile; ?>
        </select>

        <button type="submit" class="btn-add">Simpan</button>
        <a href="index.php" class="btn-back">Kembali</a>
    </form>
</div>
</body>
</html>
