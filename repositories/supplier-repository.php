<?php
require_once __DIR__ . "/../config/database.php";

function getSuppliers()
{
  global $pdo;
  $query = "select * from suppliers order by supplier_id";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  return $stmt->fetchAll();
}

function getSupplier($id)
{
  global $pdo;
  $query = "select * from suppliers where supplier_id = :id";
  $stmt = $pdo->prepare($query);
  $stmt->execute(['id' => $id]);
  $supplier = $stmt->fetch();
  if (!$supplier) {
    header("Location: ../suppliers/index.php");
    exit;
  }
  return $supplier;
}

function isSupplierEmailTaken($email, $ignoreId = 0)
{
  global $pdo;
  $query = "select count(supplier_id) from suppliers where email = :email and supplier_id != :id";
  $stmt = $pdo->prepare($query);
  $stmt->execute(['email' => $email, 'id' => intval($ignoreId)]);
  return $stmt->fetchColumn() > 0;
}
?>  