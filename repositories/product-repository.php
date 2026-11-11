<?php
require_once __DIR__ . "/../config/database.php";

function getProducts()
{
  global $pdo;

  $query = "select * from products order by product_id";
  $stmt = $pdo->prepare($query);
  $stmt->execute();

  return $stmt->fetchAll();
}

function getProduct($id)
{
  global $pdo;

  $query = "select * from products where product_id = :id";
  $stmt = $pdo->prepare($query);
  $stmt->execute(['id' => $id]);

  $product = $stmt->fetch();

  if (!$product) {
    header("Location: ../products/index.php");
    exit;
  }

  return $product;
}

function isProductCodeTaken($code, $ignoreId = 0)
{
  global $pdo;

  $query = "select count(product_id) from products
            where product_code = :code and product_id != :id";
  $stmt = $pdo->prepare($query);
  $stmt->execute([
    'code' => $code,
    'id' => intval($ignoreId)
  ]);

  return $stmt->fetchColumn() > 0;
}

function storeProduct($request)
{
  global $pdo;

  $query = "insert into products (product_code, product_name, category, unit, price, stock, entry_date, description)
            values (:product_code, :product_name, :category, :unit, :price, :stock, :entry_date, :description)";
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
}

function updateProduct($id, $request)
{
  global $pdo;

  $query = "update products set
            product_code = :product_code,
            product_name = :product_name,
            category = :category,
            unit = :unit,
            price = :price,
            stock = :stock,
            entry_date = :entry_date,
            description = :description
            where product_id = :id";
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
    'id' => $id
  ]);
}

function deleteProduct($id)
{
  global $pdo;

  $query = "delete from products where product_id = :id";
  $stmt = $pdo->prepare($query);
  $stmt->execute(['id' => $id]);
}
?>