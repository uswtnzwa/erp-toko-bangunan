<?php

require_once "../../config/koneksi.php";

$id = isset($_GET['id'])
    ? intval($_GET['id'])
    : 0;

if ($id > 0) {

    mysqli_query(
        $koneksi,
        "DELETE FROM produk
         WHERE id_produk = $id"
    );
}

header("Location: index.php");

exit;