<?php

$page_title = "Dashboard Admin";

require_once "../config/koneksi.php";
require_once "../includes/admin_header.php";

$total_produk = 0;
$total_pelanggan = 0;
$total_pesanan = 0;
$total_pendapatan = 0;

$query = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM produk WHERE status = 'Aktif'"
);

if ($query) {
    $data = mysqli_fetch_assoc($query);
    $total_produk = $data['total'];
}

$query = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM pelanggan WHERE status = 'Aktif'"
);

if ($query) {
    $data = mysqli_fetch_assoc($query);
    $total_pelanggan = $data['total'];
}

$query = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM pesanan"
);

if ($query) {
    $data = mysqli_fetch_assoc($query);
    $total_pesanan = $data['total'];
}

$query = mysqli_query(
    $koneksi,
    "SELECT COALESCE(SUM(total),0) AS total
     FROM pesanan
     WHERE status_pesanan NOT IN ('Dibatalkan','Retur')"
);

if ($query) {
    $data = mysqli_fetch_assoc($query);
    $total_pendapatan = $data['total'];
}

?>

<div class="content">

    <div class="page-title">

        <h1>
            Selamat Datang, Admin!
        </h1>

        <p>
            Kelola toko bangunan Anda dengan lebih mudah dan efisien.
        </p>

    </div>

    <!-- STATISTIK -->

    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="icon">
                    <i class="bi bi-box"></i>
                </div>

                <h6>Total Produk</h6>

                <h3>
                    <?= number_format($total_produk); ?>
                </h3>

                <div class="growth">
                    Produk aktif
                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="icon">
                    <i class="bi bi-people"></i>
                </div>

                <h6>Total Pelanggan</h6>

                <h3>
                    <?= number_format($total_pelanggan); ?>
                </h3>

                <div class="growth">
                    Pelanggan aktif
                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="icon">
                    <i class="bi bi-cart"></i>
                </div>

                <h6>Total Pesanan</h6>

                <h3>
                    <?= number_format($total_pesanan); ?>
                </h3>

                <div class="growth">
                    Semua transaksi
                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="icon">
                    <i class="bi bi-cash-stack"></i>
                </div>

                <h6>Total Pendapatan</h6>

                <h3>
                    Rp <?= number_format($total_pendapatan, 0, ',', '.'); ?>
                </h3>

                <div class="growth">
                    Total transaksi
                </div>

            </div>

        </div>

    </div>

    <!-- PRODUK STOK MENIPIS -->

    <div class="row g-4">

        <div class="col-lg-7">

            <div class="panel">

                <div class="panel-header">

                    <h5>
                        Produk Stok Menipis
                    </h5>

                    <a href="#">
                        Lihat Semua
                    </a>

                </div>

                <div class="table-responsive">

                    <table class="table">

                        <thead>

                            <tr>

                                <th>No</th>
                                <th>Produk</th>
                                <th>Stok</th>
                                <th>Minimum</th>
                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                        <?php

                        $no = 1;

                        $query_stok = mysqli_query(
                            $koneksi,
                            "SELECT *
                             FROM produk
                             WHERE stok <= stok_minimum
                             AND status = 'Aktif'
                             ORDER BY stok ASC
                             LIMIT 5"
                        );

                        if (mysqli_num_rows($query_stok) > 0):

                            while ($produk = mysqli_fetch_assoc($query_stok)):

                        ?>

                            <tr>

                                <td>
                                    <?= $no++; ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($produk['nama_produk']); ?>
                                </td>

                                <td>
                                    <strong class="text-danger">
                                        <?= $produk['stok']; ?>
                                    </strong>
                                </td>

                                <td>
                                    <?= $produk['stok_minimum']; ?>
                                </td>

                                <td>

                                    <span class="badge bg-warning text-dark">
                                        Menipis
                                    </span>

                                </td>

                            </tr>

                        <?php

                            endwhile;

                        else:

                        ?>

                            <tr>

                                <td colspan="5"
                                    class="text-center py-4">

                                    Semua stok masih aman.

                                </td>

                            </tr>

                        <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- MENU CEPAT -->

        <div class="col-lg-5">

            <div class="panel">

                <div class="panel-header">

                    <h5>
                        Menu Cepat
                    </h5>

                </div>

                <div class="row g-3">

                    <div class="col-6">

                        <a href="#"
                           class="btn btn-primary w-100 py-3">

                            <i class="bi bi-plus-circle"></i>
                            <br>

                            Tambah Produk

                        </a>

                    </div>

                    <div class="col-6">

                        <a href="#"
                           class="btn btn-outline-primary w-100 py-3">

                            <i class="bi bi-cart"></i>
                            <br>

                            Pesanan

                        </a>

                    </div>

                    <div class="col-6">

                        <a href="#"
                           class="btn btn-outline-primary w-100 py-3">

                            <i class="bi bi-box-seam"></i>
                            <br>

                            Kelola Stok

                        </a>

                    </div>

                    <div class="col-6">

                        <a href="#"
                           class="btn btn-outline-primary w-100 py-3">

                            <i class="bi bi-people"></i>
                            <br>

                            Pelanggan

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- PESANAN TERBARU -->

    <div class="row g-4 mt-1">

        <div class="col-12">

            <div class="panel">

                <div class="panel-header">

                    <h5>
                        Pesanan Terbaru
                    </h5>

                    <a href="#">
                        Lihat Semua
                    </a>

                </div>

                <div class="table-responsive">

                    <table class="table">

                        <thead>

                            <tr>

                                <th>No</th>
                                <th>Kode Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                        <?php

                        $no = 1;

                        $query_pesanan = mysqli_query(
                            $koneksi,
                            "SELECT
                                p.*,
                                pl.nama_lengkap
                             FROM pesanan p
                             LEFT JOIN pelanggan pl
                             ON p.id_pelanggan = pl.id_pelanggan
                             ORDER BY p.tanggal_pesanan DESC
                             LIMIT 5"
                        );

                        if (mysqli_num_rows($query_pesanan) > 0):

                            while ($pesanan = mysqli_fetch_assoc($query_pesanan)):

                        ?>

                            <tr>

                                <td>
                                    <?= $no++; ?>
                                </td>

                                <td>
                                    <strong>
                                        <?= htmlspecialchars($pesanan['kode_pesanan']); ?>
                                    </strong>
                                </td>

                                <td>
                                    <?= htmlspecialchars($pesanan['nama_lengkap'] ?? '-'); ?>
                                </td>

                                <td>
                                    Rp <?= number_format(
                                        $pesanan['total'],
                                        0,
                                        ',',
                                        '.'
                                    ); ?>
                                </td>

                                <td>

                                    <span class="badge bg-primary">
                                        <?= htmlspecialchars($pesanan['status_pesanan']); ?>
                                    </span>

                                </td>

                            </tr>

                        <?php

                            endwhile;

                        else:

                        ?>

                            <tr>

                                <td
                                    colspan="5"
                                    class="text-center py-4">

                                    Belum ada pesanan.

                                </td>

                            </tr>

                        <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<?php require_once "../includes/admin_footer.php"; ?>