<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat Transaksi Pembelian Baru</h3>
            </div>
            <form action="<?= site_url('purchases') ?>" method="post">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="vendor_id">Vendor</label>
                                <select name="vendor_id" id="vendor_id" class="form-control <?= (validation_show_error('vendor_id')) ? 'is-invalid' : ''; ?>">
                                    <option value="">-- Pilih Vendor --</option>
                                    <?php foreach ($vendors as $vendor): ?>
                                    <option value="<?= $vendor['id'] ?>" <?= (old('vendor_id') == $vendor['id']) ? 'selected' : ''; ?>><?= esc($vendor['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback"><?= validation_show_error('vendor_id') ?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="purchase_date">Tanggal Pembelian</label>
                                <input type="date" name="purchase_date" id="purchase_date" class="form-control" value="<?= old('purchase_date', date('Y-m-d')) ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="buyer_name">Nama Pembeli</label>
                                <input type="text" name="buyer_name" id="buyer_name" class="form-control <?= (validation_show_error('buyer_name')) ? 'is-invalid' : ''; ?>" value="<?= old('buyer_name') ?>" placeholder="Masukkan nama pembeli">
                                <div class="invalid-feedback"><?= validation_show_error('buyer_name') ?></div>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h5>Detail Barang</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th style="width: 15%;">Jumlah</th>
                                <th style="width: 20%;">Harga Satuan</th>
                                <th style="width: 5%;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="product-rows">
                            </tbody>
                    </table>
                    <div class="d-block invalid-feedback mt-2">
                        <?= validation_show_error('products') ?>
                    </div>
                    <button type="button" id="add-product-row" class="btn btn-success btn-sm mt-2"><i class="fas fa-plus"></i> Tambah Barang</button>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Transaksi</button>
                    <a href="<?= site_url('purchases') ?>" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
                </div>
            </form>
        </div>
        </div>
</div>


<template id="product-options">
    <option value="">-- Pilih Barang --</option>
    <?php foreach ($products as $product): ?>
    <option value="<?= $product['id'] ?>"><?= esc($product['name'] . ' (Stok: ' . $product['stock'] . ')') ?></option>
    <?php endforeach; ?>
</template>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const addRowBtn = document.getElementById('add-product-row');
    const productRowsContainer = document.getElementById('product-rows');
    const productOptions = document.getElementById('product-options').innerHTML;
    let productIndex = 0;

    function addFirstRow() {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <select name="products[${productIndex}][product_id]" class="form-control" required>
                    ${productOptions}
                </select>
            </td>
            <td><input type="number" name="products[${productIndex}][quantity]" class="form-control" required min="1" placeholder="Jumlah"></td>
            <td><input type="number" name="products[${productIndex}][price]" class="form-control" required min="0" placeholder="Harga"></td>
            <td class="text-center"><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-trash"></i></button></td>
        `;
        productRowsContainer.appendChild(row);
        productIndex++;
    }

    addRowBtn.addEventListener('click', addFirstRow);

    productRowsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row') || e.target.parentElement.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });

    // Panggil fungsi untuk menambahkan baris pertama saat halaman dimuat
    addFirstRow();
});
</script>
<?= $this->endSection() ?>