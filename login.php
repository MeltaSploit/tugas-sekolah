<?php
session_start();
// Kalau sudah login, langsung lempar ke dashboard
if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sistem Pendaftaran Siswa</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body {
            background: #0f172a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background: #ffffff;
            width: 100%;
            max-width: 360px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
        }
        .login-box h1 {
            font-size: 20px;
            color: #0f172a;
            margin-bottom: 4px;
        }
        .login-box p.subtitle {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 20px;
        }
        .form-group { margin-bottom: 14px; }
        label { display: block; font-size: 13px; font-weight: bold; margin-bottom: 5px; color: #334155; }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 14px;
        }
        .btn-login {
            width: 100%;
            padding: 10px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 6px;
        }
        .btn-login:hover { background: #1d4ed8; }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px 12px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>Login Admin</h1>
        <p class="subtitle">Sistem Pendaftaran Siswa Baru</p>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert-error">Username atau password salah!</div>
        <?php endif; ?>

        <form action="proses_login.php" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-login">Masuk</button>
        </form>
    </div>
</body>
</html>
