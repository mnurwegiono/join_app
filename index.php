<?php
include 'db.php';

$filterNama = isset($_GET['nama']) ? $_GET['nama'] : '';
$filterJurusan = isset($_GET['jurusan']) ? $_GET['jurusan'] : '';

// Query dengan JOIN untuk menampilkan data mahasiswa dan jurusan
$sql = "SELECT mahasiswa.id, mahasiswa.nama, jurusan.nama_jurusan 
        FROM mahasiswa 
        LEFT JOIN jurusan ON mahasiswa.id_jurusan = jurusan.id_jurusan 
        WHERE mahasiswa.nama LIKE '%$filterNama%'";

if ($filterJurusan != '') {
    $sql .= " AND mahasiswa.id_jurusan = '$filterJurusan'";
}

$result = $conn->query($sql);

// Ambil data jurusan untuk filter
$jurusan = $conn->query("SELECT * FROM jurusan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Mahasiswa dan Jurusan</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
    <h1>CRUD Mahasiswa dan Jurusan</h1>
    <form method="GET" class="filter-form">
        <input type="text" name="nama" placeholder="Nama Mahasiswa" value="<?= $filterNama ?>">
        <select name="jurusan">
            <option value="">Semua Jurusan</option>
            <?php while ($row = $jurusan->fetch_assoc()): ?>
                <option value="<?= $row['id_jurusan'] ?>" <?= $row['id_jurusan'] == $filterJurusan ? 'selected' : '' ?>>
                    <?= $row['nama_jurusan'] ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Filter</button>
    </form>
    <a href="add.php" class="btn-add">Tambah Mahasiswa</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Mahasiswa</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['nama_jurusan'] ?: 'Tidak Ada' ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
