<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "username", "password", "db_barang");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

// Ambil data peminjaman yang belum dikembalikan
$query_peminjaman = "SELECT p.id, p.nama_peminjam, b.nama_barang, p.jumlah FROM peminjaman p JOIN barang b ON p.barang_id = b.id WHERE p.status = 'dipinjam'";
$result_peminjaman = $koneksi->query($query_peminjaman);

// Proses pengembalian
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $peminjaman_id = $_POST['peminjaman_id'];

    // Update status peminjaman menjadi dikembalikan
    $update_peminjaman = "UPDATE peminjaman SET status = 'dikembalikan' WHERE id = ?";
    $stmt = $koneksi->prepare($update_peminjaman);
    $stmt->bind_param("i", $peminjaman_id);
    $stmt->execute();

    // Ambil data peminjaman untuk update stok
    $query_detail = "SELECT barang_id, jumlah FROM peminjaman WHERE id = ?";
    $stmt = $koneksi->prepare($query_detail);
    $stmt->bind_param("i", $peminjaman_id);
    $stmt->execute();
    $result_detail = $stmt->get_result();
    $detail = $result_detail->fetch_assoc();

    // Update stok barang
    $barang_id = $detail['barang_id'];
    $jumlah = $detail['jumlah'];
    $query_stok = "SELECT stok FROM barang WHERE id = ?";
    $stmt = $koneksi->prepare($query_stok);
    $stmt->bind_param("i", $barang_id);
    $stmt->execute();
    $result_stok = $stmt->get_result();
    $stok = $result_stok->fetch_assoc()['stok'];
    
    $stok_terbaru = $stok + $jumlah;
    $update_stok = "UPDATE barang SET stok = ? WHERE id = ?";
    $stmt = $koneksi->prepare($update_stok);
    $stmt->bind_param("ii", $stok_terbaru, $barang_id);
    $stmt->execute();

    echo "Pengembalian berhasil!";
}

// Tutup koneksi
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengembalian Barang</title>
</head>
<body>
    <h2>Form Pengembalian Barang</h2>
    <form method="post">
        <label>Peminjaman ID</label><br>
        <select name="peminjaman_id" required>
            <?php while ($p = $result_peminjaman->fetch_assoc()): ?>
                <option value="<?= $p['id'] ?>">Peminjaman ID: <?= $p['id'] ?> - Barang: <?= $p['nama_barang'] ?> (Peminjam: <?= $p['nama_peminjam'] ?>)</option>
            <?php endwhile ?>
        </select><br><br>

        <button type="submit">Kembalikan</button>
    </form>
</body>
</html>
