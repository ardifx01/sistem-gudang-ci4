<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Laporan Barang Masuk</h3>
            </div>
            <div class="card-body">

                <!-- Filter Form -->
                <form method="get" action="/reports/incoming" class="row mb-4">
                    <div class="col-md-5">
                        <label for="start_date" class="form-label">Dari Tanggal</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" 
                               value="<?= esc($startDate) ?>">
                    </div>
                    <div class="col-md-5">
                        <label for="end_date" class="form-label">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" 
                               value="<?= esc($endDate) ?>">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </form>

                <!-- Table Data -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead class="table">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 15%;">Tanggal Masuk</th>
                            <th style="width: 15%;">Kode Barang</th>
                            <th>Nama Barang</th>
                            <th style="width: 10%;">Jumlah</th>
                            <th style="width: 15%;">ID Pembelian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($transactions)): ?>
                            <tr>
                                <td colspan="6" class="text-center">
                                    Tidak ada data untuk rentang tanggal yang dipilih.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $i = 1; foreach($transactions as $trx): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= esc($trx['incoming_date']) ?></td>
                                <td><?= esc($trx['product_code']) ?></td>
                                <td><?= esc($trx['product_name']) ?></td>
                                <td><?= esc($trx['quantity']) ?></td>
                                <td>
                                    <a href="/purchases/<?= $trx['purchase_id'] ?>" class="btn btn-link btn-sm">
                                        #<?= esc($trx['purchase_id']) ?>
                                    </a>
                                </td>
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
        </div>
    </div>
</div>

<?= $this->endSection() ?>
