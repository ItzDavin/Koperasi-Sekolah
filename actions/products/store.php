<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/product-validation.php";
require_once __DIR__ . "/../../middleware/auth.php";
requireRole(['admin']);

if (isset($_POST['store']) &&
    $_SERVER['REQUEST_METHOD'] === "POST") {
  try {
    $pdo->beginTransaction();

    $request = getProductRequest($_POST);
    $errors = validateProduct($request);

    if (count($errors) > 0) {
      $_SESSION['errors'] = $errors;
      $_SESSION['old'] = $request;

      header('Location: ../../pages/products/create.php');
      exit;
    }

    $query = "insert into products (product_code, product_name, category, unit, price, stock, entry_date, description) values (:product_code, :product_name, :category, :unit, :price, :stock, :entry_date, :description)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
      'product_code' => $request['product_code'],
      'product_name' => $request['product_name'],
      'category' => $request['category'],
      'unit' => $request['unit'],
      'price' => $request['price'],
      'stock' => $request['stock'],
      'entry_date' => $request['entry_date'],
      'description' => $request['description']
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