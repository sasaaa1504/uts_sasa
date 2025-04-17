<!DOCTYPE html>
<html>
<head>
    <title>Formulir Buku Tamu</title>
    <link rel="stylesheet" href="<?= base_url('public/assets/styles.css') ?>">
</head>
<body>
<h2>Data Peminjaman</h2>
<a href="<?= site_url('peminjaman/tambah') ?>">+ Tambah Peminjaman</a>
<a href="<?= site_url('peminjaman/laporan') ?>" style="margin-left: 20px;">Laporan</a>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Barang</th><th>Peminjam</th><th>Jumlah</th><th>Tanggal Pinjam</th><th>Tanggal Kembali</th><th>Status</th><th>Aksi</th>
    </tr>
    <?php foreach ($peminjaman as $p): ?>
    <tr>
        <td><?= $p->nama_barang ?></td>
        <td><?= $p->nama_peminjam ?></td>
        <td><?= $p->jumlah ?></td>
        <td><?= $p->tanggal_pinjam ?></td>
        <td><?= $p->tanggal_kembali ?></td>
        <td><?= $p->status ?></td>
        <td>
            <?php if ($p->status == 'Dipinjam'): ?>
                <a href="<?= site_url('peminjaman/kembalikan/'.$p->id) ?>">Kembalikan</a>
            <?php else: ?>
                -
            <?php endif ?>
        </td>
    </tr>
    <?php endforeach ?>
</table>
</body>
</html>