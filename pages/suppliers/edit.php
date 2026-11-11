<?php
session_start();
require_once __DIR__ . "/../../repositories/supplier-repository.php";
$supplier = getSupplier($_GET['id'] ?? 0);
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
$data = $old ?: $supplier;
$types_text = is_array($data['product_types'] ?? '') ? implode(', ', $data['product_types']) : ($data['product_types'] ?? '');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Ubah Supplier</title>
  <link rel="stylesheet" href="../../styles/suppliers/edit.css">
</head>
<body>
<header>
  <div class="logo">Koperasi Sekolah</div>
  <div class="auth"><button class="btn-login">Login</button><button class="btn-register">Register</button></div>
</header>
<main>
  <a href="index.php"><button type="button" class="btn-back">← Kembali</button></a>
  <h2>Ubah Supplier</h2>
  <form method="POST" action="../../actions/suppliers/update.php">
    <input type="hidden" name="id" value="<?= $supplier['supplier_id'] ?>">

    <label>Nama Supplier</label>
    <input type="text" name="supplier_name" value="<?= $data['supplier_name'] ?? '' ?>">
    <?php if (isset($errors['supplier_name'])): ?><p style="color: red;"><?= $errors['supplier_name'] ?></p><?php endif; ?>

    <label>Email</label>
    <input type="email" name="email" value="<?= $data['email'] ?? '' ?>">
    <?php if (isset($errors['email'])): ?><p style="color: red;"><?= $errors['email'] ?></p><?php endif; ?>

    <label>Telepon</label>
    <input type="tel" name="phone" value="<?= $data['phone'] ?? '' ?>">
    <?php if (isset($errors['phone'])): ?><p style="color: red;"><?= $errors['phone'] ?></p><?php endif; ?>

    <label>Alamat</label>
    <textarea name="address"><?= $data['address'] ?? '' ?></textarea>

    <label>Jenis Produk</label>
    <div class="checkbox">
      <label><input type="checkbox" name="product_types[]" value="Food" <?= str_contains($types_text, 'Food') ? 'checked' : '' ?>> Food</label>
      <label><input type="checkbox" name="product_types[]" value="Drink" <?= str_contains($types_text, 'Drink') ? 'checked' : '' ?>> Drink</label>
      <label><input type="checkbox" name="product_types[]" value="Stationery" <?= str_contains($types_text, 'Stationery') ? 'checked' : '' ?>> Stationery</label>
      <label><input type="checkbox" name="product_types[]" value="Uniform" <?= str_contains($types_text, 'Uniform') ? 'checked' : '' ?>> Uniform</label>
    </div>
    <?php if (isset($errors['product_types'])): ?><p style="color: red;"><?= $errors['product_types'] ?></p><?php endif; ?>

    <label>Tanggal Kerjasama</label>
    <input type="date" name="partnership_date" value="<?= $data['partnership_date'] ?? '' ?>">
    <?php if (isset($errors['partnership_date'])): ?><p style="color: red;"><?= $errors['partnership_date'] ?></p><?php endif; ?>

    <div class="tombol">
      <button type="submit" name="update">Update</button>
      <a href="index.php"><button type="button">Batal</button></a>
    </div>
  </form>
</main>
<footer><p>© 2026 Koperasi Sekolah</p></footer>
</body>
</html>