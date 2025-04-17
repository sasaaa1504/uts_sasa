<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "username", "password", "db_barang");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

// Ambil data pengembalian (status 'dikembalikan')
$query_pengembalian = "SELECT p.id, p.nama_peminjam, b.nama_barang, p.jumlah, p.tanggal_pinjam, p.tanggal_kembali 
                       FROM peminjaman p
                       JOIN barang b ON p.barang_id = b.id
                       WHERE p.status = 'dikembalikan'";
$result_pengembalian = $koneksi->query($query_pengembalian);

// Tutup koneksi
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengembalian Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Daftar Pengembalian Barang</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID Peminjaman</th>
                    <th>Nama Peminjam</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($p = $result_pengembalian->fetch_assoc()): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= $p['nama_peminjam'] ?></td>
                        <td><?= $p['nama_barang'] ?></td>
                        <td><?= $p['jumlah'] ?></td>
                        <td><?= $p['tanggal_pinjam'] ?></td>
                        <td><?= $p['tanggal_kembali'] ?></td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</body>
</html>
