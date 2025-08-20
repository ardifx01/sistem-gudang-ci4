<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Formulir Edit Kategori</h3>
            </div>
            <form action="<?= site_url('categories/' . $category['id']) ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Kategori</label>
                        <input type="text" class="form-control <?= (validation_show_error('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?= old('name', $category['name']) ?>" placeholder="Masukkan nama kategori" autofocus>
                        <div class="invalid-feedback">
                            <?= validation_show_error('name') ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update</button>
                    <a href="<?= site_url('categories') ?>" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
                </div>
            </form>
        </div>
        </div>
</div>

<?= $this->endSection() ?>