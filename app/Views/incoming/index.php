<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Pembelian (Status Pending)</h3>
            </div>
            <div class="card-body">
                <p class="mb-3">Berikut adalah daftar pembelian yang siap diproses untuk dicatat sebagai transaksi barang masuk.</p>
                
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th>Tanggal Pembelian</th>
                            <th>Vendor</th>
                            <th>Total</th>
                            <th>Pembeli</th>
                            <th style="width: 20%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($purchases)): ?>
                            <tr><td colspan="6" class="text-center">Tidak ada pembelian yang perlu diproses.</td></tr>
                        <?php else: ?>
                            <?php $i = 1; foreach($purchases as $purchase): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= date('d M Y', strtotime($purchase['purchase_date'])) ?></td>
                                <td><?= esc($purchase['vendor_name']) ?></td>
                                <td>Rp <?= number_format($purchase['total_amount'], 0, ',', '.') ?></td>
                                <td><?= esc($purchase['buyer_name']) ?></td>
                                <td class="text-center">
                                    <a href="<?= site_url('incoming/process/' . $purchase['id']) ?>" class="btn btn-sm btn-primary" title="Proses menjadi barang masuk">
                                        <i class="fas fa-dolly-flatbed"></i> Proses
                                    </a>
                                </td>
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