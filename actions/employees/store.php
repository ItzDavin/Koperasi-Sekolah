<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/employee-validation.php";
require_once __DIR__ . "/../../middleware/auth.php";
requireRole(['admin']);

if (isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === "POST") {
  try {
    $pdo->beginTransaction();
    $request = getEmployeeRequest($_POST);
    $errors = validateEmployee($request);
    if (count($errors) > 0) {
      $_SESSION['errors'] = $errors;
      $_SESSION['old'] = $request;
      header('Location: ../../pages/employees/create.php');
      exit;
    }
    $query = "insert into employees (employee_number, full_name, gender, birth_date, position, salary) values (:employee_number, :full_name, :gender, :birth_date, :position, :salary)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
      'employee_number' => $request['employee_number'],
      'full_name' => $request['full_name'],
      'gender' => $request['gender'],
      'birth_date' => $request['birth_date'],
      'position' => $request['position'],
      'salary' => $request['salary']
    ]);
    $pdo->commit();
    header('Location: ../../pages/employees/index.php');
    exit;
  } catch (PDOException $e) {
    $pdo->rollBack();
    throw $e;
  }
}
?>