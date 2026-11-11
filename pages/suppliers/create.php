<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
$types_text = implode(', ', $old['product_types'] ?? []);
require_once __DIR__ . "/../../middleware/auth.php";
requireRole(['admin']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Supplier</title>
  <link rel="stylesheet" href="../../styles/suppliers/create.css">
</head>
<body>
<header>
  <div class="logo">Koperasi Sekolah</div>
  <div class="auth"><button class="btn-login">Login</button><button class="btn-register">Register</button></div>
</header>
<main>
  <a href="index.php"><button type="button" class="btn-back">← Kembali</button></a>
  <h2>Tambah Supplier</h2>
  <form method="POST" action="../../actions/suppliers/store.php">
    <label>Nama Supplier</label>
    <input type="text" name="supplier_name" maxlength="100" value="<?= $old['supplier_name'] ?? '' ?>">
    <?php if (isset($errors['supplier_name'])): ?><p style="color: red;"><?= $errors['supplier_name'] ?></p><?php endif; ?>

    <label>Email</label>
    <input type="email" name="email" maxlength="100" value="<?= $old['email'] ?? '' ?>">
    <?php if (isset($errors['email'])): ?><p style="color: red;"><?= $errors['email'] ?></p><?php endif; ?>

    <label>Telepon</label>
    <input type="tel" name="phone" maxlength="15" value="<?= $old['phone'] ?? '' ?>">
    <?php if (isset($errors['phone'])): ?><p style="color: red;"><?= $errors['phone'] ?></p><?php endif; ?>

    <label>Alamat</label>
    <textarea name="address"><?= $old['address'] ?? '' ?></textarea>

    <label>Jenis Produk</label>
    <div class="checkbox">
      <!-- "Pakai [] karena jenis produk bisa dipilih lebih dari satu. Jadi $_POST['product_types'] jadi array, biar bisa disimpan pakai implode jadi teks Food, Drink. Kalau gak pakai [], yang tersimpan hanya pilihan terakhir." -->
      <label><input type="checkbox" name="product_types[]" value="Food" <?= str_contains($types_text, 'Food') ? 'checked' : '' ?>> Food</label>
      <label><input type="checkbox" name="product_types[]" value="Drink" <?= str_contains($types_text, 'Drink') ? 'checked' : '' ?>> Drink</label>
      <label><input type="checkbox" name="product_types[]" value="Stationery" <?= str_contains($types_text, 'Stationery') ? 'checked' : '' ?>> Stationery</label>
      <label><input type="checkbox" name="product_types[]" value="Uniform" <?= str_contains($types_text, 'Uniform') ? 'checked' : '' ?>> Uniform</label>
    </div>
    <?php if (isset($errors['product_types'])): ?><p style="color: red;"><?= $errors['product_types'] ?></p><?php endif; ?>

    <label>Tanggal Kerjasama</label>
    <input type="date" name="partnership_date" value="<?= $old['partnership_date'] ?? '' ?>">
    <?php if (isset($errors['partnership_date'])): ?><p style="color: red;"><?= $errors['partnership_date'] ?></p><?php endif; ?>

    <div class="tombol">
      <button type="submit" name="store">Simpan</button>
      <a href="index.php"><button type="button">Batal</button></a>
    </div>
  </form>
</main>
<footer><p>© 2026 Koperasi Sekolah</p></footer>
</body>
</html>