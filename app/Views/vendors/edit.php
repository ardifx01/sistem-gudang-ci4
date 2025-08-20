<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Formulir Edit Vendor</h3>
            </div>
            <form action="<?= site_url('vendors/' . $vendor['id']) ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Vendor</label>
                        <input type="text" class="form-control <?= (validation_show_error('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?= old('name', $vendor['name']) ?>" placeholder="Masukkan nama vendor" autofocus>
                        <div class="invalid-feedback">
                            <?= validation_show_error('name') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea class="form-control <?= (validation_show_error('address')) ? 'is-invalid' : ''; ?>" name="address" id="address" rows="3" placeholder="Masukkan alamat lengkap vendor"><?= old('address', $vendor['address']) ?></textarea>
                        <div class="invalid-feedback">
                            <?= validation_show_error('address') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Telepon</label>
                        <input type="text" class="form-control <?= (validation_show_error('phone')) ? 'is-invalid' : ''; ?>" id="phone" name="phone" value="<?= old('phone', $vendor['phone']) ?>" placeholder="Masukkan nomor telepon">
                        <div class="invalid-feedback">
                            <?= validation_show_error('phone') ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update</button>
                    <a href="<?= site_url('vendors') ?>" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
                </div>
            </form>
        </div>
        </div>
</div>

<?= $this->endSection() ?>