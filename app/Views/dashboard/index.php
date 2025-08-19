<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Dashboard</h2>
    <hr>
    
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Jenis Barang</h5>
                    <p class="card-text fs-3"><?= esc($total_products) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Vendor</h5>
                    <p class="card-text fs-3"><?= esc($total_vendors) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Barang Masuk Hari Ini</h5>
                    <p class="card-text fs-3"><?= esc($incoming_today) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Barang Keluar Hari Ini</h5>
                    <p class="card-text fs-3"><?= esc($outgoing_today) ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Barang dengan Stok Menipis (<= 5)
                </div>
                <div class="card-body">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($low_stock_products)): ?>
                                <tr><td colspan="4" class="text-center">Semua stok aman.</td></tr>
                            <?php else: ?>
                                <?php $i = 1; foreach($low_stock_products as $product): ?>
                                <tr>
                                    <th><?= $i++ ?></th>
                                    <td><?= esc($product['name']) ?></td>
                                    <td><span class="badge bg-danger"><?= esc($product['stock']) ?></span></td>
                                    <td><?= esc($product['unit']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>