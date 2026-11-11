<?php
require_once __DIR__ . "/../../middleware/auth.php";
$user = getAuthUser();
if (!$user) {
  header('Location: ../auth/login.php');
  exit;
}
                                    
require_once __DIR__ . "/../../repositories/product-repository.php";

$products = getProducts();                            
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Produk</title>
  <link rel="stylesheet" href="../../styles/products/index.css">
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
  <h2>Daftar Produk</h2>
  <a href="../../index.php"><button type="button" class="btn-back">← Kembali</button></a>
  <a href="create.php"><button class="btn-tambah">+ Tambah Produk</button></a>

  <table>
    <tr>
      <th>Kode</th>
      <th>Nama</th>
      <th>Kategori</th>
      <th>Satuan</th>
      <th>Harga</th>
      <th>Stok</th>
      <th>Tanggal</th>
      <th>Aksi</th>
    </tr>

    <?php foreach ($products as $product): ?>          <!-- [3] -->
    <tr>
      <td><?= $product['product_code'] ?></td>         <!-- [4] -->
      <td><?= $product['product_name'] ?></td>
      <td><?= $product['category'] ?></td>
      <td><?= $product['unit'] ?></td>
      <td><?= $product['price'] ?></td>
      <td><?= $product['stock'] ?></td>
      <td><?= $product['entry_date'] ?></td>
      <td>
        <a href="edit.php?id=<?= $product['product_id'] ?>"><button>Ubah</button></a>
        <a href="../../actions/products/destroy.php?id=<?= $product['product_id'] ?>"
           onclick="return confirm('Yakin ingin menghapus?')"> <!-- [5] -->
          <button>Hapus</button>
        </a>
      </td>
    </tr>
    <?php endforeach; ?>

  </table>
</main>

<footer><p>© 2026 Koperasi Sekolah</p></footer>

</body>
</html>