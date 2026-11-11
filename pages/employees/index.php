<?php
require_once __DIR__ . "/../../middleware/auth.php";
$user = getAuthUser();
if (!$user) {
  header('Location: ../auth/login.php');
  exit;
}

require_once __DIR__ . "/../../repositories/employee-repository.php";
$employees = getEmployees();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Karyawan</title>
  <link rel="stylesheet" href="../../styles/employees/index.css">
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
  <h2>Daftar Karyawan</h2>
  <a href="../../index.php"><button type="button" class="btn-back">← Kembali</button></a>
  <a href="create.php"><button class="btn-tambah">+ Tambah Karyawan</button></a>

  <?php if (isset($_SESSION['errors']['delete'])): ?>
    <p class="error-text"><?= $_SESSION['errors']['delete'] ?></p>
    <?php unset($_SESSION['errors']); ?>
  <?php endif; ?>

  <table>
    <tr>
      <th>Nomor</th><th>Nama</th><th>Gender</th><th>Tanggal Lahir</th><th>Jabatan</th><th>Gaji</th><th>Aksi</th>
    </tr>
    <?php foreach ($employees as $employee): ?>
    <tr>
      <td><?= $employee['employee_number'] ?></td>
      <td><?= $employee['full_name'] ?></td>
      <td><?= $employee['gender'] === 'M' ? 'Laki-laki' : 'Perempuan' ?></td>
      <td><?= $employee['birth_date'] ?></td>
      <td><?= $employee['position'] ?></td>
      <td><?= $employee['salary'] ?></td>
      <td>
        <a href="edit.php?id=<?= $employee['employee_id'] ?>"><button>Ubah</button></a>
        <a href="../../actions/employees/destroy.php?id=<?= $employee['employee_id'] ?>" onclick="return confirm('Yakin ingin menghapus?')"><button>Hapus</button></a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</main>
<footer><p>© 2026 Koperasi Sekolah</p></footer>
</body>
</html>