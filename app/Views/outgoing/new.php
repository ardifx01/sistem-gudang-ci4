<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Catat Transaksi Barang Keluar</h2>
    <hr>

    <?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="/outgoing" method="post">
        <?= csrf_field() ?>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="product_id" class="form-label">Pilih Barang</label>
                <select class="form-select <?= ($validation->hasError('product_id')) ? 'is-invalid' : ''; ?>" name="product_id" id="product_id">
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach($products as $product): ?>
                        <option value="<?= $product['id'] ?>" <?= (old('product_id') == $product['id']) ? 'selected' : ''; ?>>
                            <?= esc($product['code'] . ' - ' . $product['name'] . ' (Stok: ' . $product['stock'] . ')') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('product_id') ?></div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="quantity" class="form-label">Jumlah Keluar</label>
                <input type="number" class="form-control <?= ($validation->hasError('quantity')) ? 'is-invalid' : ''; ?>" id="quantity" name="quantity" value="<?= old('quantity') ?>">
                <div class="invalid-feedback"><?= $validation->getError('quantity') ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="outgoing_date" class="form-label">Tanggal Keluar</label>
                <input type="date" class="form-control <?= ($validation->hasError('outgoing_date')) ? 'is-invalid' : ''; ?>" id="outgoing_date" name="outgoing_date" value="<?= old('outgoing_date') ?: date('Y-m-d') ?>">
                <div class="invalid-feedback"><?= $validation->getError('outgoing_date') ?></div>
            </div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Keterangan (Opsional)</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?= old('description') ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
        <a href="/outgoing" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?= $this->endSection() ?>