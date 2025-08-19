<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Edit Barang</h2>
    <hr>
    <form action="/products/<?= $product['id'] ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="code" class="form-label">Kode Barang</label>
                <input type="text" class="form-control <?= ($validation->hasError('code')) ? 'is-invalid' : ''; ?>" id="code" name="code" value="<?= old('code', $product['code']) ?>">
                <div class="invalid-feedback"><?= $validation->getError('code') ?></div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nama Barang</label>
                <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?= old('name', $product['name']) ?>">
                <div class="invalid-feedback"><?= $validation->getError('name') ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select class="form-select <?= ($validation->hasError('category_id')) ? 'is-invalid' : ''; ?>" id="category_id" name="category_id">
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= (old('category_id', $product['category_id']) == $cat['id']) ? 'selected' : ''; ?>><?= esc($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('category_id') ?></div>
            </div>
             <div class="col-md-3 mb-3">
                <label for="unit" class="form-label">Satuan</label>
                <input type="text" class="form-control <?= ($validation->hasError('unit')) ? 'is-invalid' : ''; ?>" id="unit" name="unit" value="<?= old('unit', $product['unit']) ?>">
                <div class="invalid-feedback"><?= $validation->getError('unit') ?></div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="stock" class="form-label">Stok</label>
                <input type="number" class="form-control <?= ($validation->hasError('stock')) ? 'is-invalid' : ''; ?>" id="stock" name="stock" value="<?= old('stock', $product['stock']) ?>">
                <div class="invalid-feedback"><?= $validation->getError('stock') ?></div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Barang</button>
        <a href="/products" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?= $this->endSection() ?>