<?php
require_once __DIR__ . "/../repositories/supplier-repository.php";

function getSupplierRequest($request)
{
  return [
    'id' => trim(htmlspecialchars($request['id'] ?? '')),
    'supplier_name' => trim(htmlspecialchars($request['supplier_name'] ?? '')),
    'email' => trim(htmlspecialchars($request['email'] ?? '')),
    'phone' => trim(htmlspecialchars($request['phone'] ?? '')),
    'address' => trim(htmlspecialchars($request['address'] ?? '')),
    'product_types' => $request['product_types'] ?? [],
    'partnership_date' => trim(htmlspecialchars($request['partnership_date'] ?? '')),
  ];
}

function validateSupplier($request, $ignoreId = 0)
{
  $errors = [];

  if ($request['supplier_name'] === '') {
    $errors['supplier_name'] = "Nama supplier wajib diisi";
  } elseif (mb_strlen($request['supplier_name']) > 100) {
    $errors['supplier_name'] = "Nama supplier maksimal 100 karakter";
  }

  if ($request['email'] === '') {
    $errors['email'] = "Email wajib diisi";
  } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Format email tidak valid";
  } elseif (isSupplierEmailTaken($request['email'], $ignoreId)) {
    $errors['email'] = "Email sudah dipakai";
  }

  if ($request['phone'] === '') {
    $errors['phone'] = "Telepon wajib diisi";
  } elseif (mb_strlen($request['phone']) > 15) {
    $errors['phone'] = "Telepon maksimal 15 karakter";
  }

  $allowed = ['Food', 'Drink', 'Stationery', 'Uniform'];
  if (empty($request['product_types'])) {
    $errors['product_types'] = "Pilih minimal 1 jenis produk";
  } else {
    foreach ($request['product_types'] as $type) {
      if (!in_array($type, $allowed)) {
        $errors['product_types'] = "Jenis produk tidak valid";
        break;
      }
    }
  }

  if ($request['partnership_date'] === '') {
    $errors['partnership_date'] = "Tanggal kerjasama wajib diisi";
  }

  return $errors;
}
?>