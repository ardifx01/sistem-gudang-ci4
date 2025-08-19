<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Barang Masuk dari Pembelian</h2>
    <p>Berikut adalah daftar pembelian yang barangnya siap untuk diterima.</p>
    <hr>
    <?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
     <?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Tanggal Pembelian</th>
                <th>Vendor</th>
                <th>Total</th>
                <th>Pembeli</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($purchases)): ?>
                <tr><td colspan="6" class="text-center">Tidak ada pembelian yang perlu diproses.</td></tr>
            <?php else: ?>
                <?php $i = 1; foreach($purchases as $purchase): ?>
                <tr>
                    <th><?= $i++ ?></th>
                    <td><?= esc($purchase['purchase_date']) ?></td>
                    <td><?= esc($purchase['vendor_name']) ?></td>
                    <td>Rp <?= number_format($purchase['total_amount'], 0, ',', '.') ?></td>
                    <td><?= esc($purchase['buyer_name']) ?></td>
                    <td>
                        <a href="/incoming/process/<?= $purchase['id'] ?>" class="btn btn-sm btn-primary">Proses Barang Masuk</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>