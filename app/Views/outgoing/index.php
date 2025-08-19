<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Transaksi Barang Keluar</h2>
        <a href="/outgoing/new" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Catat Transaksi</a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Tanggal Keluar</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($transactions)): ?>
                <tr>
                    <td colspan="6" class="text-center">Belum ada transaksi barang keluar.</td>
                </tr>
            <?php else: ?>
                <?php $i = 1; foreach($transactions as $trx): ?>
                <tr>
                    <th><?= $i++ ?></th>
                    <td><?= esc($trx['outgoing_date']) ?></td>
                    <td><?= esc($trx['product_code']) ?></td>
                    <td><?= esc($trx['product_name']) ?></td>
                    <td><?= esc($trx['quantity']) ?></td>
                    <td><?= esc($trx['description']) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>