<!DOCTYPE html>
<html>
<head>
    <title>Form Pengembalian Barang</title>
</head>
<body>
    <h2>Form Pengembalian Barang</h2>
    <form method="post">
        <label>Pilih Peminjaman</label><br>
        <select name="peminjaman_id" required>
            <?php foreach ($peminjaman as $p): ?>
                <option value="<?= $p->id ?>">ID: <?= $p->id ?> - <?= $p->nama_peminjam ?> - Barang ID: <?= $p->barang_id ?> - Jumlah: <?= $p->jumlah ?></option>
            <?php endforeach ?>
        </select><br><br>

        <button type="submit">Kembalikan Barang</button>
    </form>
</body>
</html>
