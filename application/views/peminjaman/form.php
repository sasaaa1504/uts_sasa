<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "username", "password", "db_barang");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

// Ambil data barang untuk dropdown
$query_barang = "SELECT * FROM barang";
$result_barang = $koneksi->query($query_barang);

// Proses peminjaman
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_peminjam = $_POST['nama_peminjam'];
    $barang_id = $_POST['barang_id'];
    $jumlah = $_POST['jumlah'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    // Cek stok barang
    $query_stok = "SELECT stok FROM barang WHERE id = $barang_id";
    $result_stok = $koneksi->query($query_stok);
    $stok = $result_stok->fetch_assoc()['stok'];

    if ($stok >= $jumlah) {
        // Insert data peminjaman
        $query = "INSERT INTO peminjaman (barang_id, nama_peminjam, jumlah, tanggal_pinjam, tanggal_kembali, status) 
                  VALUES ('$barang_id', '$nama_peminjam', '$jumlah', '$tanggal_pinjam', '$tanggal_kembali', 'dipinjam')";
        if ($koneksi->query($query) === TRUE) {
            // Update stok barang
            $stok_terbaru = $stok - $jumlah;
            $update_stok = "UPDATE barang SET stok = $stok_terbaru WHERE id = $barang_id";
            $koneksi->query($update_stok);
            echo "Peminjaman berhasil!";
        } else {
            echo "Error: " . $koneksi->error;
        }
    } else {
        echo "Stok barang tidak mencukupi!";
    }
}

// Tutup koneksi
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Barang</title>
    <link rel="stylesheet" href="<?= base_url('public/assets/styles.css') ?>">
</head>
<body>
    <h2>Form Peminjaman</h2>
    <form method="post">
        <label>Nama Peminjam</label><br>
        <input type="text" name="nama_peminjam" required><br>

        <label>Barang</label><br>
        <select name="barang_id" required>
            <?php while ($b = $result_barang->fetch_assoc()): ?>
                <option value="<?= $b['id'] ?>"><?= $b['nama_barang'] ?> (Stok: <?= $b['stok'] ?>)</option>
            <?php endwhile ?>
        </select><br>

        <label>Jumlah</label><br>
        <input type="number" name="jumlah" required><br>

        <label>Tanggal Pinjam</label><br>
        <input type="date" name="tanggal_pinjam" required><br>

        <label>Tanggal Kembali</label><br>
        <input type="date" name="tanggal_kembali" required><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
