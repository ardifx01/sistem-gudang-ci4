<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Manajemen Data Pembelian</h3>
                <div class="card-tools">
                    <a href="<?= site_url('purchases/new') ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i> Buat Pembelian
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

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th>Tanggal</th>
                            <th>Vendor</th>
                            <th>Total</th>
                            <th>Pembeli</th>
                            <th class="text-center">Status</th>
                            <th style="width: 15%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($purchases)): ?>
                            <tr><td colspan="7" class="text-center">Belum ada data pembelian.</td></tr>
                        <?php else: ?>
                            <?php $i = 1; foreach($purchases as $purchase): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= date('d M Y', strtotime($purchase['purchase_date'])) ?></td>
                                <td><?= esc($purchase['vendor_name']) ?></td>
                                <td>Rp <?= number_format($purchase['total_amount'], 0, ',', '.') ?></td>
                                <td><?= esc($purchase['buyer_name']) ?></td>
                                <td class="text-center">
                                    <?php if ($purchase['status'] == 'Pending'): ?>
                                        <span class="badge badge-warning">Pending</span>
                                    <?php else: ?>
                                        <span class="badge badge-success">Selesai</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= site_url('purchases/' . $purchase['id']) ?>" class="btn btn-sm btn-info" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <?php if ($purchase['status'] == 'Pending'): ?>
                                        <a href="<?= site_url('purchases/' . $purchase['id'] . '/edit') ?>" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?= site_url('purchases/' . $purchase['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
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