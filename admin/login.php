<?php

session_start();

require_once "../config/koneksi.php";

if (isset($_SESSION['admin_login'])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username === "" || $password === "") {

        $error = "Username dan password wajib diisi.";

    } else {

        $password_md5 = md5($password);

        $stmt = mysqli_prepare(
            $koneksi,
            "SELECT * FROM admin
             WHERE username = ?
             AND password = ?
             AND status = 'Aktif'
             LIMIT 1"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ss",
            $username,
            $password_md5
        );

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {

            $admin = mysqli_fetch_assoc($result);

            $_SESSION['admin_login'] = true;
            $_SESSION['admin_id'] = $admin['id_admin'];
            $_SESSION['admin_nama'] = $admin['nama_lengkap'];
            $_SESSION['admin_role'] = $admin['role'];

            header("Location: dashboard.php");
            exit;

        } else {

            $error = "Username atau password salah.";

        }

        mysqli_stmt_close($stmt);
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login Admin - BuildStore</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="../assets/css/style.css">

</head>

<body>

<div class="login-page">

    <div class="login-card">

        <div class="login-logo">

            <div class="logo">
                TB
            </div>

            <h2>BuildStore</h2>

            <p>
                ERP Toko Bangunan
            </p>

        </div>

        <?php if ($error): ?>

            <div class="alert alert-danger">
                <?= htmlspecialchars($error); ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">

                <label class="form-label">
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    class="form-control"
                    placeholder="Masukkan username"
                    required>

            </div>

            <div class="mb-4">

                <label class="form-label">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    required>

            </div>

            <button
                type="submit"
                class="btn btn-primary w-100">

                <i class="bi bi-box-arrow-in-right"></i>

                Login Admin

            </button>

        </form>

        <div class="text-center mt-4">

            <small class="text-muted">
                BuildStore ERP © <?= date('Y'); ?>
            </small>

        </div>

    </div>

</div>

</body>

</html>