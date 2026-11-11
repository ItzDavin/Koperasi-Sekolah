<?php
require_once __DIR__ . "/middleware/auth.php";
$user = getAuthUser();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Koperasi Sekolah</title>
  <link rel="stylesheet" href="styles/index.css">
</head>
<body>

  <header>
    <div class="logo">Koperasi Sekolah</div>

    <?php if ($user): ?>
      <div class="auth">
        <span>Halo, <?= $user['name'] ?></span>
        <a href="actions/auth/logout.php"><button class="btn-logout">Logout</button></a>
      </div>
    <?php else: ?>
      <div class="auth">
        <a href="pages/auth/login.php"><button class="btn-login">Login</button></a>
        <a href="pages/auth/register.php"><button class="btn-register">Register</button></a>
      </div>
    <?php endif; ?>
  </header>

  <main>
    <h1>Sistem Informasi Koperasi Sekolah</h1>
    <p>Selamat datang di Sistem Informasi Koperasi Sekolah!</p>

    <div class="menu">
      <a href="pages/products/index.php"><button>Daftar Produk</button></a>
      <a href="pages/suppliers/index.php"><button>Daftar Supply</button></a>
      <a href="pages/employees/index.php"><button>Daftar Karyawan</button></a>
    </div>
  </main>

  <footer>
    <p>© 2026 Koperasi Sekolah</p>
  </footer>

</body>
</html>