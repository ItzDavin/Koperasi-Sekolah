<?php
require_once __DIR__ . "/../repositories/product-repository.php";

function getProductRequest($request)
{
  return [
    'id' => trim(htmlspecialchars($request['id'] ?? '')),
    'product_code' => trim(htmlspecialchars($request['product_code'] ?? '')),
    'product_name' => trim(htmlspecialchars($request['product_name'] ?? '')),
    'category' => trim(htmlspecialchars($request['category'] ?? '')),
    'unit' => trim(htmlspecialchars($request['unit'] ?? '')),
    'price' => trim(htmlspecialchars($request['price'] ?? '')),
    'stock' => trim(htmlspecialchars($request['stock'] ?? '')),
    'entry_date' => trim(htmlspecialchars($request['entry_date'] ?? '')),
    'description' => trim(htmlspecialchars($request['description'] ?? '')),
  ];
}   

function validateProduct($request, $ignoreId = 0)
{
  $errors = [];

  
  if ($request['product_code'] === '') {
    $errors['product_code'] = "Kode produk wajib diisi";
  } elseif (mb_strlen($request['product_code']) > 10) {
    $errors['product_code'] = "Kode produk maksimal 10 karakter";
  } elseif (isProductCodeTaken($request['product_code'], $ignoreId)) {
    $errors['product_code'] = "Kode produk sudah ada";
  }

 
  if ($request['product_name'] === '') {
    $errors['product_name'] = "Nama produk wajib diisi";
  } elseif (mb_strlen($request['product_name']) > 100) {
    $errors['product_name'] = "Nama produk maksimal 100 karakter";
  }

  $allowed_category = ['Food', 'Drink', 'Stationery', 'Uniform'];
  if ($request['category'] === '') {
    $errors['category'] = "Kategori wajib dipilih";
  } elseif (!in_array($request['category'], $allowed_category)) {
    $errors['category'] = "Kategori tidak valid";
  }

  $allowed_unit = ['Pcs', 'Pack', 'Bottle'];
  if ($request['unit'] === '') {
    $errors['unit'] = "Satuan wajib dipilih";
  } elseif (!in_array($request['unit'], $allowed_unit)) {
    $errors['unit'] = "Satuan tidak valid";
  }

  if ($request['price'] === '') {
    $errors['price'] = "Harga wajib diisi";
  } elseif (!is_numeric($request['price']) || $request['price'] < 0) {
    $errors['price'] = "Harga tidak boleh negatif";
  }

  if ($request['stock'] === '') {
    $errors['stock'] = "Stok wajib diisi";
  } elseif (!is_numeric($request['stock']) || $request['stock'] < 0) {
    $errors['stock'] = "Stok tidak boleh negatif";
  }

  if ($request['entry_date'] === '') {
    $errors['entry_date'] = "Tanggal masuk wajib diisi";
  }

  return $errors;
}
?>