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
  <title>Tambah Produk</title>
  <link rel="stylesheet" href="../../styles/products/create.css">
</head>
<body>

<header>
  <div class="logo">Koperasi Sekolah</div>
  <div class="auth">
    <button class="btn-login">Login</button>
    <button class="btn-register">Register</button>
  </div>
</header>

<main>
  <a href="index.php"><button type="button" class="btn-back">← Kembali</button></a>
  <h2>Tambah Produk</h2>

  <form method="POST" action="../../actions/products/store.php">

    <label>Kode Produk</label>
    <input type="text" name="product_code" value="<?= $old['product_code'] ?? '' ?>"> <!-- [3] -->
    <?php if (isset($errors['product_code'])): ?>
      <p style="color: red;""><?= $errors['product_code'] ?></p> <!-- [4] -->
    <?php endif; ?>

    <label>Nama Produk</label>
    <input type="text" name="product_name" value="<?= $old['product_name'] ?? '' ?>">
    <?php if (isset($errors['product_name'])): ?>
      <p style="color: red;""><?= $errors['product_name'] ?></p>
    <?php endif; ?>

    <label>Kategori</label>
    <select name="category">
      <option value="">Pilih</option>
      <option value="Food" <?= ($old['category'] ?? '') === 'Food' ? 'selected' : '' ?>>Food</option>
      <option value="Drink" <?= ($old['category'] ?? '') === 'Drink' ? 'selected' : '' ?>>Drink</option>
      <option value="Stationery" <?= ($old['category'] ?? '') === 'Stationery' ? 'selected' : '' ?>>Stationery</option>
      <option value="Uniform" <?= ($old['category'] ?? '') === 'Uniform' ? 'selected' : '' ?>>Uniform</option>
    </select>
    <?php if (isset($errors['category'])): ?>
      <p style="color: red;""><?= $errors['category'] ?></p>
    <?php endif; ?>

    <label>Satuan</label>
    <div class="radio">
      <label><input type="radio" name="unit" value="Pcs" <?= ($old['unit'] ?? '') === 'Pcs' ? 'checked' : '' ?>> Pcs</label>
      <label><input type="radio" name="unit" value="Pack" <?= ($old['unit'] ?? '') === 'Pack' ? 'checked' : '' ?>> Pack</label>
      <label><input type="radio" name="unit" value="Bottle" <?= ($old['unit'] ?? '') === 'Bottle' ? 'checked' : '' ?>> Bottle</label>
    </div>
    <?php if (isset($errors['unit'])): ?>
      <p style="color: red;""><?= $errors['unit'] ?></p>
    <?php endif; ?>

    <label>Harga</label>
    <input type="number" name="price" value="<?= $old['price'] ?? '' ?>">
    <?php if (isset($errors['price'])): ?>
      <p style="color: red;""><?= $errors['price'] ?></p>
    <?php endif; ?>

    <label>Stok</label>
    <input type="number" name="stock" value="<?= $old['stock'] ?? '' ?>">
    <?php if (isset($errors['stock'])): ?>
      <p style="color: red;""><?= $errors['stock'] ?></p>
    <?php endif; ?>

    <label>Tanggal Masuk</label>
    <input type="date" name="entry_date" value="<?= $old['entry_date'] ?? '' ?>">
    <?php if (isset($errors['entry_date'])): ?>
      <p style="color: red;""><?= $errors['entry_date'] ?></p>
    <?php endif; ?>

    <label>Deskripsi</label>
    <textarea name="description"><?= $old['description'] ?? '' ?></textarea>

    <div class="tombol">
      <button type="submit" name="store">Simpan</button>
      <a href="index.php"><button type="button">Batal</button></a>
    </div>

  </form>
</main>

<footer><p>© 2026 Koperasi Sekolah</p></footer>

</body>
</html>