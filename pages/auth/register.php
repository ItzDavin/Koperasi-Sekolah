<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="../../styles/auth/register.css">
</head>
<body>

<header>
  <div class="logo">Koperasi Sekolah</div>
  <div class="auth">
    <a href="login.php"><button class="btn-login">Login</button></a>
    <button class="btn-register">Register</button>
  </div>
</header>

<a href="../../index.php"><button type="button" class="btn-back">← Kembali</button></a>
<main>
  <h2>Register</h2>

  <form method="POST" action="../../actions/auth/register.php">
    <label>Nama Lengkap</label>
    <input type="text" name="full_name" placeholder="Contoh: Andi Pratama" value="<?= $old['full_name'] ?? '' ?>" required>
    <?php if (isset($errors['full_name'])): ?><p style="color: red;"><?= $errors['full_name'] ?></p><?php endif; ?>

    <label>Email</label>
    <input type="email" name="email" placeholder="Contoh: andi@gmail.com" value="<?= $old['email'] ?? '' ?>" required>
    <?php if (isset($errors['email'])): ?><p style="color: red;"><?= $errors['email'] ?></p><?php endif; ?>

    <label>Password</label>
    <input type="password" name="password" placeholder="Minimal 8 karakter" minlength="8" required>
    <?php if (isset($errors['password'])): ?><p style="color: red;"><?= $errors['password'] ?></p><?php endif; ?>

    <label>Konfirmasi Password</label>
    <input type="password" name="confirm_password" placeholder="Ulangi password" minlength="8" required>
    <?php if (isset($errors['confirm_password'])): ?><p style="color: red;"><?= $errors['confirm_password'] ?></p><?php endif; ?>

    <div class="tombol">
      <button type="submit" name="register">Register</button>
    </div>

    <p class="pindah">Sudah punya akun? <a href="login.php">Login di sini</a></p>
  </form>
</main>

<footer><p>© 2026 Koperasi Sekolah</p></footer>

</body>
</html>