<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Manajemen Data Vendor</h3>
                <div class="card-tools">
                    <a href="<?= site_url('vendors/new') ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i> Tambah Vendor
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
                            <th style="width: 10%;">#</th>
                            <th>Nama Vendor</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th style="width: 15%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($vendors)): ?>
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data vendor.</td>
                            </tr>
                        <?php else: ?>
                            <?php $i = 1; foreach($vendors as $vendor): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= esc($vendor['name']) ?></td>
                                <td><?= esc($vendor['address']) ?></td>
                                <td><?= esc($vendor['phone']) ?></td>
                                <td class="text-center">
                                    <a href="<?= site_url('vendors/edit/' . $vendor['id']) ?>" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?= site_url('vendors/' . $vendor['id']) ?>" method="POST" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus vendor ini?');">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
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