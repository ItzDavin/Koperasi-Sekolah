<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
$success = $_SESSION['success'] ?? '';
unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="../../styles/auth/login.css">
</head>
<body>

<header>
  <div class="logo">Koperasi Sekolah</div>
  <div class="auth">
    <button class="btn-login">Login</button>
    <a href="register.php"><button class="btn-register">Register</button></a>
  </div>
</header>

<a href="../../index.php"><button type="button" class="btn-back">← Kembali</button></a>
<main>
  <h2>Login</h2>

  <?php if ($success !== ''): ?>
    <p class="success-text"><?= $success ?></p>
  <?php endif; ?>

  <?php if (isset($errors['login'])): ?>
    <p style="color: red;"><?= $errors['login'] ?></p>
  <?php endif; ?>

  <form method="POST" action="../../actions/auth/login.php">
    <label>Email</label>
    <input type="email" name="email" placeholder="Contoh: andi@gmail.com" value="<?= $old['email'] ?? '' ?>" required>
    <?php if (isset($errors['email'])): ?><p style="color: red;"><?= $errors['email'] ?></p><?php endif; ?>

    <label>Password</label>
    <input type="password" name="password" placeholder="Masukkan password" required>
    <?php if (isset($errors['password'])): ?><p style="color: red;"><?= $errors['password'] ?></p><?php endif; ?>

    <div class="tombol">
      <button type="submit" name="login">Login</button>
    </div>

    <p class="pindah">Belum punya akun? <a href="register.php">Register di sini</a></p>
  </form>
</main>

<footer><p>© 2026 Koperasi Sekolah</p></footer>

</body>
</html>