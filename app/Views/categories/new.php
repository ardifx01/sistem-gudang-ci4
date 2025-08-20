<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Tambah Kategori Baru</h2>
    <hr>
    <form action="/categories" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control <?= (validation_show_error('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?= old('name') ?>" autofocus>
            <div class="invalid-feedback">
                <?= validation_show_error('name') ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/categories" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?= $this->endSection() ?>