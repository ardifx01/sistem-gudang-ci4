<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Formulir Edit Barang</h3>
            </div>
            <form action="<?= site_url('products/' . $product['id']) ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="card-body">

                    <?php if (!empty(session()->getFlashdata('errors'))) : ?>
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Terdapat Kesalahan</h4>
                            <hr>
                            <p class="mb-0">
                                <?= session()->getFlashdata('errors') ?>
                            </p>
                        </div>
                    <?php endif ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code">Kode Barang</label>
                                <input type="text" class="form-control <?= (validation_show_error('code')) ? 'is-invalid' : ''; ?>" id="code" name="code" value="<?= old('code', $product['code']) ?>" placeholder="Masukkan Kode Barang">
                                <div class="invalid-feedback">
                                    <?= validation_show_error('code') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Barang</label>
                                <input type="text" class="form-control <?= (validation_show_error('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?= old('name', $product['name']) ?>" placeholder="Masukkan Nama Barang">
                                <div class="invalid-feedback">
                                    <?= validation_show_error('name') ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                             <div class="form-group">
                                <label for="category_id">Kategori</label>
                                <select class="form-control <?= (validation_show_error('category_id')) ? 'is-invalid' : ''; ?>" id="category_id" name="category_id">
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>" <?= (old('category_id', $product['category_id']) == $cat['id']) ? 'selected' : ''; ?>><?= esc($cat['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('category_id') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="unit">Satuan</label>
                                <input type="text" class="form-control <?= (validation_show_error('unit')) ? 'is-invalid' : ''; ?>" id="unit" name="unit" value="<?= old('unit', $product['unit']) ?>" placeholder="Contoh: Unit, Pcs">
                                <div class="invalid-feedback">
                                    <?= validation_show_error('unit') ?>
                                </div>
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="stock">Stok Saat Ini</label>
                                <input type="number" class="form-control" id="stock" name="stock" value="<?= old('stock', $product['stock']) ?>" readonly>
                                <small class="form-text text-muted">Stok hanya bisa diubah melalui transaksi.</small>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update Barang</button>
                    <a href="<?= site_url('products') ?>" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
                </div>
            </form>
        </div>
        </div>
</div>

<?= $this->endSection() ?>