<?php

$base_url = "/erp-toko-bangunan";

$current_page = basename($_SERVER['PHP_SELF']);

?>

<aside class="admin-sidebar" id="adminSidebar">

    <!-- BRAND -->

    <div class="sidebar-brand">

        <div class="brand-logo">
            BTB
        </div>

        <div>

            <h2>
                BuildStore
            </h2>

            <span>
                Toko Bangunan ERP
            </span>

        </div>

    </div>


    <!-- MENU -->

    <div class="sidebar-menu">


        <!-- UTAMA -->

        <div class="menu-title">
            UTAMA
        </div>

        <a
            href="<?= $base_url; ?>/admin/dashboard.php"
            class="sidebar-link">

            <i class="bi bi-grid-1x2-fill"></i>

            <span>
                Dashboard
            </span>

        </a>


        <!-- PRODUK -->

        <div class="menu-title">
            PRODUK
        </div>

        <a
            href="<?= $base_url; ?>/admin/produk/index.php"
            class="sidebar-link">

            <i class="bi bi-box-seam"></i>

            <span>
                Produk
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/kategori/index.php"
            class="sidebar-link">

            <i class="bi bi-tags"></i>

            <span>
                Kategori
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/satuan/index.php"
            class="sidebar-link">

            <i class="bi bi-rulers"></i>

            <span>
                Satuan
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/supplier/index.php"
            class="sidebar-link">

            <i class="bi bi-truck"></i>

            <span>
                Supplier
            </span>

        </a>


        <!-- PESANAN -->

        <div class="menu-title">
            PESANAN
        </div>

        <a
            href="<?= $base_url; ?>/admin/pesanan/index.php"
            class="sidebar-link">

            <i class="bi bi-cart-check"></i>

            <span>
                Pesanan
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/pembayaran/index.php"
            class="sidebar-link">

            <i class="bi bi-credit-card"></i>

            <span>
                Pembayaran
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/pengiriman/index.php"
            class="sidebar-link">

            <i class="bi bi-truck"></i>

            <span>
                Pengiriman
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/retur/index.php"
            class="sidebar-link">

            <i class="bi bi-arrow-return-left"></i>

            <span>
                Retur
            </span>

        </a>


        <!-- WAREHOUSE -->

        <div class="menu-title">
            WAREHOUSE
        </div>

        <a
            href="<?= $base_url; ?>/admin/stok/index.php"
            class="sidebar-link">

            <i class="bi bi-boxes"></i>

            <span>
                Stok Produk
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/stok-masuk/index.php"
            class="sidebar-link">

            <i class="bi bi-box-arrow-in-down"></i>

            <span>
                Stok Masuk
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/stok-keluar/index.php"
            class="sidebar-link">

            <i class="bi bi-box-arrow-up"></i>

            <span>
                Stok Keluar
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/warehouse/index.php"
            class="sidebar-link">

            <i class="bi bi-building"></i>

            <span>
                Warehouse
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/packing/index.php"
            class="sidebar-link">

            <i class="bi bi-box2"></i>

            <span>
                Packing
            </span>

        </a>


        <!-- CRM -->

        <div class="menu-title">
            CRM
        </div>

        <a
            href="<?= $base_url; ?>/admin/pelanggan/index.php"
            class="sidebar-link">

            <i class="bi bi-people"></i>

            <span>
                Pelanggan
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/testimoni/index.php"
            class="sidebar-link">

            <i class="bi bi-chat-square-text"></i>

            <span>
                Testimoni
            </span>

        </a>


        <!-- LAPORAN -->

        <div class="menu-title">
            LAPORAN
        </div>

        <a
            href="<?= $base_url; ?>/admin/laporan/penjualan.php"
            class="sidebar-link">

            <i class="bi bi-bar-chart"></i>

            <span>
                Penjualan
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/laporan/pembelian.php"
            class="sidebar-link">

            <i class="bi bi-bag"></i>

            <span>
                Pembelian
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/laporan/stok.php"
            class="sidebar-link">

            <i class="bi bi-box"></i>

            <span>
                Stok
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/laporan/keuangan.php"
            class="sidebar-link">

            <i class="bi bi-wallet2"></i>

            <span>
                Keuangan
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/statistik.php"
            class="sidebar-link">

            <i class="bi bi-graph-up"></i>

            <span>
                Statistik
            </span>

        </a>


        <!-- PENGATURAN -->

        <div class="menu-title">
            PENGATURAN ADMIN
        </div>

        <a
            href="<?= $base_url; ?>/admin/pengaturan/profil.php"
            class="sidebar-link">

            <i class="bi bi-person"></i>

            <span>
                Profil Admin
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/pengaturan/admin.php"
            class="sidebar-link">

            <i class="bi bi-person-gear"></i>

            <span>
                Manajemen Admin
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/pengaturan/role.php"
            class="sidebar-link">

            <i class="bi bi-shield-lock"></i>

            <span>
                Role & Hak Akses
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/pengaturan/toko.php"
            class="sidebar-link">

            <i class="bi bi-shop"></i>

            <span>
                Pengaturan Toko
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/pengaturan/website.php"
            class="sidebar-link">

            <i class="bi bi-globe"></i>

            <span>
                Pengaturan Website
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/pengaturan/pembayaran.php"
            class="sidebar-link">

            <i class="bi bi-credit-card-2-front"></i>

            <span>
                Pengaturan Pembayaran
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/pengaturan/pengiriman.php"
            class="sidebar-link">

            <i class="bi bi-truck"></i>

            <span>
                Pengaturan Pengiriman
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/pengaturan/notifikasi.php"
            class="sidebar-link">

            <i class="bi bi-bell"></i>

            <span>
                Notifikasi
            </span>

        </a>


        <a
            href="<?= $base_url; ?>/admin/pengaturan/backup.php"
            class="sidebar-link">

            <i class="bi bi-database"></i>

            <span>
                Backup Database
            </span>

        </a>


        <!-- LOGOUT -->

        <a
            href="<?= $base_url; ?>/admin/logout.php"
            class="sidebar-link logout-link">

            <i class="bi bi-box-arrow-right"></i>

            <span>
                Logout
            </span>

        </a>

    </div>

</aside>