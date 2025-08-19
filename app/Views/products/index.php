<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Barang</h2>
        <a href="/products/new" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Barang</a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($products)): ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data barang.</td>
                </tr>
            <?php else: ?>
                <?php $i = 1; foreach($products as $product): ?>
                <tr>
                    <th><?= $i++ ?></th>
                    <td><?= esc($product['code']) ?></td>
                    <td><?= esc($product['name']) ?></td>
                    <td><?= esc($product['category_name']) ?></td>
                    <td><?= esc($product['unit']) ?></td>
                    <td><?= esc($product['stock']) ?></td>
                    <td>
                        <a href="/products/edit/<?= $product['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                        <form action="/products/<?= $product['id'] ?>" method="POST" class="d-inline">
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