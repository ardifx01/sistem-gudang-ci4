<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulir Transaksi Barang Keluar</h3>
            </div>
            <form action="<?= site_url('outgoing') ?>" method="post">
                <?= csrf_field() ?>
                <div class="card-body">

                    <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="product_id">Pilih Barang</label>
                                <select class="form-control select2 <?= (validation_show_error('product_id')) ? 'is-invalid' : ''; ?>" name="product_id" id="product_id" style="width: 100%;">
                                    <option value="">-- Cari berdasarkan Kode atau Nama Barang --</option>
                                    <?php foreach($products as $product): ?>
                                        <option value="<?= $product['id'] ?>" <?= (old('product_id') == $product['id']) ? 'selected' : ''; ?>>
                                            <?= esc($product['code'] . ' - ' . $product['name'] . ' (Stok Tersedia: ' . $product['stock'] . ')') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback"><?= validation_show_error('product_id') ?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantity">Jumlah Keluar</label>
                                <input type="number" class="form-control <?= (validation_show_error('quantity')) ? 'is-invalid' : ''; ?>" id="quantity" name="quantity" value="<?= old('quantity') ?>" placeholder="Masukkan jumlah">
                                <div class="invalid-feedback"><?= validation_show_error('quantity') ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="outgoing_date">Tanggal Keluar</label>
                                <input type="date" class="form-control <?= (validation_show_error('outgoing_date')) ? 'is-invalid' : ''; ?>" id="outgoing_date" name="outgoing_date" value="<?= old('outgoing_date', date('Y-m-d')) ?>">
                                <div class="invalid-feedback"><?= validation_show_error('outgoing_date') ?></div>
                            </div>
                        </div>
                         <div class="col-md-8">
                            <div class="form-group">
                                <label for="description">Keterangan (Opsional)</label>
                                <textarea class="form-control" id="description" name="description" rows="1" placeholder="Contoh: Digunakan untuk perbaikan Aset X"><?= old('description') ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Transaksi</button>
                    <a href="<?= site_url('outgoing') ?>" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
                </div>
            </form>
        </div>
        </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    // Inisialisasi Select2 untuk dropdown produk
    $('#product_id').select2({
        theme: 'bootstrap4'
    });
});
</script>
<?= $this->endSection() ?>