<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Vendor</h2>
        <a href="/vendors/new" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Vendor</a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nama Vendor</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
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
                    <th><?= $i++ ?></th>
                    <td><?= esc($vendor['name']) ?></td>
                    <td><?= esc($vendor['address']) ?></td>
                    <td><?= esc($vendor['phone']) ?></td>
                    <td>
                        <a href="/vendors/edit/<?= $vendor['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                        <form action="/vendors/<?= $vendor['id'] ?>" method="POST" class="d-inline">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?');"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>