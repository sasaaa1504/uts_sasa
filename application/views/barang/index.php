<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Buku Tamu</title>
    <!-- Link ke CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('public/assets/styles.css') ?>">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Daftar Barang</h2>
        <a href="<?= site_url('barang/tambah') ?>" class="btn btn-success mb-3">+ Tambah Barang</a>
        
        <!-- Tabel Barang -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barang as $b): ?>
                <tr>
                    <td><?= $b->id ?></td>
                    <td><?= $b->nama_barang ?></td>
                    <td><?= $b->nama_kategori ?></td>
                    <td><?= $b->stok ?></td>
                    <td><?= $b->deskripsi ?></td>
                    <td>
                        <a href="<?= site_url('barang/edit/'.$b->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= site_url('barang/hapus/'.$b->id) ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <a href="pengembalian.php">Pengembalian Barang</a>
    <!-- Link ke JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
