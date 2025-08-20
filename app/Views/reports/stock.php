<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Laporan Stok Barang Terkini</h3>
            </div>
            <div class="card-body">
                <p>Berikut adalah daftar jumlah stok untuk semua barang yang ada di gudang saat ini.</p>

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Kode Barang</th>
                            <th>Nama Barang</th>
                            <th >Kategori</th>
                            <th >Satuan</th>
                            <th >Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($products)): ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data barang.</td>
                            </tr>
                        <?php else: ?>
                            <?php $i = 1; foreach($products as $product): ?>
                            <tr class="<?= ($product['stock'] <= 5) ? 'table-danger' : '' ?>">
                                <td><?= $i++ ?></td>
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
        </div>
    </div>
</div>

<?= $this->endSection() ?>
