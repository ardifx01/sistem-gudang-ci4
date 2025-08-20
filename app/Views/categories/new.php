<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulir Tambah Kategori Baru</h3>
            </div>
            <form action="<?= site_url('categories') ?>" method="post">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Kategori</label>
                        <input type="text" class="form-control <?= (validation_show_error('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?= old('name') ?>" placeholder="Masukkan nama kategori" autofocus>
                        <div class="invalid-feedback">
                            <?= validation_show_error('name') ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <a href="<?= site_url('categories') ?>" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
                </div>
            </form>
        </div>
        </div>
</div>

<?= $this->endSection() ?>