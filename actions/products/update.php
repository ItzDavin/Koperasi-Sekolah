<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/product-validation.php";

if (isset($_POST['update']) &&
    $_SERVER['REQUEST_METHOD'] === "POST") {
  try {
    $pdo->beginTransaction();

    $request = getProductRequest($_POST);
    $errors = validateProduct($request, $request['id']);

    if (count($errors) > 0) {
      $_SESSION['errors'] = $errors;
      $_SESSION['old'] = $request;

      header('Location: ../../pages/products/edit.php' . '?id=' . urlencode($request['id']));
      exit;
    }

    $query = "update products set product_code = :product_code, product_name = :product_name, category = :category, unit = :unit, price = :price, stock = :stock, entry_date = :entry_date, description = :description where product_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
      'product_code' => $request['product_code'],
      'product_name' => $request['product_name'],
      'category' => $request['category'],
      'unit' => $request['unit'],
      'price' => $request['price'],
      'stock' => $request['stock'],
      'entry_date' => $request['entry_date'],
      'description' => $request['description'],
      'id' => $request['id']
    ]);

    $pdo->commit();

    header('Location: ../../pages/products/index.php');
    exit;
  } catch (PDOException $e) {
    $pdo->rollBack();
    throw $e;
  }
}
?>