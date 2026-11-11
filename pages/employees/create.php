<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
require_once __DIR__ . "/../../middleware/auth.php";
requireRole(['admin']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Karyawan</title>
  <link rel="stylesheet" href="../../styles/employees/create.css">
</head>
<body>
<header>
  <div class="logo">Koperasi Sekolah</div>
  <div class="auth"><button class="btn-login">Login</button><button class="btn-register">Register</button></div>
</header>
<main>
  <a href="index.php"><button type="button" class="btn-back">← Kembali</button></a>
  <h2>Tambah Karyawan</h2>
  <form method="POST" action="../../actions/employees/store.php">
    <label>Nomor Karyawan</label>
    <input type="text" name="employee_number" value="<?= $old['employee_number'] ?? '' ?>">
    <?php if (isset($errors['employee_number'])): ?><p style="color: red;"><?= $errors['employee_number'] ?></p><?php endif; ?>

    <label>Nama Lengkap</label>
    <input type="text" name="full_name" value="<?= $old['full_name'] ?? '' ?>">
    <?php if (isset($errors['full_name'])): ?><p style="color: red;"><?= $errors['full_name'] ?></p><?php endif; ?>

    <label>Jenis Kelamin</label>
    <div class="radio">
      <label><input type="radio" name="gender" value="M" <?= ($old['gender'] ?? '') === 'M' ? 'checked' : '' ?>> Laki-laki</label>
      <label><input type="radio" name="gender" value="F" <?= ($old['gender'] ?? '') === 'F' ? 'checked' : '' ?>> Perempuan</label>
    </div>
    <?php if (isset($errors['gender'])): ?><p style="color: red;"><?= $errors['gender'] ?></p><?php endif; ?>

    <label>Tanggal Lahir</label>
    <input type="date" name="birth_date" value="<?= $old['birth_date'] ?? '' ?>">
    <?php if (isset($errors['birth_date'])): ?><p style="color: red;"><?= $errors['birth_date'] ?></p><?php endif; ?>

    <label>Jabatan</label>
    <select name="position">
      <option value=""> Pilih Jabatan </option>
      <option value="Cashier" <?= ($old['position'] ?? '') === 'Cashier' ? 'selected' : '' ?>>Cashier</option>
      <option value="Warehouse Staff" <?= ($old['position'] ?? '') === 'Warehouse Staff' ? 'selected' : '' ?>>Warehouse Staff</option>
      <option value="Admin" <?= ($old['position'] ?? '') === 'Admin' ? 'selected' : '' ?>>Admin</option>
    </select>
    <?php if (isset($errors['position'])): ?><p style="color: red;"><?= $errors['position'] ?></p><?php endif; ?>

    <label>Gaji</label>
    <input type="number" name="salary" value="<?= $old['salary'] ?? '' ?>">
    <?php if (isset($errors['salary'])): ?><p style="color: red;"><?= $errors['salary'] ?></p><?php endif; ?>

    <div class="tombol">
      <button type="submit" name="store">Simpan</button>
      <a href="index.php"><button type="button">Batal</button></a>
    </div>
  </form>
</main>
<footer><p>© 2026 Koperasi Sekolah</p></footer>
</body>
</html>