<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-check-circle"></i>
                    Konfirmasi Penerimaan Barang
                </h3>
            </div>
            <div class="card-body">
                <p>Anda akan memproses penerimaan barang dari pembelian berikut. Pastikan data sudah sesuai sebelum melakukan konfirmasi.</p>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Vendor:</strong> <?= esc($purchase['vendor_name']) ?></p>
                        <p class="mb-0"><strong>Tanggal Pembelian:</strong> <?= date('d F Y', strtotime($purchase['purchase_date'])) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Nama Pembeli:</strong> <?= esc($purchase['buyer_name']) ?></p>
                    </div>
                </div>
                
                <h5 class="mt-4">Barang yang Akan Diterima</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th >Jumlah Diterima</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($details as $detail): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= esc($detail['product_code']) ?></td>
                                <td><?= esc($detail['product_name']) ?></td>
                                <td ><?= esc($detail['quantity']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <form action="<?= site_url('incoming') ?>" method="post" class="d-inline">
                    <?= csrf_field() ?>
                    <input type="hidden" name="purchase_id" value="<?= $purchase['id'] ?>">
                    <p><em>Dengan menekan tombol konfirmasi, jumlah stok untuk barang-barang di atas akan bertambah dan status pembelian akan menjadi "Selesai".</em></p>
                    <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin memproses penerimaan barang ini?')">
                        <i class="fas fa-check"></i> Konfirmasi Penerimaan
                    </button>
                    <a href="<?= site_url('incoming') ?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </form>
            </div>
        </div>
        </div>
</div>

<?= $this->endSection() ?>