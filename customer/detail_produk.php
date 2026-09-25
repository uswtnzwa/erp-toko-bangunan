<?php

require_once "../config/koneksi.php";

$id = isset($_GET['id'])
    ? intval($_GET['id'])
    : 0;

$query = mysqli_query(
    $koneksi,
    "SELECT
        p.*,
        k.nama_kategori
     FROM produk p
     LEFT JOIN kategori k
     ON p.id_kategori = k.id_kategori
     WHERE p.id_produk = $id
     AND p.status = 'Aktif'
     LIMIT 1"
);

$produk = mysqli_fetch_assoc($query);

if (!$produk) {

    header("Location: katalog.php");

    exit;
}

$harga = $produk['harga_diskon'] > 0
    ? $produk['harga_diskon']
    : $produk['harga'];

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars($produk['nama_produk']); ?>
        - BuildStore
    </title>

    <link
        rel="stylesheet"
        href="../assets/css/customer.css">

</head>

<body>

<header class="customer-navbar">

    <div class="customer-container">

        <div class="navbar-content">

            <a href="index.php" class="brand">
                Build<span>Store</span>
            </a>

            <nav class="nav-menu">

                <a href="index.php">
                    Home
                </a>

                <a href="katalog.php">
                    Produk
                </a>

                <a href="katalog.php">
                    Katalog
                </a>

                <a href="#">
                    Blog
                </a>

                <a href="#">
                    Tentang Kami
                </a>

                <a href="#">
                    Kontak
                </a>

            </nav>

            <div class="nav-actions">

                <a href="#">
                    ♡
                </a>

                <a href="#">
                    🛒
                </a>

                <a href="#">
                    👤
                </a>

            </div>

        </div>

    </div>

</header>


<main class="customer-container detail-wrapper">

    <div class="detail-box">

        <div class="detail-grid">

            <!-- GAMBAR -->

            <div>

                <div class="detail-image">

                    <?php if ($produk['gambar']): ?>

                        <img
                            src="../assets/img/<?= htmlspecialchars($produk['gambar']); ?>"
                            alt="<?= htmlspecialchars($produk['nama_produk']); ?>">

                    <?php else: ?>

                        <span style="font-size:100px;">
                            🧱
                        </span>

                    <?php endif; ?>

                </div>

            </div>


            <!-- INFORMASI -->

            <div>

                <div class="detail-category">

                    <?= htmlspecialchars(
                        $produk['nama_kategori']
                    ); ?>

                </div>

                <h1 class="detail-title">

                    <?= htmlspecialchars(
                        $produk['nama_produk']
                    ); ?>

                </h1>

                <div style="color:#f3a600;">

                    ★★★★★

                    <span style="color:#777;">
                        (0 ulasan)
                    </span>

                </div>

                <div class="detail-price">

                    Rp <?= number_format(
                        $harga,
                        0,
                        ',',
                        '.'
                    ); ?>

                </div>

                <?php if ($produk['harga_diskon'] > 0): ?>

                    <div style="
                        color:#999;
                        text-decoration:line-through;
                        margin-top:-15px;
                        margin-bottom:15px;
                    ">

                        Rp <?= number_format(
                            $produk['harga'],
                            0,
                            ',',
                            '.'
                        ); ?>

                    </div>

                <?php endif; ?>


                <div class="detail-description">

                    <?= nl2br(
                        htmlspecialchars(
                            $produk['deskripsi']
                        )
                    ); ?>

                </div>


                <div style="
                    margin-top:20px;
                    color:#159b65;
                    font-weight:600;
                ">

                    ✓ Stok tersedia:
                    <?= $produk['stok']; ?>
                    <?= htmlspecialchars(
                        $produk['satuan']
                    ); ?>

                </div>


                <div class="quantity">

                    <label>
                        Jumlah
                    </label>

                    <input
                        type="number"
                        min="1"
                        max="<?= $produk['stok']; ?>"
                        value="1">

                </div>


                <div style="
                    display:flex;
                    gap:10px;
                    flex-wrap:wrap;
                ">

                    <button
                        class="btn-shop"
                        style="border:0;cursor:pointer;">

                        🛒 Tambah ke Keranjang

                    </button>

                    <button
                        class="btn-shop"
                        style="
                            background:white;
                            color:#1473e6;
                            border:1px solid #1473e6;
                        ">

                        ♡ Wishlist

                    </button>

                </div>

            </div>

        </div>


        <!-- DETAIL TAMBAHAN -->

        <div class="detail-spec">

            <h4>
                Deskripsi Produk
            </h4>

            <div class="spec-box">

                <?= nl2br(
                    htmlspecialchars(
                        $produk['deskripsi']
                    )
                ); ?>

            </div>

        </div>


        <div class="detail-spec">

            <h4>
                Spesifikasi
            </h4>

            <div class="spec-box">

                <?php if ($produk['spesifikasi']): ?>

                    <?= nl2br(
                        htmlspecialchars(
                            $produk['spesifikasi']
                        )
                    ); ?>

                <?php else: ?>

                    Spesifikasi produk belum tersedia.

                <?php endif; ?>

            </div>

        </div>


        <div class="detail-spec">

            <h4>
                Informasi Produk
            </h4>

            <div class="spec-box">

                Kode Produk:
                <?= htmlspecialchars(
                    $produk['kode_produk']
                ); ?>


                Kategori:
                <?= htmlspecialchars(
                    $produk['nama_kategori']
                ); ?>


                Satuan:
                <?= htmlspecialchars(
                    $produk['satuan']
                ); ?>


                Stok:
                <?= $produk['stok']; ?>

            </div>

        </div>

    </div>

</main>


<footer class="customer-footer">

    <div class="customer-container">

        <div class="footer-grid">

            <div>

                <h3>
                    BuildStore
                </h3>

                <p>
                    Toko bangunan online terpercaya
                    untuk kebutuhan rumah dan proyek.
                </p>

            </div>

            <div>

                <h4>
                    Informasi
                </h4>

                <a href="#">
                    Tentang Kami
                </a>

                <a href="#">
                    Kontak Kami
                </a>

                <a href="#">
                    FAQ
                </a>

            </div>

            <div>

                <h4>
                    Bantuan
                </h4>

                <a href="#">
                    Syarat & Ketentuan
                </a>

                <a href="#">
                    Kebijakan Privasi
                </a>

            </div>

        </div>

    </div>

</footer>

</body>

</html>