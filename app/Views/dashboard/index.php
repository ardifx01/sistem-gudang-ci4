<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3><?= esc($total_products) ?></h3>
                <p>Total Jenis Barang</p>
            </div>
            <div class="icon">
                <i class="fas fa-boxes"></i>
            </div>
            <a href="<?= site_url('products') ?>" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-purple">
            <div class="inner">
                <h3><?= esc($total_categories) ?></h3>
                <p>Total Kategori</p>
            </div>
            <div class="icon">
                <i class="fas fa-folder"></i>
            </div>
            <a href="<?= site_url('categories') ?>" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= esc($incoming_today) ?></h3>
                <p>Barang Masuk Hari Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-dolly-flatbed"></i>
            </div>
             <a href="<?= site_url('incoming') ?>" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= esc($outgoing_today) ?></h3>
                <p>Barang Keluar Hari Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-shipping-fast"></i>
            </div>
            <a href="<?= site_url('outgoing') ?>" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-7">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-exclamation-triangle mr-1"></i>
                    Barang dengan Stok Menipis (<= 5)
                </h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
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
                            <tr>
                                <td colspan="4" class="text-center py-4">Semua stok dalam kondisi aman! 👍</td>
                            </tr>
                        <?php else: ?>
                            <?php $i = 1; foreach($low_stock_products as $product): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= esc($product['name']) ?></td>
                                <td><span class="badge bg-danger"><?= esc($product['stock']) ?></span></td>
                                <td><?= esc($product['unit']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="<?= site_url('reports/stock') ?>" class="uppercase">Lihat Laporan Stok Lengkap</a>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fas fa-bullhorn text-primary"></i>
                    <strong>Selamat Datang, Admin!</strong>
                </h4>
                <br>
                <p class="card-text mt-3">
                    Gunakan menu navigasi untuk mengelola data inventori Anda.
                </p>
                <hr>
                <p>💡 **Tip:** Pantau panel "Stok Menipis" secara berkala untuk menghindari kehabisan barang penting.</p>
                <a href="<?= site_url('products/new') ?>" class="btn btn-primary mt-2">
                    <i class="fas fa-plus-circle"></i> Tambah Barang Baru
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>