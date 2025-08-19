<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Konfirmasi Penerimaan Barang</h2>
    <p>Anda akan memproses penerimaan barang dari pembelian berikut:</p>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Vendor:</strong> <?= esc($purchase['vendor_name']) ?></p>
            <p><strong>Tanggal Pembelian:</strong> <?= esc($purchase['purchase_date']) ?></p>
        </div>
        <div class="col-md-6">
            <p><strong>Nama Pembeli:</strong> <?= esc($purchase['buyer_name']) ?></p>
        </div>
    </div>
    
    <h4 class="mt-4">Barang yang Akan Diterima</h4>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr><th>#</th><th>Kode Barang</th><th>Nama Barang</th><th>Jumlah</th></tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach($details as $detail): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= esc($detail['product_code']) ?></td>
                <td><?= esc($detail['product_name']) ?></td>
                <td><?= esc($detail['quantity']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <form action="/incoming" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="purchase_id" value="<?= $purchase['id'] ?>">
        <p>Dengan menekan tombol konfirmasi, jumlah stok untuk barang-barang di atas akan bertambah sesuai jumlah yang diterima.</p>
        <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin memproses penerimaan barang ini?')">Konfirmasi Penerimaan Barang</button>
        <a href="/incoming" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?= $this->endSection() ?>