<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/auth-validation.php";

if (isset($_POST['register']) &&
    $_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $pdo->beginTransaction();

    $request = getRegisterRequest($_POST);
    $errors = validateRegister($request);

    if (count($errors) > 0) {
      $_SESSION['errors'] = $errors;

      // Password JANGAN dibalikin ke form, demi keamanan
      unset($request['password'], $request['confirm_password']);

      $_SESSION['old'] = $request;

      header('Location: ../../pages/auth/register.php');
      exit;
    }

    $query = "insert into users
                (full_name, email, password, role)
              values (:full_name, :email, :password, :role)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
      'full_name' => $request['full_name'],
      'email' => $request['email'],
      'password' => password_hash(
        $request['password'], PASSWORD_BCRYPT),
      'role' => 'kasir'
    ]);

    $pdo->commit();

    $_SESSION['success'] =
      "Registrasi pengguna baru sudah berhasil";

    header('Location: ../../pages/auth/login.php');
    exit;
  } catch (PDOException $e) {
    $pdo->rollBack();
    throw $e;
  }
}
?>