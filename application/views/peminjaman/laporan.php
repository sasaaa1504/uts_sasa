<!DOCTYPE html>
<html>
<head>
    <title>Formulir Buku Tamu</title>
    <link rel="stylesheet" href="<?= base_url('public/assets/styles.css') ?>">
</head>
<body>
<h2>Laporan Peminjaman</h2>
<form method="post">
    <label>Dari Tanggal</label>
    <input type="date" name="start" value="<?= isset($start) ? $start : '' ?>">
    <label>Sampai Tanggal</label>
    <input type="date" name="end" value="<?= isset($end) ? $end : '' ?>">
    <button type="submit">Filter</button>
</form>

<?php if (!empty($laporan)): ?>
    <h3>Hasil Laporan:</h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Barang</th><th>Peminjam</th><th>Jumlah</th><th>Tanggal Pinjam</th><th>Status</th>
        </tr>
        <?php foreach ($laporan as $l): ?>
        <tr>
            <td><?= $l->nama_barang ?></td>
            <td><?= $l->nama_peminjam ?></td>
            <td><?= $l->jumlah ?></td>
            <td><?= $l->tanggal_pinjam ?></td>
            <td><?= $l->status ?></td>
        </tr>
        <?php endforeach ?>
    </table>
<?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
    <p>Tidak ada data ditemukan dalam rentang tanggal tersebut.</p>
<?php endif ?></body>
</html>