<?php
// 1. Mulai atau lanjutkan sesi yang ada
session_start();

// 2. Hapus semua variabel session
$_SESSION = array();

// 3. Hapus cookie session jika menggunakan cookie-based sessions
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. Hancurkan sesi sepenuhnya di server
session_destroy();

// 5. Redirect pengguna ke halaman login
header("Location: login.php");
exit();
?>   