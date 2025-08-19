<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Detail Pembelian</h2>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Vendor:</strong> <?= esc($purchase['vendor_name']) ?></p>
            <p><strong>Tanggal Pembelian:</strong> <?= esc($purchase['purchase_date']) ?></p>
        </div>
        <div class="col-md-6">
            <p><strong>Nama Pembeli:</strong> <?= esc($purchase['buyer_name']) ?></p>
            <p><strong>Total:</strong> Rp <?= number_format($purchase['total_amount'], 0, ',', '.') ?></p>
        </div>
    </div>
    
    <h4 class="mt-4">Barang yang Dibeli</h4>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach($details as $detail): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= esc($detail['product_code']) ?></td>
                <td><?= esc($detail['product_name']) ?></td>
                <td><?= esc($detail['quantity']) ?></td>
                <td>Rp <?= number_format($detail['price'], 0, ',', '.') ?></td>
                <td>Rp <?= number_format($detail['quantity'] * $detail['price'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/purchases" class="btn btn-secondary">Kembali ke Daftar Pembelian</a>
</div>
<?= $this->endSection() ?>