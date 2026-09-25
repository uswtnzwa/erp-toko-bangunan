<?php

if (!isset($page_title)) {
    $page_title = "Dashboard";
}

$base_url = "/erp-toko-bangunan";

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars($page_title); ?> - BuildStore ERP
    </title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">

    <!-- Admin CSS -->
    <link
        rel="stylesheet"
        href="<?= $base_url; ?>/assets/css/admin.css">

</head>

<body>

<div class="admin-wrapper">

    <!-- SIDEBAR -->

    <?php require __DIR__ . "/admin_sidebar.php"; ?>


    <!-- MAIN -->

    <div class="admin-main">

        <!-- TOPBAR -->

        <header class="admin-topbar">

            <div class="topbar-left">

                <button
                    type="button"
                    class="sidebar-toggle"
                    id="sidebarToggle">

                    <i class="bi bi-list"></i>

                </button>

                <div class="search-box">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        placeholder="Cari menu, produk, pesanan...">

                </div>

            </div>


            <div class="topbar-right">

                <button class="topbar-icon">

                    <i class="bi bi-bell"></i>

                    <span class="notification-dot"></span>

                </button>


                <div class="admin-profile">

                    <div class="admin-avatar">
                        A
                    </div>

                    <div class="admin-profile-info">

                        <strong>
                            Administrator
                        </strong>

                        <small>
                            Super Admin
                        </small>

                    </div>

                    <i class="bi bi-chevron-down"></i>

                </div>

            </div>

        </header>


        <!-- PAGE CONTENT -->

        <main class="admin-content">