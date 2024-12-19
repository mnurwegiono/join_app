<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM mahasiswa WHERE id = $id";
$result = $conn->query($sql);
$mahasiswa = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $id_jurusan = $_POST['id_jurusan'];

    $sql = "UPDATE mahasiswa SET nama = '$nama', id_jurusan = '$id_jurusan' WHERE id = $id";
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
    <title>Edit Mahasiswa</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
    <h1>Edit Mahasiswa</h1>
    <form method="POST">
        <label for="nama">Nama Mahasiswa:</label>
        <input type="text" id="nama" name="nama" value="<?= $mahasiswa['nama'] ?>" required>

        <label for="id_jurusan">Jurusan:</label>
        <select id="id_jurusan" name="id_jurusan" required>
            <option value="">Pilih Jurusan</option>
            <?php while ($row = $jurusan->fetch_assoc()): ?>
                <option value="<?= $row['id_jurusan'] ?>" <?= $row['id_jurusan'] == $mahasiswa['id_jurusan'] ? 'selected' : '' ?>>
                    <?= $row['nama_jurusan'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit" class="btn-add">Simpan</button>
        <a href="index.php" class="btn-back">Kembali</a>
    </form>
</div>
</body>
</html>
