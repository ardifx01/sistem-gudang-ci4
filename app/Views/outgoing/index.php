<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Riwayat Transaksi Barang Keluar</h3>
                <div class="card-tools">
                    <a href="<?= site_url('outgoing/new') ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i> Catat Transaksi
                    </a>
                </div>
            </div>
            <div class="card-body">

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
                            <th>Tanggal Keluar</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th class="text-right">Jumlah</th>
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
                                <td><?= $i++ ?></td>
                                <td><?= date('d M Y', strtotime($trx['outgoing_date'])) ?></td>
                                <td><?= esc($trx['product_code']) ?></td>
                                <td><?= esc($trx['product_name']) ?></td>
                                <td class="text-right"><?= esc($trx['quantity']) ?></td>
                                <td><?= esc($trx['description']) ?></td>
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