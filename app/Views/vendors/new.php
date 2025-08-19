<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Tambah Vendor Baru</h2>
    <hr>
    <form action="/vendors" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="name" class="form-label">Nama Vendor</label>
            <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?= old('name') ?>" autofocus>
            <div class="invalid-feedback"><?= $validation->getError('name') ?></div>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea class="form-control" name="address" id="address" rows="3"><?= old('address') ?></textarea>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?= old('phone') ?>">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/vendors" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?= $this->endSection() ?>