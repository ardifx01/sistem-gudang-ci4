<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Pembelian</h2>
        <a href="/purchases/new" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Buat Pembelian</a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Vendor</th>
                <th>Total Pembelian</th>
                <th>Nama Pembeli</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($purchases)): ?>
                <tr><td colspan="6" class="text-center">Belum ada data pembelian.</td></tr>
            <?php else: ?>
                <?php $i = 1; foreach($purchases as $purchase): ?>
                <tr>
                    <th><?= $i++ ?></th>
                    <td><?= esc($purchase['purchase_date']) ?></td>
                    <td><?= esc($purchase['vendor_name']) ?></td>
                    <td>Rp <?= number_format($purchase['total_amount'], 0, ',', '.') ?></td>
                    <td><?= esc($purchase['buyer_name']) ?></td>
                    <td>
                        <a href="/purchases/<?= $purchase['id'] ?>" class="btn btn-sm btn-info"><i class="bi bi-eye"></i> Detail</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>