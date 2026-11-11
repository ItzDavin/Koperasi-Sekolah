<?php
require_once __DIR__ . "/../../middleware/auth.php";
$user = getAuthUser();
if (!$user) {
  header('Location: ../auth/login.php');
  exit;
}

require_once __DIR__ . "/../../repositories/supplier-repository.php";
$suppliers = getSuppliers();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Supplier</title>
  <link rel="stylesheet" href="../../styles/suppliers/index.css">
</head>
<body>
<header>
  <div class="logo">Koperasi Sekolah</div>
  <div class="auth">
    <span>Halo, <?= $user['name'] ?></span>
    <a href="../../actions/auth/logout.php"><button class="btn-logout">Logout</button></a>
  </div>
</header>
<main>
  <h2>Daftar Supplier</h2>
  <a href="../../index.php"><button type="button" class="btn-back">← Kembali</button></a>
  <a href="create.php"><button class="btn-tambah">+ Tambah Supplier</button></a>

  <table>
    <tr>
      <th>Nama</th><th>Email</th><th>Telepon</th><th>Jenis Produk</th><th>Tanggal Kerjasama</th><th>Aksi</th>
    </tr>
    <?php foreach ($suppliers as $supplier): ?>
    <tr>
      <td><?= $supplier['supplier_name'] ?></td>
      <td><?= $supplier['email'] ?></td>
      <td><?= $supplier['phone'] ?></td>
      <td><?= $supplier['product_types'] ?></td>
      <td><?= $supplier['partnership_date'] ?></td>
      <td>
        <a href="edit.php?id=<?= $supplier['supplier_id'] ?>"><button>Ubah</button></a>
        <a href="../../actions/suppliers/destroy.php?id=<?= $supplier['supplier_id'] ?>" onclick="return confirm('Yakin ingin menghapus?')"><button>Hapus</button></a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</main>
<footer><p>© 2026 Koperasi Sekolah</p></footer>
</body>
</html>