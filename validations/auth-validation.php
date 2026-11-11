<?php
require_once __DIR__ . "/../repositories/user-repository.php";

function getRegisterRequest($request)
{
  return [
    'full_name' => trim(htmlspecialchars($request['full_name'] ?? '')),
    'email' => trim(htmlspecialchars($request['email'] ?? '')),
    'password' => $request['password'] ?? '',
    'confirm_password' => $request['confirm_password'] ?? '',
  ];
}

function validateRegister($request)
{
  $errors = [];

  if ($request['full_name'] === '') {
    $errors['full_name'] = "Nama wajib diisi";
  } elseif (mb_strlen($request['full_name']) > 100) {
    $errors['full_name'] = "Nama maksimal 100 karakter";
  }

  if ($request['email'] === '') {
    $errors['email'] = "Email wajib diisi";
  } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Format email tidak valid";
  } elseif (isEmailTaken($request['email'])) {
    $errors['email'] = "Email sudah terdaftar";
  }

  if ($request['password'] === '') {
    $errors['password'] = "Kata sandi wajib diisi";
  } elseif (mb_strlen($request['password']) < 8) {
    $errors['password'] = "Kata sandi minimal 8 karakter";
  }

  if ($request['confirm_password'] !== $request['password']) {
    $errors['confirm_password'] = "Konfirmasi kata sandi tidak cocok";
  }

  return $errors;
}

function getLoginRequest($request)
{
  return [
    'email' => trim(htmlspecialchars($request['email'] ?? '')),
    'password' => $request['password'] ?? ''
  ];
}
function validateLogin($request)
{
  $errors = [];
  if ($request['email'] === '') {
    $errors['email'] = "Email wajib diisi";
  }
  if ($request['password'] === '') {
    $errors['password'] = "Kata sandi wajib diisi";
  }
  return $errors;
}
?>