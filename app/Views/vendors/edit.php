<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Edit Vendor</h2>
    <hr>
    <form action="/vendors/<?= $vendor['id'] ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Vendor</label>
            <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?= old('name', $vendor['name']) ?>" autofocus>
            <div class="invalid-feedback"><?= $validation->getError('name') ?></div>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea class="form-control" name="address" id="address" rows="3"><?= old('address', $vendor['address']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?= old('phone', $vendor['phone']) ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/vendors" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?= $this->endSection() ?>