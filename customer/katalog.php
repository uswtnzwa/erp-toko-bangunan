<?php

require_once "../config/koneksi.php";

$where = "WHERE p.status='Aktif'";

if (
    isset($_GET['kategori']) &&
    is_numeric($_GET['kategori'])
) {

    $kategori = intval($_GET['kategori']);

    $where .= " AND p.id_kategori = $kategori";
}

if (
    isset($_GET['q']) &&
    $_GET['q'] !== ''
) {

    $q = mysqli_real_escape_string(
        $koneksi,
        $_GET['q']
    );

    $where .= " AND p.nama_produk LIKE '%$q%'";
}

$query = mysqli_query(
    $koneksi,
    "SELECT
        p.*,
        k.nama_kategori
     FROM produk p
     LEFT JOIN kategori k
     ON p.id_kategori = k.id_kategori
     $where
     ORDER BY p.id_produk DESC"
);

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Katalog Produk - BuildStore</title>

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


<main class="customer-container">

    <section class="section">

        <div class="section-title">

            <div>

                <h2>
                    Katalog Produk
                </h2>

                <p>
                    Temukan berbagai kebutuhan bangunan
                    untuk proyek Anda.
                </p>

            </div>

        </div>


        <form
            method="GET"
            style="margin-bottom:25px;">

            <input
                type="text"
                name="q"
                value="<?= htmlspecialchars($_GET['q'] ?? ''); ?>"
                placeholder="Cari nama produk..."
                style="
                    width:100%;
                    padding:13px;
                    border:1px solid #ddd;
                    border-radius:8px;
                ">

        </form>


        <div class="product-grid">

            <?php if (mysqli_num_rows($query) > 0): ?>

                <?php while ($p = mysqli_fetch_assoc($query)): ?>

                    <?php

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

                                <?php if ($p['stok'] > 0): ?>

                                    Stok tersedia

                                <?php else: ?>

                                    Stok habis

                                <?php endif; ?>

                            </div>

                            <a
                                href="detail_produk.php?id=<?= $p['id_produk']; ?>"
                                class="btn-product">

                                Lihat Detail

                            </a>

                        </div>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div
                    style="
                        grid-column:1/-1;
                        text-align:center;
                        padding:50px;
                    ">

                    <h3>
                        Produk tidak ditemukan
                    </h3>

                    <p>
                        Coba gunakan kata pencarian lain.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </section>

</main>

</body>

</html>