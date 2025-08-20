<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Tambah Barang Baru</h2>
    <hr>
    <form action="/products" method="post">
        <?= csrf_field() ?>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="code" class="form-label">Kode Barang</label>
                <input type="text" class="form-control <?= (validation_show_error('code')) ? 'is-invalid' : ''; ?>" id="code" name="code" value="<?= old('code') ?>">
                <div class="invalid-feedback"><?= validation_show_error('code') ?></div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nama Barang</label>
                <input type="text" class="form-control <?= (validation_show_error('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?= old('name') ?>">
                <div class="invalid-feedback"><?= validation_show_error('name') ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select class="form-select <?= (validation_show_error('category_id')) ? 'is-invalid' : ''; ?>" id="category_id" name="category_id">
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= (old('category_id') == $cat['id']) ? 'selected' : ''; ?>><?= esc($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= validation_show_error('category_id') ?></div>
            </div>
             <div class="col-md-3 mb-3">
                <label for="unit" class="form-label">Satuan</label>
                <input type="text" class="form-control <?= (validation_show_error('unit')) ? 'is-invalid' : ''; ?>" id="unit" name="unit" value="<?= old('unit') ?>" placeholder="Contoh: Unit, Pcs, Kg">
                <div class="invalid-feedback"><?= validation_show_error('unit') ?></div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="stock" class="form-label">Stok Awal</label>
                <input type="number" class="form-control <?= (validation_show_error('stock')) ? 'is-invalid' : ''; ?>" id="stock" name="stock" value="<?= old('stock', 0) ?>">
                <div class="invalid-feedback"><?= validation_show_error('stock') ?></div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Barang</button>
        <a href="/products" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?= $this->endSection() ?>