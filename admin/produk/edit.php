<?php

$page_title = "Edit Produk";

require_once "../../config/koneksi.php";

$id = isset($_GET['id'])
    ? intval($_GET['id'])
    : 0;

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM produk
     WHERE id_produk = $id
     LIMIT 1"
);

$produk = mysqli_fetch_assoc($query);

if (!$produk) {
    die("Produk tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id_kategori = $_POST['id_kategori'];
    $kode_produk = trim($_POST['kode_produk']);
    $nama_produk = trim($_POST['nama_produk']);
    $deskripsi = trim($_POST['deskripsi']);
    $spesifikasi = trim($_POST['spesifikasi']);
    $harga = $_POST['harga'];
    $harga_diskon = $_POST['harga_diskon'];
    $stok = $_POST['stok'];
    $stok_minimum = $_POST['stok_minimum'];
    $satuan = trim($_POST['satuan']);
    $status = $_POST['status'];

    $gambar = $produk['gambar'];

    if (
        isset($_FILES['gambar']) &&
        $_FILES['gambar']['error'] === 0
    ) {

        $folder = "../../assets/img/produk/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $nama_file = time() . "_" .
            basename($_FILES['gambar']['name']);

        $target = $folder . $nama_file;

        $tipe = mime_content_type(
            $_FILES['gambar']['tmp_name']
        );

        $tipe_diizinkan = [
            "image/jpeg",
            "image/png",
            "image/webp"
        ];

        if (in_array($tipe, $tipe_diizinkan)) {

            move_uploaded_file(
                $_FILES['gambar']['tmp_name'],
                $target
            );

            $gambar = "produk/" . $nama_file;
        }
    }

    $stmt = mysqli_prepare(
        $koneksi,
        "UPDATE produk SET
            id_kategori = ?,
            kode_produk = ?,
            nama_produk = ?,
            deskripsi = ?,
            spesifikasi = ?,
            harga = ?,
            harga_diskon = ?,
            stok = ?,
            stok_minimum = ?,
            satuan = ?,
            gambar = ?,
            status = ?
         WHERE id_produk = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "issssddiisssi",
        $id_kategori,
        $kode_produk,
        $nama_produk,
        $deskripsi,
        $spesifikasi,
        $harga,
        $harga_diskon,
        $stok,
        $stok_minimum,
        $satuan,
        $gambar,
        $status,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {

        header("Location: index.php");
        exit;
    }
}

require_once "../../includes/admin_header.php";

?>

<div class="content">

    <div class="page-title">

        <h1>Edit Produk</h1>

        <p>
            Ubah informasi produk.
        </p>

    </div>

    <div class="panel">

        <form method="POST" enctype="multipart/form-data">

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label">
                        Kategori
                    </label>

                    <select
                        name="id_kategori"
                        class="form-select"
                        required>

                        <?php

                        $kategori = mysqli_query(
                            $koneksi,
                            "SELECT * FROM kategori
                             WHERE status='Aktif'
                             ORDER BY nama_kategori"
                        );

                        while ($k = mysqli_fetch_assoc($kategori)):

                        ?>

                            <option
                                value="<?= $k['id_kategori']; ?>"
                                <?= $k['id_kategori'] == $produk['id_kategori']
                                    ? 'selected'
                                    : ''; ?>>

                                <?= htmlspecialchars(
                                    $k['nama_kategori']
                                ); ?>

                            </option>

                        <?php endwhile; ?>

                    </select>

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Kode Produk
                    </label>

                    <input
                        type="text"
                        name="kode_produk"
                        class="form-control"
                        value="<?= htmlspecialchars($produk['kode_produk']); ?>"
                        required>

                </div>

                <div class="col-md-12">

                    <label class="form-label">
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        name="nama_produk"
                        class="form-control"
                        value="<?= htmlspecialchars($produk['nama_produk']); ?>"
                        required>

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Harga
                    </label>

                    <input
                        type="number"
                        name="harga"
                        class="form-control"
                        value="<?= $produk['harga']; ?>"
                        required>

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Harga Diskon
                    </label>

                    <input
                        type="number"
                        name="harga_diskon"
                        class="form-control"
                        value="<?= $produk['harga_diskon']; ?>">

                </div>

                <div class="col-md-4">

                    <label class="form-label">
                        Stok
                    </label>

                    <input
                        type="number"
                        name="stok"
                        class="form-control"
                        value="<?= $produk['stok']; ?>"
                        required>

                </div>

                <div class="col-md-4">

                    <label class="form-label">
                        Stok Minimum
                    </label>

                    <input
                        type="number"
                        name="stok_minimum"
                        class="form-control"
                        value="<?= $produk['stok_minimum']; ?>">

                </div>

                <div class="col-md-4">

                    <label class="form-label">
                        Satuan
                    </label>

                    <input
                        type="text"
                        name="satuan"
                        class="form-control"
                        value="<?= htmlspecialchars($produk['satuan']); ?>">

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Status
                    </label>

                    <select name="status" class="form-select">

                        <option
                            value="Aktif"
                            <?= $produk['status'] === 'Aktif'
                                ? 'selected'
                                : ''; ?>>

                            Aktif

                        </option>

                        <option
                            value="Nonaktif"
                            <?= $produk['status'] === 'Nonaktif'
                                ? 'selected'
                                : ''; ?>>

                            Nonaktif

                        </option>

                    </select>

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Gambar Baru
                    </label>

                    <input
                        type="file"
                        name="gambar"
                        class="form-control"
                        accept="image/*">

                </div>

                <div class="col-12">

                    <?php if ($produk['gambar']): ?>

                        <img
                            src="../../assets/img/<?= htmlspecialchars($produk['gambar']); ?>"
                            style="width:180px;height:150px;object-fit:contain;background:#f5f5f5;border-radius:8px;">

                    <?php endif; ?>

                </div>

                <div class="col-md-12">

                    <label class="form-label">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="5"><?= htmlspecialchars($produk['deskripsi']); ?></textarea>

                </div>

                <div class="col-md-12">

                    <label class="form-label">
                        Spesifikasi
                    </label>

                    <textarea
                        name="spesifikasi"
                        class="form-control"
                        rows="5"><?= htmlspecialchars($produk['spesifikasi']); ?></textarea>

                </div>

                <div class="col-12">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-save"></i>
                        Simpan Perubahan

                    </button>

                    <a
                        href="index.php"
                        class="btn btn-secondary">

                        Kembali

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

<?php require_once "../../includes/admin_footer.php"; ?>