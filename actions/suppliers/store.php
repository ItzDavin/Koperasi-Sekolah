<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/supplier-validation.php";
require_once __DIR__ . "/../../middleware/auth.php";
requireRole(['admin']);

if (isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === "POST") {
  try {
    $pdo->beginTransaction();
    $request = getSupplierRequest($_POST);
    $errors = validateSupplier($request);
    if (count($errors) > 0) {
      $_SESSION['errors'] = $errors;
      $_SESSION['old'] = $request;
      header('Location: ../../pages/suppliers/create.php');
      exit;
    }
    $query = "insert into suppliers (supplier_name, email, phone, address, product_types, partnership_date) values (:supplier_name, :email, :phone, :address, :product_types, :partnership_date)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
      'supplier_name' => $request['supplier_name'],
      'email' => $request['email'],
      'phone' => $request['phone'],
      'address' => $request['address'],
      'product_types' => implode(', ', $request['product_types']),
      'partnership_date' => $request['partnership_date']
    ]);
    $pdo->commit();
    header('Location: ../../pages/suppliers/index.php');
    exit;
  } catch (PDOException $e) {
    $pdo->rollBack();
    throw $e;
  }
}
?>