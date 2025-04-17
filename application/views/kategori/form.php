<!DOCTYPE html>
<html>
<head>
    <title>Formulir Buku Tamu</title>
    <link rel="stylesheet" href="<?= base_url('public/assets/styles.css') ?>">
</head>
<body>
<h2><?= isset($kategori) ? 'Edit' : 'Tambah' ?> Kategori</h2>
<form method="post">
    <label>Nama Kategori</label><br>
    <input type="text" name="nama_kategori" value="<?= isset($kategori) ? $kategori->nama_kategori : '' ?>" required><br><br>
    <button type="submit">Simpan</button>
</form>
</body>
</html>