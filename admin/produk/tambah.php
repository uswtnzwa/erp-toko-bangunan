<?php

require_once "../../config/koneksi.php";

$page_title = "Tambah Produk";

$pesan = "";


/* =========================
   PROSES TAMBAH PRODUK
========================= */

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id_kategori = intval($_POST['id_kategori'] ?? 0);
    $kode_produk = trim($_POST['kode_produk'] ?? '');
    $nama_produk = trim($_POST['nama_produk'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $spesifikasi = trim($_POST['spesifikasi'] ?? '');

    $harga = floatval($_POST['harga'] ?? 0);
    $harga_diskon = floatval($_POST['harga_diskon'] ?? 0);

    $stok = intval($_POST['stok'] ?? 0);
    $stok_minimum = intval($_POST['stok_minimum'] ?? 0);

    $satuan = trim($_POST['satuan'] ?? '');

    $gambar = "";


    /* =========================
       VALIDASI
    ========================= */

    if ($id_kategori <= 0) {

        $pesan = "Kategori produk wajib dipilih.";

    } elseif ($kode_produk === '') {

        $pesan = "Kode produk wajib diisi.";

    } elseif ($nama_produk === '') {

        $pesan = "Nama produk wajib diisi.";

    } elseif ($harga <= 0) {

        $pesan = "Harga produk harus lebih dari 0.";

    } elseif ($satuan === '') {

        $pesan = "Satuan produk wajib diisi.";

    }


    /* =========================
       UPLOAD GAMBAR
    ========================= */

    if ($pesan === "" && isset($_FILES['gambar'])) {

        if ($_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {

            if ($_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {

                $pesan = "Gambar gagal diupload.";

            } else {

                $folder = "../../assets/img/produk/";

                if (!is_dir($folder)) {

                    mkdir(
                        $folder,
                        0777,
                        true
                    );
                }


                $tmp_file =
                    $_FILES['gambar']['tmp_name'];

                $nama_asli =
                    basename($_FILES['gambar']['name']);


                $tipe =
                    mime_content_type($tmp_file);


                $tipe_diizinkan = [
                    "image/jpeg",
                    "image/png",
                    "image/webp"
                ];


                if (!in_array(
                    $tipe,
                    $tipe_diizinkan
                )) {

                    $pesan =
                        "Format gambar harus JPG, PNG, atau WEBP.";

                } else {

                    $extension =
                        pathinfo(
                            $nama_asli,
                            PATHINFO_EXTENSION
                        );


                    $nama_file =
                        time() . "_" .
                        uniqid() . "." .
                        strtolower($extension);


                    $target =
                        $folder . $nama_file;


                    if (
                        move_uploaded_file(
                            $tmp_file,
                            $target
                        )
                    ) {

                        $gambar =
                            "produk/" . $nama_file;

                    } else {

                        $pesan =
                            "Gambar gagal disimpan.";

                    }
                }
            }
        }
    }


    /* =========================
       SIMPAN DATABASE
    ========================= */

    if ($pesan === "") {

        $stmt = mysqli_prepare(
            $koneksi,
            "INSERT INTO produk
            (
                id_kategori,
                kode_produk,
                nama_produk,
                deskripsi,
                spesifikasi,
                harga,
                harga_diskon,
                stok,
                stok_minimum,
                satuan,
                gambar
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );


        if (!$stmt) {

            $pesan =
                "Query produk gagal dibuat: " .
                mysqli_error($koneksi);

        } else {

            mysqli_stmt_bind_param(
                $stmt,
                "issssddiiss",
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
                $gambar
            );


            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_close($stmt);

                /*
                 * REDIRECT DILAKUKAN
                 * SEBELUM HTML HEADER
                 */

                header(
                    "Location: index.php"
                );

                exit;

            } else {

                $pesan =
                    "Produk gagal ditambahkan: " .
                    mysqli_stmt_error($stmt);

                mysqli_stmt_close($stmt);
            }
        }
    }
}


/*
 * HEADER BARU DIPANGGIL
 * SETELAH PROSES POST SELESAI
 */

require_once "../../includes/admin_header.php";

?>


<div class="content">

    <div class="page-title">

        <h1>
            Tambah Produk
        </h1>

        <p>
            Tambahkan produk baru ke katalog toko.
        </p>

    </div>


    <?php if ($pesan !== ""): ?>

        <div class="alert alert-danger">

            <?= htmlspecialchars($pesan); ?>

        </div>

    <?php endif; ?>


    <div class="panel">

        <form
            method="POST"
            enctype="multipart/form-data">


            <div class="row g-3">


                <!-- KATEGORI -->

                <div class="col-md-6">

                    <label class="form-label">
                        Kategori
                    </label>

                    <select
                        name="id_kategori"
                        class="form-select"
                        required>

                        <option value="">
                            Pilih kategori
                        </option>


                        <?php

                        $kategori = mysqli_query(
                            $koneksi,
                            "SELECT *
                             FROM kategori
                             WHERE status='Aktif'
                             ORDER BY nama_kategori"
                        );

                        if ($kategori):

                            while (
                                $k =
                                mysqli_fetch_assoc(
                                    $kategori
                                )
                            ):

                        ?>

                            <option
                                value="<?= $k['id_kategori']; ?>"
                                <?= (
                                    ($_POST['id_kategori'] ?? '')
                                    == $k['id_kategori']
                                )
                                    ? 'selected'
                                    : ''
                                ?>>

                                <?= htmlspecialchars(
                                    $k['nama_kategori']
                                ); ?>

                            </option>


                        <?php

                            endwhile;

                        endif;

                        ?>

                    </select>

                </div>


                <!-- KODE PRODUK -->

                <div class="col-md-6">

                    <label class="form-label">
                        Kode Produk
                    </label>

                    <input
                        type="text"
                        name="kode_produk"
                        class="form-control"
                        placeholder="Contoh: SMN002"
                        value="<?= htmlspecialchars(
                            $_POST['kode_produk'] ?? ''
                        ); ?>"
                        required>

                </div>


                <!-- NAMA PRODUK -->

                <div class="col-md-12">

                    <label class="form-label">
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        name="nama_produk"
                        class="form-control"
                        placeholder="Contoh: Semen Gresik 50 Kg"
                        value="<?= htmlspecialchars(
                            $_POST['nama_produk'] ?? ''
                        ); ?>"
                        required>

                </div>


                <!-- HARGA -->

                <div class="col-md-6">

                    <label class="form-label">
                        Harga
                    </label>

                    <input
                        type="number"
                        name="harga"
                        class="form-control"
                        min="0"
                        value="<?= htmlspecialchars(
                            $_POST['harga'] ?? ''
                        ); ?>"
                        required>

                </div>


                <!-- HARGA DISKON -->

                <div class="col-md-6">

                    <label class="form-label">
                        Harga Diskon
                    </label>

                    <input
                        type="number"
                        name="harga_diskon"
                        class="form-control"
                        min="0"
                        value="<?= htmlspecialchars(
                            $_POST['harga_diskon'] ?? '0'
                        ); ?>">

                </div>


                <!-- STOK -->

                <div class="col-md-4">

                    <label class="form-label">
                        Stok
                    </label>

                    <input
                        type="number"
                        name="stok"
                        class="form-control"
                        min="0"
                        value="<?= htmlspecialchars(
                            $_POST['stok'] ?? '0'
                        ); ?>"
                        required>

                </div>


                <!-- STOK MINIMUM -->

                <div class="col-md-4">

                    <label class="form-label">
                        Stok Minimum
                    </label>

                    <input
                        type="number"
                        name="stok_minimum"
                        class="form-control"
                        min="0"
                        value="<?= htmlspecialchars(
                            $_POST['stok_minimum'] ?? '5'
                        ); ?>">

                </div>


                <!-- SATUAN -->

                <div class="col-md-4">

                    <label class="form-label">
                        Satuan
                    </label>

                    <input
                        type="text"
                        name="satuan"
                        class="form-control"
                        placeholder="Sak / Pcs / Kg"
                        value="<?= htmlspecialchars(
                            $_POST['satuan'] ?? ''
                        ); ?>"
                        required>

                </div>


                <!-- GAMBAR -->

                <div class="col-md-12">

                    <label class="form-label">
                        Gambar Produk
                    </label>

                    <input
                        type="file"
                        name="gambar"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp">

                    <small class="text-muted">
                        Format JPG, PNG, WEBP.
                    </small>

                </div>


                <!-- DESKRIPSI -->

                <div class="col-md-12">

                    <label class="form-label">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="5"
                        placeholder="Masukkan deskripsi produk..."><?= htmlspecialchars(
                            $_POST['deskripsi'] ?? ''
                        ); ?></textarea>

                </div>


                <!-- SPESIFIKASI -->

                <div class="col-md-12">

                    <label class="form-label">
                        Spesifikasi
                    </label>

                    <textarea
                        name="spesifikasi"
                        class="form-control"
                        rows="5"
                        placeholder="Contoh:
Berat: 50 Kg
Ukuran: 40 x 60 cm
Material: Portland Cement"><?= htmlspecialchars(
                            $_POST['spesifikasi'] ?? ''
                        ); ?></textarea>

                </div>


                <!-- BUTTON -->

                <div class="col-12">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-save"></i>

                        Simpan Produk

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


<?php

require_once "../../includes/admin_footer.php";

?>