<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Laporan Barang Masuk</h2>
    <hr>
    
    <form method="get" action="/reports/incoming" class="row g-3 mb-4">
        <div class="col-md-5">
            <label for="start_date" class="form-label">Dari Tanggal</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="<?= esc($startDate) ?>">
        </div>
        <div class="col-md-5">
            <label for="end_date" class="form-label">Sampai Tanggal</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="<?= esc($endDate) ?>">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Tanggal Masuk</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>ID Pembelian</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($transactions)): ?>
                <tr><td colspan="6" class="text-center">Tidak ada data untuk rentang tanggal yang dipilih.</td></tr>
            <?php else: ?>
                <?php $i = 1; foreach($transactions as $trx): ?>
                <tr>
                    <th><?= $i++ ?></th>
                    <td><?= esc($trx['incoming_date']) ?></td>
                    <td><?= esc($trx['product_code']) ?></td>
                    <td><?= esc($trx['product_name']) ?></td>
                    <td><?= esc($trx['quantity']) ?></td>
                    <td><a href="/purchases/<?= $trx['purchase_id'] ?>">#<?= esc($trx['purchase_id']) ?></a></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <tfoot class="table-light">
            <tr>
                <td colspan="4" class="text-end"><strong>Total Kuantitas Masuk</strong></td>
                <td colspan="2"><strong><?= esc($totalQuantity) ?></strong></td>
            </tr>
        </tfoot>
    </table>
</div>
<?= $this->endSection() ?>