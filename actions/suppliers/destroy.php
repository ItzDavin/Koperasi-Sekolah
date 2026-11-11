<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../middleware/auth.php";
requireRole(['admin']);
if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === "GET") {
  try {
    $pdo->beginTransaction();
    $query = "delete from suppliers where supplier_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $_GET['id']]);
    $pdo->commit();
    header('Location: ../../pages/suppliers/index.php');
    exit;
  } catch (PDOException $e) {
    $pdo->rollBack();
    if ($e->getCode() === '23000') {
      $_SESSION['errors'] = ['delete' => "Supplier masih dipakai, tidak bisa dihapus"];
      header('Location: ../../pages/suppliers/index.php');
      exit;
    }
    throw $e;
  }
}
?>