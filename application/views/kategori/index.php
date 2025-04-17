<!DOCTYPE html>
<html>
<head>
    <title>Formulir Buku Tamu</title>
    <link rel="stylesheet" href="<?= base_url('public/assets/styles.css') ?>">
</head>
<body>
<h2>Daftar Kategori</h2>
<a href="<?= site_url('kategori/tambah') ?>">+ Tambah Kategori</a>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th><th>Nama Kategori</th><th>Aksi</th>
    </tr>
    <?php foreach ($kategori as $k): ?>
    <tr>
        <td><?= $k->id ?></td>
        <td><?= $k->nama_kategori ?></td>
        <td>
            <a href="<?= site_url('kategori/edit/'.$k->id) ?>">Edit</a> |
            <a href="<?= site_url('kategori/hapus/'.$k->id) ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach ?>
</table>
</body>
</html>