<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Buat Transaksi Pembelian Baru</h2>
    <hr>
    <?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="/purchases" method="post">
        <?= csrf_field() ?>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="vendor_id" class="form-label">Vendor</label>
                <select name="vendor_id" id="vendor_id" class="form-select <?= ($validation->hasError('vendor_id')) ? 'is-invalid' : ''; ?>">
                    <option value="">-- Pilih Vendor --</option>
                    <?php foreach ($vendors as $vendor): ?>
                    <option value="<?= $vendor['id'] ?>" <?= (old('vendor_id') == $vendor['id']) ? 'selected' : ''; ?>><?= esc($vendor['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('vendor_id') ?></div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="purchase_date" class="form-label">Tanggal Pembelian</label>
                <input type="date" name="purchase_date" id="purchase_date" class="form-control" value="<?= old('purchase_date', date('Y-m-d')) ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label for="buyer_name" class="form-label">Nama Pembeli</label>
                <input type="text" name="buyer_name" id="buyer_name" class="form-control <?= ($validation->hasError('buyer_name')) ? 'is-invalid' : ''; ?>" value="<?= old('buyer_name') ?>">
                <div class="invalid-feedback"><?= $validation->getError('buyer_name') ?></div>
            </div>
        </div>
        
        <hr>
        <h4>Detail Barang</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th width="15%">Jumlah</th>
                    <th width="20%">Harga Satuan</th>
                    <th width="5%">Aksi</th>
                </tr>
            </thead>
            <tbody id="product-rows">
                </tbody>
        </table>
        <button type="button" id="add-product-row" class="btn btn-success btn-sm"><i class="bi bi-plus"></i> Tambah Barang</button>
        
        <hr>
        <button type="submit" class="btn btn-primary">Simpan Transaksi Pembelian</button>
        <a href="/purchases" class="btn btn-secondary">Batal</a>
    </form>
</div>

<template id="product-options">
    <option value="">-- Pilih Barang --</option>
    <?php foreach ($products as $product): ?>
    <option value="<?= $product['id'] ?>"><?= esc($product['name'] . ' (Stok: ' . $product['stock'] . ')') ?></option>
    <?php endforeach; ?>
</template>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addRowBtn = document.getElementById('add-product-row');
    const productRowsContainer = document.getElementById('product-rows');
    const productOptions = document.getElementById('product-options').innerHTML;
    let productIndex = 0;

    addRowBtn.addEventListener('click', function() {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <select name="products[${productIndex}][product_id]" class="form-select" required>
                    ${productOptions}
                </select>
            </td>
            <td><input type="number" name="products[${productIndex}][quantity]" class="form-control" required min="1" placeholder="Jumlah"></td>
            <td><input type="number" name="products[${productIndex}][price]" class="form-control" required min="0" placeholder="Harga"></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="bi bi-trash"></i></button></td>
        `;
        productRowsContainer.appendChild(row);
        productIndex++;
    });

    productRowsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row') || e.target.parentElement.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });
});
</script>
<?= $this->endSection() ?>