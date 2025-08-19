<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Laporan Stok Barang Terkini</h2>
    <p>Berikut adalah daftar jumlah stok untuk semua barang yang ada di gudang saat ini.</p>
    <hr>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Satuan</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($products)): ?>
                <tr><td colspan="6" class="text-center">Tidak ada data barang.</td></tr>
            <?php else: ?>
                <?php $i = 1; foreach($products as $product): ?>
                <tr class="<?= ($product['stock'] <= 5) ? 'table-danger' : '' ?>">
                    <th><?= $i++ ?></th>
                    <td><?= esc($product['code']) ?></td>
                    <td><?= esc($product['name']) ?></td>
                    <td><?= esc($product['category_name']) ?></td>
                    <td><?= esc($product['unit']) ?></td>
                    <td><strong><?= esc($product['stock']) ?></strong></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>