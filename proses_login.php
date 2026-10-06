<?php
session_start();
include 'koneksi.php';

// Pastikan tidak ada output (spasi/HTML) sebelum header

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // 1. Validasi form kosong
    if (empty($username) || empty($password)) {
        header("Location: login.php?error=empty");
        exit();
    }

    // 2. Gunakan PREPARED STATEMENT (Anti SQL Injection)
    $stmt = mysqli_prepare($koneksi, "SELECT id, username, password FROM tb_admin WHERE username = ?");
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $admin = mysqli_fetch_assoc($result);

        // 3. Verifikasi hash password
        if ($admin && password_verify($password, $admin['password'])) {
            
            // 4. Regenerasi Session ID (Mencegah Session Fixation Attack)
            session_regenerate_id(true);
            
            $_SESSION['admin_id']       = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['is_logged_in']   = true; // Tambahan untuk validasi di halaman lain
            
            header("Location: dashboard.php");
            exit();
        } else {
            // Username tidak ketemu atau password salah
            header("Location: login.php?error=invalid");
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        // Error database
        header("Location: login.php?error=db");
        exit();
    }
} else {
    // Jika file ini diakses langsung via browser (GET), tendang ke form login
    header("Location: login.php");
    exit();
}
?>