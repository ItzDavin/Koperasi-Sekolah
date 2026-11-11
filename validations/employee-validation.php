<?php
require_once __DIR__ . "/../repositories/employee-repository.php";

function getEmployeeRequest($request)
{
  return [
    'id' => trim(htmlspecialchars($request['id'] ?? '')),
    'employee_number' => trim(htmlspecialchars($request['employee_number'] ?? '')),
    'full_name' => trim(htmlspecialchars($request['full_name'] ?? '')),
    'gender' => trim(htmlspecialchars($request['gender'] ?? '')),
    'birth_date' => trim(htmlspecialchars($request['birth_date'] ?? '')),
    'position' => trim(htmlspecialchars($request['position'] ?? '')),
    'salary' => trim(htmlspecialchars($request['salary'] ?? '')),
  ];
}

function validateEmployee($request, $ignoreId = 0)
{
  $errors = [];

  if ($request['employee_number'] === '') {
    $errors['employee_number'] = "Nomor karyawan wajib diisi";
  } elseif (mb_strlen($request['employee_number']) > 10) {
    $errors['employee_number'] = "Nomor karyawan maksimal 10 karakter";
  } elseif (isEmployeeNumberTaken($request['employee_number'], $ignoreId)) {
    $errors['employee_number'] = "Nomor karyawan sudah dipakai";
  }

  if ($request['full_name'] === '') {
    $errors['full_name'] = "Nama lengkap wajib diisi";
  } elseif (mb_strlen($request['full_name']) > 100) {
    $errors['full_name'] = "Nama lengkap maksimal 100 karakter";
  }

  if ($request['gender'] === '') {
    $errors['gender'] = "Jenis kelamin wajib dipilih";
  } elseif (!in_array($request['gender'], ['M', 'F'])) {
    $errors['gender'] = "Jenis kelamin tidak valid";
  }

  if ($request['birth_date'] === '') {
    $errors['birth_date'] = "Tanggal lahir wajib diisi";
  }

  if ($request['position'] === '') {
    $errors['position'] = "Jabatan wajib dipilih";
  } elseif (!in_array($request['position'], ['Cashier', 'Warehouse Staff', 'Admin'])) {
    $errors['position'] = "Jabatan tidak valid";
  }

  if ($request['salary'] === '') {
    $errors['salary'] = "Gaji wajib diisi";
  } elseif (!is_numeric($request['salary'])) {
    $errors['salary'] = "Gaji harus berupa angka";
  } elseif ($request['salary'] < 0) {
    $errors['salary'] = "Gaji tidak boleh negatif";
  }

  return $errors;
}
?>