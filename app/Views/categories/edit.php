<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Edit Kategori</h2>
    <hr>
    <form action="/categories/<?= $category['id'] ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</slabel>
            <input type="text" class="form-control <?= (validation_show_error('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?= old('name', $category['name']) ?>" autofocus>
            <div class="invalid-feedback">
                <?= validation_show_error('name') ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/categories" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?= $this->endSection() ?>