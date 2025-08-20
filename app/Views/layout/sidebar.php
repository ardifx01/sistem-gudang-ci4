<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= site_url('/'); ?>" class="brand-link">
        <img src="<?= base_url('adminlte/dist/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Inventori App</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('adminlte/dist/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin Gudang</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="<?= site_url('dashboard'); ?>" class="nav-link <?= (($menu ?? '') == 'dashboard') ? 'active' : ''; ?>" style="padding-top: 6px; padding-bottom: 6px;">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                
                <li class="nav-header" style="padding-top: 12px;">MASTER DATA</li>
                <li class="nav-item">
                    <a href="<?= site_url('products'); ?>" class="nav-link <?= (($menu ?? '') == 'products') ? 'active' : ''; ?>" style="padding-top: 6px; padding-bottom: 6px;">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Barang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('categories'); ?>" class="nav-link <?= (($menu ?? '') == 'categories') ? 'active' : ''; ?>" style="padding-top: 6px; padding-bottom: 6px;">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('vendors'); ?>" class="nav-link <?= (($menu ?? '') == 'vendors') ? 'active' : ''; ?>" style="padding-top: 6px; padding-bottom: 6px;">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>Vendor</p>
                    </a>
                </li>

                <li class="nav-header" style="padding-top: 12px;">MANAJEMEN STOK</li>
                <li class="nav-item">
                    <a href="<?= site_url('purchases'); ?>" class="nav-link <?= (($menu ?? '') == 'purchases') ? 'active' : ''; ?>" style="padding-top: 6px; padding-bottom: 6px;">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Pembelian</p>
                    </a>
                </li>
                <li class="nav-item has-treeview <?= (($menu ?? '') == 'transaksi') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?= (($menu ?? '') == 'transaksi') ? 'active' : ''; ?>" style="padding-top: 6px; padding-bottom: 6px;">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>
                            Transaksi Stok
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('incoming'); ?>" class="nav-link <?= (($submenu ?? '') == 'incoming') ? 'active' : ''; ?>" style="padding-top: 6px; padding-bottom: 6px;">
                                <i class="far fa-circle nav-icon text-success"></i>
                                <p>Barang Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('outgoing'); ?>" class="nav-link <?= (($submenu ?? '') == 'outgoing') ? 'active' : ''; ?>" style="padding-top: 6px; padding-bottom: 6px;">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>Barang Keluar</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header" style="padding-top: 12px;">LAPORAN</li>
                <li class="nav-item has-treeview <?= (($menu ?? '') == 'reports') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?= (($menu ?? '') == 'reports') ? 'active' : ''; ?>" style="padding-top: 6px; padding-bottom: 6px;">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('reports/incoming'); ?>" class="nav-link <?= (($submenu ?? '') == 'reports_incoming') ? 'active' : ''; ?>" style="padding-top: 6px; padding-bottom: 6px;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Barang Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('reports/outgoing'); ?>" class="nav-link <?= (($submenu ?? '') == 'reports_outgoing') ? 'active' : ''; ?>" style="padding-top: 6px; padding-bottom: 6px;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Barang Keluar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('reports/stock'); ?>" class="nav-link <?= (($submenu ?? '') == 'reports_stock') ? 'active' : ''; ?>" style="padding-top: 6px; padding-bottom: 6px;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Stok Barang</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>