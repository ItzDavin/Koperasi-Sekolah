<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/supplier-validation.php";

if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === "POST") {
  try {
    $pdo->beginTransaction();
    $request = getSupplierRequest($_POST);
    $errors = validateSupplier($request, $request['id']);
    if (count($errors) > 0) {
      $_SESSION['errors'] = $errors;
      $_SESSION['old'] = $request;
      header('Location: ../../pages/suppliers/edit.php' . '?id=' . urlencode($request['id']));
      exit;
    }
    $query = "update suppliers set supplier_name = :supplier_name, email = :email, phone = :phone, address = :address, product_types = :product_types, partnership_date = :partnership_date where supplier_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
      'supplier_name' => $request['supplier_name'],
      'email' => $request['email'],
      'phone' => $request['phone'],
      'address' => $request['address'],
      'product_types' => implode(', ', $request['product_types']),
      'partnership_date' => $request['partnership_date'],
      'id' => $request['id']
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