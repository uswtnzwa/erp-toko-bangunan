<?php

$page_title = "Manajemen Produk";

require_once "../../config/koneksi.php";
require_once "../../includes/admin_header.php";

$query = mysqli_query(
    $koneksi,
    "SELECT 
        p.*,
        k.nama_kategori
     FROM produk p
     LEFT JOIN kategori k
     ON p.id_kategori = k.id_kategori
     ORDER BY p.id_produk DESC"
);

?>

<div class="content">

    <div class="page-title d-flex justify-content-between align-items-center">

        <div>
            <h1>Manajemen Produk</h1>
            <p>Kelola produk toko bangunan.</p>
        </div>

        <a href="tambah.php" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
            Tambah Produk
        </a>

    </div>

    <div class="panel">

        <div class="table-responsive">

            <table class="table">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                <?php

                $no = 1;

                while ($produk = mysqli_fetch_assoc($query)):

                ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td>

                            <strong>
                                <?= htmlspecialchars($produk['nama_produk']); ?>
                            </strong>

                            <small class="d-block text-muted">
                                <?= htmlspecialchars($produk['kode_produk']); ?>
                            </small>

                        </td>

                        <td>
                            <?= htmlspecialchars($produk['nama_kategori']); ?>
                        </td>

                        <td>
                            Rp <?= number_format(
                                $produk['harga'],
                                0,
                                ',',
                                '.'
                            ); ?>
                        </td>

                        <td>

                            <?= $produk['stok']; ?>
                            <?= htmlspecialchars($produk['satuan']); ?>

                        </td>

                        <td>

                            <?php if ($produk['status'] === 'Aktif'): ?>

                                <span class="badge bg-success">
                                    Aktif
                                </span>

                            <?php else: ?>

                                <span class="badge bg-secondary">
                                    Nonaktif
                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <a
                                href="edit.php?id=<?= $produk['id_produk']; ?>"
                                class="btn btn-sm btn-warning">

                                <i class="bi bi-pencil"></i>

                            </a>

                            <a
                                href="hapus.php?id=<?= $produk['id_produk']; ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus produk ini?')">

                                <i class="bi bi-trash"></i>

                            </a>

                        </td>

                    </tr>

                <?php endwhile; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php require_once "../../includes/admin_footer.php"; ?>