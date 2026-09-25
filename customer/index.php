<?php

require_once "../config/koneksi.php";

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>BuildStore - Toko Bangunan</title>

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

                <a href="index.php">Home</a>

                <a href="katalog.php">Produk</a>

                <a href="katalog.php">Katalog</a>

                <a href="#">Blog</a>

                <a href="#">Tentang Kami</a>

                <a href="#">Kontak</a>

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


<main class="customer-container">

    <section class="hero">

        <div class="hero-content">

            <h1>
                Bangun Masa Depan
                Lebih Kuat
            </h1>

            <p>
                Material bangunan lengkap dengan
                harga terbaik untuk kebutuhan
                rumah dan proyek Anda.
            </p>

            <a
                href="katalog.php"
                class="btn-shop">

                Belanja Sekarang →

            </a>

        </div>

    </section>


    <!-- KATEGORI -->

    <section class="section">

        <div class="section-title">

            <h2>
                Kategori Produk
            </h2>

            <a href="katalog.php">
                Lihat Semua
            </a>

        </div>

        <div class="category-grid">

            <?php

            $kategori = mysqli_query(
                $koneksi,
                "SELECT *
                 FROM kategori
                 WHERE status='Aktif'
                 ORDER BY nama_kategori"
            );

            while ($k = mysqli_fetch_assoc($kategori)):

            ?>

                <a
                    href="katalog.php?kategori=<?= $k['id_kategori']; ?>"
                    class="category-card">

                    <div class="category-icon">
                        🧱
                    </div>

                    <h4>
                        <?= htmlspecialchars(
                            $k['nama_kategori']
                        ); ?>
                    </h4>

                </a>

            <?php endwhile; ?>

        </div>

    </section>


    <!-- PRODUK -->

    <section class="section">

        <div class="section-title">

            <h2>
                Produk Terbaru
            </h2>

            <a href="katalog.php">
                Lihat Semua
            </a>

        </div>

        <div class="product-grid">

            <?php

            $produk = mysqli_query(
                $koneksi,
                "SELECT
                    p.*,
                    k.nama_kategori
                 FROM produk p
                 LEFT JOIN kategori k
                 ON p.id_kategori = k.id_kategori
                 WHERE p.status='Aktif'
                 ORDER BY p.id_produk DESC
                 LIMIT 8"
            );

            while ($p = mysqli_fetch_assoc($produk)):

                $harga = $p['harga_diskon'] > 0
                    ? $p['harga_diskon']
                    : $p['harga'];

            ?>

                <div class="product-card">

                    <div class="product-image">

                        <?php if ($p['gambar']): ?>

                            <img
                                src="../assets/img/<?= htmlspecialchars($p['gambar']); ?>"
                                alt="<?= htmlspecialchars($p['nama_produk']); ?>">

                        <?php else: ?>

                            <span style="font-size:60px;">
                                🧱
                            </span>

                        <?php endif; ?>

                    </div>

                    <div class="product-info">

                        <div class="product-category">

                            <?= htmlspecialchars(
                                $p['nama_kategori']
                            ); ?>

                        </div>

                        <div class="product-name">

                            <?= htmlspecialchars(
                                $p['nama_produk']
                            ); ?>

                        </div>

                        <div class="product-price">

                            Rp <?= number_format(
                                $harga,
                                0,
                                ',',
                                '.'
                            ); ?>

                        </div>

                        <div class="product-stock">

                            Stok tersedia:
                            <?= $p['stok']; ?>
                            <?= htmlspecialchars($p['satuan']); ?>

                        </div>

                        <a
                            href="detail_produk.php?id=<?= $p['id_produk']; ?>"
                            class="btn-product">

                            Lihat Detail

                        </a>

                    </div>

                </div>

            <?php endwhile; ?>

        </div>

    </section>

</main>


<footer class="customer-footer">

    <div class="customer-container">

        <div class="footer-grid">

            <div>

                <h3>
                    BuildStore
                </h3>

                <p>
                    Toko bangunan online dengan
                    produk lengkap dan berkualitas.
                </p>

            </div>

            <div>

                <h4>
                    Menu
                </h4>

                <a href="index.php">
                    Home
                </a>

                <a href="katalog.php">
                    Katalog
                </a>

                <a href="#">
                    Tentang Kami
                </a>

            </div>

            <div>

                <h4>
                    Bantuan
                </h4>

                <a href="#">
                    FAQ
                </a>

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